<?php namespace App\Http\Controllers;

use App\Http\Controllers\Response;
use App\Http\Requests;
use App\Order;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Log\Writer;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{

    /**
     * @var array Valid PayFast hosts list
     */
    protected $validHosts = [
        'www.payfast.co.za',
        'sandbox.payfast.co.za',
        'w1w.payfast.co.za',
        'w2w.payfast.co.za'
    ];

    const SANDBOX_MODE = true;
    const PF_USER_AGENT = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
    const PF_TIMEOUT = 30;

    /**
     * Successful payment page.
     *
     * @return Response
     */
    public function success()
    {
        $orders = Auth::user()->orders;

        return view('payment.success', compact('orders'));
    }

    /**
     * Cancelled payment page.
     *
     * @return Response
     */
    public function cancelled()
    {
        $orders = Auth::user()->orders;

        return view('payment.cancelled', compact('orders'));
    }

    /**
     * PayFast notify
     *
     * @param Request $request
     * @param Writer  $logger
     *
     * @return Response
     */
    public function notify(Request $request, Writer $logger)
    {

        //Notify Payfast
        header('HTTP/1.0 200 OK');
        flush();

        $logger->useFiles('payFast.txt');

        if ($request->method() !== 'POST') {

            $logger->error('Error -- POST variables not set');

            exit();
        }

        $logger->debug(
            "Posted Variables --\n" . implode(
                "\n", array_filter(
                    $request->input(), function ($value) {
                    return empty($value);
                }
                )
            )
        );

        $payFastData = $this->cleanPostVariables($request->input());

        $serialisedPayFastData = $this->serialisePostVariables($payFastData);

        $signature = $request->input('signature');

        if ($signature === null) {

            $logger->error("Error -- Signature not set \n");

            exit();
        }

        if (!$this->hasValidSignature($signature, $serialisedPayFastData)) {

            $output = "Error -- Signature mismatch\n\n";
            $output .= "Security Signature:\n\n";
            $output .= "\t- posted     = " . $signature . "\n";
            $output .= "\t- calculated = " . $serialisedPayFastData . "\n";
            $output .= "\t- result     = " . $payFastData['payment_status'] . "\n";

            $logger->error($output);

            exit();
        }

        Transaction::create($request->input());

        if (!$this->isValidPayfastHost($request)) {

            $logger->error('Invalid PayFast IP Address');

            exit();
        }

        $pfHost = self::SANDBOX_MODE ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
        $response = '';

        if (in_array('curl', get_loaded_extensions())) {

            // Variable initialization
            $url = 'https://' . $pfHost . '/eng/query/validate';

            // Create default cURL object
            $ch = curl_init();

            // Set cURL options - Use curl_setopt for freater PHP compatibility
            // Base settings
            curl_setopt($ch, CURLOPT_USERAGENT, self::PF_USER_AGENT);  // Set user agent
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);      // Return output as string rather than outputting it
            curl_setopt($ch, CURLOPT_HEADER, false);             // Don't include header in output
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // Standard settings
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $serialisedPayFastData);
            curl_setopt($ch, CURLOPT_TIMEOUT, self::PF_TIMEOUT);
            if (!empty($pfProxy))
                curl_setopt($ch, CURLOPT_PROXY, $pfProxy);

            // Execute CURL
            $response = curl_exec($ch);
            curl_close($ch);
        } else {

            $header = '';
            $headerDone = false;

            // Construct Header
            $header .= "POST /eng/query/validate HTTP/1.0\r\n";
            $header .= "Host: " . $pfHost . "\r\n";
            $header .= "User-Agent: " . self::PF_USER_AGENT . "\r\n";
            $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
            $header .= "Content-Length: " . strlen($serialisedPayFastData) . "\r\n\r\n";

            // Connect to server
            $socket = fsockopen('ssl://' . $pfHost, 443, $errno, $errstr, self::PF_TIMEOUT);

            // Send command to server
            fputs($socket, $header . $serialisedPayFastData);

            // Read the response from the server
            while (!feof($socket)) {
                $line = fgets($socket, 1024);

                // Check if we are finished reading the header yet
                if (strcmp($line, "\r\n") == 0) {
                    // read the header
                    $headerDone = true;
                } // If header has been processed
                else if ($headerDone) {
                    // Read the main response
                    $response .= $line;
                }
            }
        }

        $lines = explode("\r\n", $response);
        $verifyResult = trim($lines[0]);

        if (strcasecmp($verifyResult, 'VALID') != 0) {

            $logger->error('Error -- Data not valid');

            die();
        }

        $order = Order::where('invoice_no', $request->input('m_payment_id'))->first();

        switch ($payFastData['payment_status']) {
            case 'COMPLETE':
                $logger->debug('Payment Status -- COMPLETE');
                $order->status = 'paid';
                break;
            case 'FAILED':
                $logger->error('Payment Status -- FAILED');
                $order->status = 'failed';
                break;
            case 'PENDING':
                $logger->debug('Payment Status -- PENDING');
                $order->status = 'pending';
                break;
            default:
                $logger->error('Payment Status -- DEFAULT');
                $order->status = 'error';
                break;
        }

        $order->save();
    }

    /**
     * @param $payFastData
     *
     * @return array
     */
    protected function cleanPostVariables($payFastData)
    {

        return array_map(
            function ($val) {
                return urlencode($val);
            }, $payFastData
        );
    }

    /**
     * @param $payFastSignature
     * @param $payFastParamString
     *
     * @return boolean
     */
    protected function hasValidSignature($payFastSignature, $payFastParamString)
    {

        $signature = md5($payFastParamString);

        if (!isset($payFastSignature)) {
            return false;
        }

        if ($signature !== $payFastSignature) {
            return false;
        }

        return true;
    }

    /**
     * @param $payFastData
     *
     * @return string
     */
    protected function serialisePostVariables($payFastData)
    {

        $payFastParamString = '';
        foreach ($payFastData as $key => $val) {
            if ($key != 'signature')
                $payFastParamString .= $key . '=' . $val . '&';
        }

        return substr($payFastParamString, 0, -1);
    }

    /**
     * Check if referring host has a valid PayFast ip address
     *
     * @param Request $request
     *
     * @return bool
     */
    protected function isValidPayFastHost(Request $request)
    {
        $validIps = [];

        foreach ($this->validHosts as $payFastHostname) {

            $payFastIpAddress = gethostbynamel($payFastHostname);

            if ($payFastIpAddress !== false) {

                $validIps = array_merge($payFastIpAddress, $validIps);
            }
        }

        $validIps = array_unique($validIps);

        if (in_array($request->server('REMOTE_ADDR'), $validIps)) {

            return true;
        }

        return false;
    }
}
