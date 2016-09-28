<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 9/15/2015
 * Time: 9:45 PM
 */

namespace App\MediBig\Notifications\SmsGateways\TextLocalSmsGateway;


use App\MediBig\Notifications\SmsGateways\SmsGatewayInterface;
use TxtLocal\TxtLocal;

class TextLocalSmsGateway implements SmsGatewayInterface
{

    /**
     * @param $message
     * @param $number
     * @return bool
     * @throws UndeliveredSmsException
     */
    public function sendSms($message, $number)
    {
        $config = config('sms.supported_gateways.textlocal');
        //dd($number);
        $api = new TxtLocal($config['username'], $config['hash'], false);

        $sender = $config['sender_name'];
        // get opening balance
        $openingBalance = $api->getSmsBalance();
        // send sms
        $api->sendSms([$number], $message, $sender);
        // check for billing
        if($openingBalance == $api->getSmsBalance())
        {
            throw new UndeliveredSmsException($number);
        }
        else
            return true;
    }


}