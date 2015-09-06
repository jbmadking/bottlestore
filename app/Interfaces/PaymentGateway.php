<?php
/**
 *
 * @author      Joshua Bradshaw Matikinye
 * @email       joshua@samswebhosting.com
 * @copyright   Copyright (c) 2015 Sams Web Hosting
 */

use Illuminate\Http\Request;

interface PaymentGateway
{

    /**
     * @param $inputs
     *
     * @return mixed
     */
    public function cleanPostVariables($inputs);

    /**
     * @param $gatewayVariables
     *
     * @return
     */
    public function serialisePostVariables($gatewayVariables);

    /**
     * @param $signature
     * @param $serialisedData
     *
     * @return
     */
    public function hasValidSignature($signature, $serialisedData);

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function isValidGatewayHost($request);

}