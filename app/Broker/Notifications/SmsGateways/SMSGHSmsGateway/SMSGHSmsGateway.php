<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 9/19/2015
 * Time: 5:13 AM
 */

namespace OrionMedical\Broker\Notifications\SmsGateways\SMSGHSmsGateway;


use OrionMedical\Broker\Notifications\SmsGateways\SmsGatewayInterface;

class SMSGHSmsGateway implements SmsGatewayInterface
{


    private $apiMessage;

    private $senderName;


    public function __construct()
    {
        $apiPath = app_path().'/OrionMedical/Broker/Api/SMSGH/Smsgh/Api.php';

        if(file_exists($apiPath))
        {
            require_once $apiPath;
        }
        else
            dd('API not found!');

        $this->initialize();
    }


    private function initialize()
    {
        $config = config('sms.supported_gateways.smsgh');

        $auth = new \BasicAuth($config['clientID'], $config['secret']);
        $apiHost = new \ApiHost($auth);
        $enableConsoleLog = TRUE;

        $this->apiMessage = new \MessagingApi($apiHost, $enableConsoleLog);
        $this->senderName = $config['sender_name'];
    }


    protected function getApiMessage()
    {
        return $this->apiMessage;
    }

    protected function getSenderName()
    {
        return $this->senderName;
    }

    /**
     * Sends a single sms
     *
     * @return mixed
     */
    public function sendSms($message, $number)
    {
        try
        {
            $smsghMessage = new \Message();
            $smsghMessage->setContent($message);
            $smsghMessage->setTo($number);
            $smsghMessage->setFrom($this->getSenderName());
            $smsghMessage->setRegisteredDelivery(true);

            $messageResponse = $this->getApiMessage()->sendMessage($smsghMessage);

            if ($messageResponse instanceof \MessageResponse) {
                echo $messageResponse->getStatus();
            } elseif ($messageResponse instanceof \HttpResponse) {
                echo "\nServer Response Status : " . $messageResponse->getStatus();
            }
        }
        catch(\Exception $ex)
        {
            dd($ex);
        }
    }


}