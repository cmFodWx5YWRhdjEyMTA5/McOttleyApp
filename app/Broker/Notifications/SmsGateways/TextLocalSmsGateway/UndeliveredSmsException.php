<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 9/16/2015
 * Time: 11:34 AM
 */

namespace App\MediBig\Notifications\SmsGateways\TextLocalSmsGateway;


class UndeliveredSmsException extends \Exception
{

    const SMS_UNDELIVERED_CODE = 5333;

    public function __construct($number)
    {
        parent::__construct('Sms could not be sent to '. $number, self::SMS_UNDELIVERED_CODE);
    }

}