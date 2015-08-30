<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Log\Writer;
use Illuminate\Support\Facades\Auth;
use Monolog\Handler\ErrorLogHandler;
use Monolog\Logger;

class PaymentController extends Controller
{

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
     * @param Request                $request
     *
     * @param \Illuminate\Log\Writer $logger
     *
     * @return \App\Http\Controllers\Response
     */
    public function notify(Request $request, Writer $logger)
    {

        $logger->useFiles('payFast.log');

        //Notify Payfast
        header('HTTP/1.0 200 OK');
        flush();

        // Store Posted variables from ITN

        if (empty($_GET)) {

            $logger->error('Error -- POST variables not set');

            exit();
        }

        $logger->debug('Posted Variables --' . "\n" . implode("\n", $_GET));

        $payFastData = $this->cleanPostVariables($_GET);

        $serialisedPayFastData = $this->serialisePostVariables($payFastData);

        $this->checkPostedVariables($payFastData, $serialisedPayFastData, $logger);

        //Save the posted information


        // Verify source IP
        $validHosts = [
            'www.payfast.co.za',
            'sandbox.payfast.co.za',
            'w1w.payfast.co.za',
            'w2w.payfast.co.za'
        ];

        $validIps = [];

        foreach ($validHosts as $pfHostname) {
            $ips = gethostbynamel($pfHostname);

            if ($ips !== false)
                $validIps = array_merge($validIps, $ips);
        }

        $validIps = array_unique($validIps);

        if (!in_array($_SERVER['REMOTE_ADDR'], $validIps)) {

            $logger->error('Error -- Invalid IP Address');

            die();
        }

        $response = '';

        if (in_array('curl', get_loaded_extensions())) {
            // Variable initialization
            $url = 'https://' . $pfHost . '/eng/query/validate';

            // Create default cURL object
            $ch = curl_init();

            // Set cURL options - Use curl_setopt for freater PHP compatibility
            // Base settings
            curl_setopt($ch, CURLOPT_USERAGENT, PF_USER_AGENT);  // Set user agent
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);      // Return output as string rather than outputting it
            curl_setopt($ch, CURLOPT_HEADER, false);             // Don't include header in output
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            // Standard settings
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payFastParamString);
            curl_setopt($ch, CURLOPT_TIMEOUT, PF_TIMEOUT);
            if (!empty($pfProxy))
                curl_setopt($ch, CURLOPT_PROXY, $proxy);

            // Execute CURL
            $response = curl_exec($ch);
            curl_close($ch);
        } else {

            $header = '';
            $res = '';
            $headerDone = false;

            // Construct Header
            $header = "POST /eng/query/validate HTTP/1.0\r\n";
            $header .= "Host: " . $pfHost . "\r\n";
            $header .= "User-Agent: " . PF_USER_AGENT . "\r\n";
            $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
            $header .= "Content-Length: " . strlen($payFastParamString) . "\r\n\r\n";

            // Connect to server
            $socket = fsockopen('ssl://' . $pfHost, 443, $errno, $errstr, PF_TIMEOUT);

            // Send command to server
            fputs($socket, $header . $payFastParamString);

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

        switch ($payFastData['payment_status']) {
            case 'COMPLETE':
                $logger->debug('Payment Status -- COMPLETE');
                break;
            case 'FAILED':
                $logger->error('Payment Status -- FAILED');
                break;
            case 'PENDING':
                $logger->debug('Payment Status -- PENDING');
                break;
            default:
                $logger->error('Payment Status -- DEFAULT');
                break;
        }

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
                stripslashes($val);
            }, $payFastData
        );
    }

    /**
     * @param $payFastData
     * @param $payFastParamString
     * @param $logger
     *
     * @return array
     * @internal param $payFastData
     */
    protected function checkPostedVariables($payFastData, $payFastParamString, $logger)
    {


        // Remove the last '&' from the parameter string
        $payFastParamString = substr($payFastParamString, 0, -1);
        $signature = md5($payFastParamString);

        if (!isset($payFastData['signature'])) {

            $logger->debug('Error -- No Signature sent');
        }
        if ($signature) {

            $output = "Error -- Signature mismatch\n\n";
            $output .= "Security Signature:\n\n";
//            $output .= "\t- posted     = " . $payFastData['signature'] . "\n";
            $output .= "\t- calculated = " . $signature . "\n";
//            $output .= "\t- result     = " . ($result ? 'SUCCESS' : 'FAILURE') . "\n";

            $logger->error($output);


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
// Dump the submitted variables and calculate security signature
        $payFastParamString = '';
        foreach ($payFastData as $key => $val) {
            if ($key != 'signature')
                $payFastParamString .= $key . '=' . urlencode($val) . '&';
        }

        return $payFastParamString;
    }
}
