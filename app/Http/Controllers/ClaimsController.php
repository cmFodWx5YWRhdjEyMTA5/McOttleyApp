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

use OrionMedical\Models\AttachDocuments;

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
        
         $claims          = ClaimProcessed::where('id',$id)->get()->first();
        $images          = AttachDocuments::where('accountnumber', $claims->claim_number )->get();
        return View('claims.view',compact('claims','images'));
    }

 
 
    public function createClaim()
    {
    $images          = AttachDocuments::all();
    $policies        = ProcessedPolicy::all();
    $status_of_claim = ClaimStatus::all();
    $intermediary    = User::orderby('username','ASC')->get();
    $loss_causes     = LossCause::all();

    return view('claims.new', compact('intermediary','images','status_of_claim','loss_causes','policies','claims'));
    }

    public function editClaim($id)
    {

    $policies        = ProcessedPolicy::all();
    $status_of_claim = ClaimStatus::all();
    $intermediary    = User::orderby('username','ASC')->get();
    $loss_causes     = LossCause::all();
    $claimdetails    = ClaimProcessed::find($id);
    return view('claims.edit', compact('intermediary','claimdetails','status_of_claim','loss_causes','policies','claims'));
    }


    
     public function generateClaimNumber()
    {
        $number = Claim::count();
        $claimnumber = str_pad($number+1,7, '0', STR_PAD_LEFT);
        $generate= 'CL'.$claimnumber;
        return  $generate;
    }

    public function change_date_format($date)
    {
        $time = DateTime::createFromFormat('d/m/Y H:i:s', $date);
        return $time->format('Y-m-d H:i:s');
    }

    public function addClaim(Request $request)
    {
       

       
        $claimnumber = $this->generateClaimNumber();
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
                                  'contentId'   =>  $claimnumber,
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


      public function updateClaim(Request $request)
    {

      try {

             $affectedRows = Claim::where('claim_number','=' , $request->input('claimid'))
            ->update(array(
                           
                           'status_of_claim' =>  $request->input('status_of_claim'),
                           'insurer_reference_id' =>  $request->input('insurer_reference_id'),
                           'loss_date' => $this->change_date_format($request->input('loss_date')), 
                           'submit_broker_date' => $this->change_date_format($request->input('submit_broker_date')), 
                           'submit_insurer_date' => $this->change_date_format($request->input('submit_insurer_date')), 
                           'settlement_date' =>  $this->change_date_format($request->input('settlement_date')), 
                           'location_of_loss'=>$request->input('location_of_loss'),
                           'loss_amount'=>$request->input('loss_amount'),
                           'excess_amount' => $request->input('excess_amount'),
                           'insurer_contact_name'=> $request->input('insurer_contact_name'),
                           'insurer_contact_email'=>$request->input('insurer_contact_email'),
                           'insurer_contact_phone'=>$request->input('insurer_contact_phone'),
                           'loss_cause'=> $request->input('loss_cause'),
                           'loss_description' => $request->input('loss_description'),
                           'updated_by'=> Auth::user()->getNameOrUsername(),
                           'updated_on'=>Carbon::now()));

            if($affectedRows > 0)
            {
                Activity::log([
          'contentId'   =>  $request->input('policy_number'),
          'contentType' => 'User',
          'action'      => 'Update',
          'description' => 'Updated claims details of '.$request->input('policy_number'),
          'details'     => 'Username: '.Auth::user()->getNameOrUsername(),
          ]);
        
             
              return redirect()
            ->route('claims')
            ->with('success','Claim has successfully been updated!');
            }
            else
            {
               return redirect()
            ->route('claims')
            ->with('error','Claim failed to update!');
            }
          }


    catch (\Exception $e) {
           
           echo $e->getMessage();
            
        }
           

    }

    

}
