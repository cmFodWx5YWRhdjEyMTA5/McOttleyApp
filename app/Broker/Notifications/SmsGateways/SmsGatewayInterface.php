<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 9/15/2015
 * Time: 9:47 PM
 */

namespace OrionMedical\Broker\Notifications\SmsGateways;


interface SmsGatewayInterface
{

    /**
     * Sends a single sms
     *
     * @return mixed
     */
    function sendSms($message, $number);

}