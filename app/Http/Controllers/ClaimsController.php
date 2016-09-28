<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use OrionMedical\Models\User;
use OrionMedical\Models\Customer;
use OrionMedical\Models\ClaimStatus;
use OrionMedical\Models\SelectStatus;
use OrionMedical\Models\Currency;
use OrionMedical\Models\Insurers;
use OrionMedical\Models\ProcessedPolicy;
use OrionMedical\Models\LossCause;
use OrionMedical\Models\Claim;
use OrionMedical\Models\ClaimProcessed;

use OrionMedical\Models\MediaFiles;

use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;
use DB;
use Auth;
use Activity;
use Input;
use Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use DateTime;

class ClaimsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

         $claims          = ClaimProcessed::paginate();
        return View('claims.index',compact('claims'));
    }

     public function claimprofile($id)
    {
         $images          = MediaFiles::all();
         $claims          = ClaimProcessed::where('id',$id)->get()->first();
        return View('claims.view',compact('claims','images'));
    }

 
 
    public function createClaim()
    {
    $images          = MediaFiles::all();
    $policies        = ProcessedPolicy::all();
    $status_of_claim = ClaimStatus::all();
    $intermediary    = User::orderby('username','ASC')->get();
    $loss_causes     = LossCause::all();

    return view('claims.new', compact('intermediary','images','status_of_claim','loss_causes','policies','claims'));
    }

    
     public function generateClaimNumber($length)
    {
    $number = '';

    do 
    {
        for ($i=$length; $i--; $i>0) 
        {
            $number .= mt_rand(0,9);
        }
    } while ( !empty(Claim::where('id', $number)->first(['id'])) );

    return 'C'.$number;
    }

    public function change_date_format($date)
    {
        $time = DateTime::createFromFormat('d/m/Y H:i:s', $date);
        return $time->format('Y-m-d H:i:s');
    }

    public function addClaim(Request $request)
    {
       

       
        $claimnumber = uniqid(); //$this->generateClaimNumber(6);
        //Policy Details
        $claim                          = new Claim;
        $claim->claim_number            = $claimnumber;  
        $claim->policy_number           = $request->input('policy_number');  
        $claim->status_of_claim         = $request->input('status_of_claim');
        $claim->insurer_reference_id    = $request->input('insurer_reference_id');
        $claim->loss_date               = $this->change_date_format($request->input('loss_date'));
        $claim->submit_broker_date      = $this->change_date_format($request->input('submit_broker_date'));
        $claim->submit_insurer_date     = $this->change_date_format($request->input('submit_insurer_date'));
        $claim->settlement_date         = $this->change_date_format($request->input('settlement_date'));
        $claim->claim_handler           = $request->input('claim_handler');
        $claim->location_of_loss        = $request->input('location_of_loss');
        $claim->loss_amount             = $request->input('loss_amount');
        $claim->excess_amount           = $request->input('excess_amount');
        $claim->insurer_contact_name    = $request->input('insurer_contact_name');
        $claim->insurer_contact_email   = $request->input('insurer_contact_email');
        $claim->insurer_contact_phone   = $request->input('insurer_contact_phone');
        $claim->loss_cause              = $request->input('loss_cause');
        $claim->loss_description        = $request->input('loss_description'); 
        $claim->claimant_insured_status = $request->input('claimant_insured_status');
        $claim->created_by              = Auth::user()->getNameOrUsername();
        $claim->created_on              = Carbon::now(); 
        

         if($claim->save())
          {



        
                                   Activity::log([
                                  'contentId'   =>  $request->input('account_number'),
                                  'contentType' => 'User',
                                  'action'      => 'Create',
                                  'description' => 'Claim for '.$claimnumber.' - '.$request->input('policy_number').' was created successfully!',
                                  'details'     => 'Username: '.Auth::user()->getNameOrUsername(),
                                  ]);


                                    $data = array(
                                    'fullname' => $request->input('billed_to'),
                                   );


                                    

                                    Mail::queue('email.welcome', $data, function($message)
                                    {
                                        $message->to('echo.jasonkerr7@gmail.com', 'Jason')->subject('Welcome!');
                                    });
                                
                                    return redirect()
                                    ->route('claims')
                                    ->with('success','Claim has successfully been created!');

                                  

                                }

                             
          

          else
          {

             return redirect()
            ->route('claims')
            ->with('error','Claim failed to create!');
          }
      }

    

}
