<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Repositories\Order;
use App\Repositories\Transaction;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Log\Writer;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    const STATUS_FAILED = 'FAILED';
    const STATUS_COMPLETE = 'COMPLETE';
    const STATUS_PENDING = 'PENDING';
    const PAYMENT_STATUS_COMPLETE = 'Payment Status -- COMPLETE';
    const PAYMENT_STATUS_FAILED = 'Payment Status -- FAILED';
    const PAYMENT_STATUS_PENDING = 'Payment Status -- PENDING';
    const PAYMENT_STATUS_DEFAULT = 'Payment Status -- DEFAULT';
    const ERROR = 'error';

    /**
     * @var array Valid PayFast hosts list
     */
    protected $validHosts = [
      'www.payfast.co.za',
      'sandbox.payfast.co.za',
      'w1w.payfast.co.za',
      'w2w.payfast.co.za',
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
            "\n",
            array_filter(
              $request->input(),
              function ($value) {
                  return !empty($value);
              }
            )
          ) . "\n"
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
        $hostUrl = 'https://' . $pfHost . '/eng/query/validate';

        if (in_array('curl', get_loaded_extensions())) {

            $response = $this->checkPaymentStatusCurl(
              $hostUrl,
              $serialisedPayFastData
            );
        } else {

            $response = $this->checkPaymentStatusHttp(
              $pfHost,
              $serialisedPayFastData
            );
        }

        $lines = explode("\r\n", $response);
        $verifyResult = trim($lines[0]);

        if (strcasecmp($verifyResult, 'VALID') != 0) {

            $logger->error('Error -- Data not valid');

            die();
        }

        $this->updateOrderStatus($request, $logger, $payFastData);
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
          },
          $payFastData
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
            if ($key != 'signature') {
                $payFastParamString .= $key . '=' . $val . '&';
            }
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
        $validIps = $this->getValidIpAddresses();

        return in_array($request->server('REMOTE_ADDR'), $validIps);
    }

    /**
     * @param $hostUrl
     * @param $serialisedPayFastData
     * @param $pfProxy
     *
     * @return mixed
     * @internal param $pfHost
     */
    protected function checkPaymentStatusCurl(
      $hostUrl,
      $serialisedPayFastData,
      $pfProxy = null
    ) {

        // Create default cURL object
        $ch = curl_init();

        // Set cURL options - Use curl_setopt for freater PHP compatibility
        // Base settings
        curl_setopt(
          $ch,
          CURLOPT_USERAGENT,
          self::PF_USER_AGENT
        );  // Set user agent
        curl_setopt(
          $ch,
          CURLOPT_RETURNTRANSFER,
          true
        );      // Return output as string rather than outputting it
        curl_setopt(
          $ch,
          CURLOPT_HEADER,
          false
        );             // Don't include header in output
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        // Standard settings
        curl_setopt($ch, CURLOPT_URL, $hostUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $serialisedPayFastData);
        curl_setopt($ch, CURLOPT_TIMEOUT, self::PF_TIMEOUT);
        if (!empty($pfProxy)) {
            curl_setopt($ch, CURLOPT_PROXY, $pfProxy);
        }

        // Execute CURL
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    /**
     * @param $pfHost
     * @param $serialisedPayFastData
     *
     * @return string
     */
    protected function checkPaymentStatusHttp($pfHost, $serialisedPayFastData)
    {
        $socket = $this->getSocket($pfHost);

        $header = $this->getHeader($pfHost, $serialisedPayFastData);

        fputs($socket, $header . $serialisedPayFastData);

        $response = $this->readResponse($socket);

        return $response;
    }

    /**
     * @param Request $request
     * @param Writer  $logger
     * @param         $payFastData
     */
    protected function updateOrderStatus(
      Request $request,
      Writer $logger,
      $payFastData
    ) {
        $order = Order::where('invoice_no', $request->input('m_payment_id'))
          ->first();

        switch ($payFastData['payment_status']) {
            case self::STATUS_COMPLETE:
                $logger->debug(self::PAYMENT_STATUS_COMPLETE);
                $order->status = strtolower(self::STATUS_COMPLETE);
                break;
            case self::STATUS_FAILED:
                $logger->error(self::PAYMENT_STATUS_FAILED);
                $order->status = strtolower(self::STATUS_FAILED);
                break;
            case self::STATUS_PENDING:
                $logger->debug(self::PAYMENT_STATUS_PENDING);
                $order->status = strtolower(self::STATUS_PENDING);
                break;
            default:
                $logger->error(self::PAYMENT_STATUS_DEFAULT);
                $order->status = self::ERROR;
                break;
        }

        $order->save();
    }

    /**
     *
     * @return array
     */
    protected function getValidIpAddresses()
    {
        $validIps = [];

        foreach ($this->validHosts as $payFastHostname) {

            $payFastIpAddress = gethostbynamel($payFastHostname);

            if ($payFastIpAddress !== false) {

                $validIps[] = $payFastIpAddress;
            }
        }

        $validIps = array_unique($validIps);

        return $validIps;
    }

    /**
     * @param $socket
     *
     * @return string
     */
    protected function readResponse($socket)
    {
        $response = '';
        $headerDone = false;

        while (!feof($socket)) {

            $line = fgets($socket, 1024);

            if ($headerDone) {
                $response .= $line;
                continue;
            }

            if (strcmp($line, "\r\n") == 0) {
                $headerDone = true;
            }
        }

        return $response;
    }

    /**
     * @param string $pfHost
     * @param string $serialisedPayFastData
     *
     * @return string
     */
    protected function getHeader($pfHost, $serialisedPayFastData)
    {
        $header = "POST /eng/query/validate HTTP/1.0\r\n";
        $header .= "Host: " . $pfHost . "\r\n";
        $header .= "User-Agent: " . self::PF_USER_AGENT . "\r\n";
        $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
        $header .= "Content-Length: " . strlen(
            $serialisedPayFastData
          ) . "\r\n\r\n";

        return $header;
    }

    /**
     * @param $pfHost
     *
     * @return resource
     */
    protected function getSocket($pfHost)
    {
        $socket = fsockopen(
          'ssl://' . $pfHost,
          443,
          $errno,
          $errstr,
          self::PF_TIMEOUT
        );

        return $socket;
    }
}
