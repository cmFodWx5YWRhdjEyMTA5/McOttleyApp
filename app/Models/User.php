<?php

namespace OrionMedical\Models;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

use Zizaco\Entrust\Traits\EntrustUserTrait;



class User extends Model implements AuthenticatableContract
                                    
{

    use Authenticatable ;
    use EntrustUserTrait ;
        

    protected $table = 'users';

    protected $fillable = [
    'username', 
    'email', 
    'password',
    'fullname',
    'location',
    'usertype'
    ];

    protected $hidden = [ 
    'password', 
    'remember_token'];

    public function getFullname()
    {

        if($this->fullname)
        {
            return $this->fullname;
        }
        
        return null;

    }

     public function getNameOrUsername()
    {

            return $this->getFullname() ?: $this->username;

    }

  

     public function getRole()
    {

            return $this->usertype;

    }

    public function sendSmsMessage($message, SmsGatewayInterface $smsGateway)
    {
        try
        {
            $smsGateway->sendSms($message, $this->mobilenumber);
        }
        catch(UndeliveredSmsException $ex)
        {
            // Log message not sent in queue
            throw $ex;
        }
    }






}
