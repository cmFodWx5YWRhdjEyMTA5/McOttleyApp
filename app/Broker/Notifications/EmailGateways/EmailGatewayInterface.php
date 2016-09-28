<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 9/16/2015
 * Time: 3:09 AM
 */

namespace OrionMedical\Broker\Notifications\EmailGateways;


interface EmailGatewayInterface
{

    function sendEmail($to, $message, $subject = null, $data = []);

}