<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use OrionMedical\Models\PaymentType;
use OrionMedical\Models\BankAccount;
use OrionMedical\Models\PendingBills;
use OrionMedical\Models\Bill;
use OrionMedical\Models\Policy;
use OrionMedical\Models\Customer;
use OrionMedical\Models\Payments;
use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;
use Auth;
use Input;
use Response;
use Carbon\Carbon;
use Activity;

class InvoiceController extends Controller
{


     public function __construct()
    {
        $this->middleware('auth');
    }

    public function sendInvoices()
    {


    }



    public function getInvoices()
    {
        $paymenttypes = PaymentType::all();
        $bankaccounts = BankAccount::all();
        $bills          =  PendingBills::where('status','Unpaid')->orwhere('outstanding','>',0)->orderBy('created_on','desc')->paginate();
        return View('invoices.invoice',compact('paymenttypes','bankaccounts','bills'));
        
    }

     public function printInvoice($id)
   {

    $customerid = PendingBills::where('id' ,'=', $id)->pluck('account_number');
    $customers =  Customer::where('id' ,'=', $customerid)->first();
    $bills=Bill::where('id' ,'=', $id)->where('status', 'Unpaid')->orderBy('created_on', 'ASC')->get();
    return view('invoices.print', compact('customers','bills'));

    }

     public function getdebts()
    {

        return View('invoices.debtmanagement');
    }


     public function getinsurerreports()
    {

        return View('invoices.insurer');
    }

    public function getpayments()
    {
    	$paymenttypes = PaymentType::all();
    	$bankaccounts = BankAccount::all();
        $payments = Payments::paginate();
        return View('invoices.payment',compact('paymenttypes','bankaccounts','payments'));
    }

      public function dosendInvoices()
    {
    
        return View('invoices.sendinvoices');
    }



     public function createAccount(Request $request)
    {
    	  $this->validate($request, [
            'account_number'=> 'required|unique:bank_accounts|min:3',
            'bank_name'=> 'required',
            'currency'=> 'required',
            
            ]); 


           $bankaccount = new BankAccount;
           $bankaccount->bank_name  = $request->input('bank_name');
           $bankaccount->account_name = $request->input('account_name');
           $bankaccount->account_number = $request->input('account_number');
           $bankaccount->currency = $request->input('currency');
           $bankaccount->created_by = Auth::user()->getNameOrUsername();
           $bankaccount->created_on = Carbon::now();
          
           $bankaccount->save(); 
            return redirect()
            ->route('bank-accounts')
            ->with('info','Bank Account has successfully been created!');
    	
    }




public function generatePin()
{
   $number = Payments::count();
    $receiptnumber = str_pad($number+1,7, '0', STR_PAD_LEFT);
    $generate= 'RPT'.$receiptnumber;
    return  $generate;

}

    public function doPayment(Request $request)
    {



    		 $payments                      =  new Payments();
             $payments->payment_type        =  $request->input('payment_type');
             $payments->broker_bank_account =  $request->input('broker_bank_account');
             $payments->payment_date        =   Carbon::createFromFormat('d/m/Y', $request->input('payment_date'));
             $payments->payment_sum         =  $request->input('payment_sum');
             $payments->payer_name          =  $request->input('payer_name');

             $payments->payer_id            =  $request->input('payer_id');
             $payments->payer_account_number = $request->input('payer_account_number');
             $payments->reference_number    =  $request->input('reference_number');

             $payments->payment_description =  $request->input('payment_description');
             $payments->cash_receipt_number =  $request->input('cash_receipt_number');
             $payments->paymentid           =  $this->generatePin();

             $payments->created_by          =  Auth::user()->getNameOrUsername();
             $payments->created_on          =  Carbon::now();
             $payments->save();

            if($payments->save())
          {

             $affectedRows = Bill::where('invoice_number', '=', $request->input('reference_number'))
            ->update(array(
                           'status' => 'Paid'
                           ));

            Policy::where('policy_number', '=', $request->input('payer_account_number'))
            ->update(array(
                           'status' => 'Processed'
                           ));



            if($affectedRows > 0)
            {
                 Activity::log([
          'contentId'   =>  $request->input('reference_number'),
          'contentType' => 'User',
          'action'      => 'Create',
          'description' => 'Payment of '.$request->input('payment_sum').' on '.$request->input('payer_name').' account!',
          'details'     => 'Username: '.Auth::user()->getNameOrUsername(),
          ]);


             return redirect()
            ->route('invoice')
            ->with('success','Payment processed successfully!');
            }

            else
            {
                 return redirect()
            ->route('invoice')
            ->with('warning','Error processing payments!');
            }


          
          }

          else
          {

             return redirect()
            ->route('invoice')
            ->with('error','payment failed to create!');
          }


    }


    public function fetchInvoiceDetails()
    {
      //dd($opd_id);
    $id = Input::get('id');
    $user = PendingBills::find($id);
    $data = Array(
        'payer_id'=>$user->account_number,
        'payer_name'=>$user->account_name,
        'amount'=>$user->outstanding,
        'reference_number'=>$user->invoice_number,
        'policy_number'=>$user->policy_number,
       
    );
        return Response::json($data);
    }



}
