<?php
/**
 * Created by PhpStorm.
 * User: Bright
 * Date: 9/16/2015
 * Time: 3:10 AM
 */

namespace OrionMedical\Broker\Notifications\EmailGateways;


use Illuminate\Support\Facades\Mail;

class LaravelEmailGateway implements EmailGatewayInterface
{
    public function sendEmail($to, $message, $subject = null, $data = [])
    {
        Mail::send($message, $data, function($message) use ($to, $subject) {
           $message->to($to)->subject($subject);
        });
    }

}