<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use OrionMedical\Models\PaymentType;
use OrionMedical\Models\BankAccount;
use OrionMedical\Models\PendingBills;
use OrionMedical\Models\Bill;
use OrionMedical\Models\Serials;
use OrionMedical\Models\Policy;
use OrionMedical\Models\Customer;
use OrionMedical\Models\Payments;
use OrionMedical\Models\User;
use OrionMedical\Models\Currency;
use OrionMedical\Models\ProformaInvoice;
use OrionMedical\Models\PolicyProductType;
use OrionMedical\Models\Taxes;
use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;
use Auth;
use Input;
use Response;
use Carbon\Carbon;
use Activity;
use PDF;
use DB;
use DateTime;


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
        $bills          =  PendingBills::where('status','<>','Paid')->orderBy('created_on','desc')->paginate(30);
        return View('invoices.invoice',compact('paymenttypes','bankaccounts','bills'));
        
    }

     public function getCommissions()
    {
        $stickercharge =  Taxes::where('tax','Sticker')->pluck('rate');
        $broker_tax_rate =  Taxes::where('tax','Broker tax')->pluck('rate');
        $bills =  PendingBills::orderBy('created_on','desc')->paginate(30);
        return View('commission.index',compact('bills','stickercharge','broker_tax_rate'));
        
    }


    public function doCommissionPaid()
    {       
        
        $billid = Input::get("ID");
        $commssionamount = Input::get("amountpaid");


            $affectedRows = Bill::where('id', '=', $billid)->update(array('commission' => 'Paid','commission_amount' => $commssionamount ));

            if($affectedRows > 0)
            {

                $ini = array('OK'=>'OK');
                return  Response::json($ini);
            }
            else
            {
                $ini = array('No Data'=>'No Data');
                return  Response::json($ini);
            }


    }

    public function printProforma($id)
    {

    $bills=ProformaInvoice::where('id' ,'=', $id)->first();
    return view('invoices.quick_print', compact('bills'));


    }

    public function loadProformaInvoices()
    {

    $customers =  Customer::all();
    $producttypes = PolicyProductType::orderby('type','asc')->get();
    $currencies   = Currency::all();
    $users =  User::all();

    $bills =  ProformaInvoice::orderBy('created_on','desc')->paginate(30);
    return view('invoices.quick_invoices', compact('customers','bills','producttypes','currencies','users'));
    }


    public function change_date_format($date)
    {
        $time = DateTime::createFromFormat('d/m/Y', $date);
        return $time->format('Y-m-d');
    }

    public function generateInoviceNumber()
    {
    $number = Serials::where('name','=','proforma')->first();
    $number = $number->counter;
    $account = str_pad($number,7, '0', STR_PAD_LEFT);
    $myaccount= 'PRO'.$account;

    Serials::where('name','=','proforma')->increment('counter',1);
    return  $myaccount;
    }

    public function createProforma(Request $request)
    {
         $time = explode(" - ", $request->input('insurance_period'));
         $invoicenumberval = $this->generateInoviceNumber(10);

           $invoice = new ProformaInvoice;
           $invoice->invoice_number  = $invoicenumberval;
           $invoice->account_name  = $request->input('account_holder');
           $invoice->business_class = $request->input('business_class');
           $invoice->account_manager = $request->input('account_manager');
           $invoice->currency = $request->input('currency');
           $invoice->sum_insured = $request->input('sum_insured');
           $invoice->gross_premium = $request->input('gross_premium');
           $invoice->status = $request->input('status');
           $invoice->description = $request->input('description');
           $invoice->insurance_period_from  = $this->change_date_format($time[0]);
           $invoice->insurance_period_to    = $this->change_date_format($time[1]);
           $invoice->created_by = Auth::user()->getNameOrUsername();
           $invoice->created_on = Carbon::now();
          
           $invoice->save(); 
            return redirect()
            ->route('/quick-invoices')
            ->with('info','Invoice has successfully been created!');
    }



     public function printInvoice($id)
   {

    $customerid = PendingBills::where('id' ,'=', $id)->pluck('account_number');
    $customers =  Customer::where('id' ,'=', $customerid)->first();
    $bills=Bill::where('id' ,'=', $id)->first();
    return view('invoices.print', compact('customers','bills'));

    }

    public function printtoPDF($id)
    {
        $customerid = PendingBills::where('id' ,'=', $id)->pluck('account_number');
        $customers =  Customer::where('id' ,'=', $customerid)->first();
        $bills=Bill::where('id' ,'=', $id)->where('status', 'Unpaid')->orderBy('created_on', 'ASC')->first();

        $pdf = PDF::loadView('invoices.print', compact('customers','bills'));
        return $pdf->download('invoice.pdf');

    }

     public function getdebts()
    {
        $bills=PendingBills::where('status', 'Unpaid')->paginate(30);
        return View('invoices.debtmanagement',compact('bills'));
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

    public function searchInvoice(Request $request)
    {
      

        $this->validate($request, [
            'search' => 'required'
        ]);

        $search = $request->get('search');

        $paymenttypes = PaymentType::all();
        $bankaccounts = BankAccount::all();
        $bills        =  PendingBills::where('status','Unpaid')->where('account_name', 'like', "%$search%")
            ->orWhere('invoice_number', 'like', "%$search%")
            ->orWhere('policy_number', 'like', "%$search%")
            ->orderBy('created_on','desc')
            ->paginate(30)
            ->appends(['search' => $search])
        ;


       return View('invoices.invoice',compact('paymenttypes','bankaccounts','bills'));
  
    }

    public function searchCommission(Request $request)
    {
      

        $this->validate($request, [
            'search' => 'required'
        ]);

        $search = $request->get('search');


        $stickercharge =  Taxes::where('tax','Sticker')->pluck('rate');
        $broker_tax_rate =  Taxes::where('tax','Broker tax')->pluck('rate');
        $bills        =  PendingBills::where('account_name', 'like', "%$search%")
            ->orWhere('invoice_number', 'like', "%$search%")
            ->orWhere('policy_number', 'like', "%$search%")
            ->orWhere('policy_product', 'like', "%$search%")
            ->orWhere('policy_insurer', 'like', "%$search%")
             ->orWhere('status', 'like', "$search%")
            ->orWhere('currency', 'like', "%$search%")
            ->orderBy('created_on','desc')
            ->paginate(30)
            ->appends(['search' => $search])
        ;


       return View('commission.index',compact('bills','stickercharge','broker_tax_rate'));
  
    }

   



public function generatePin()
{
    $number = Serials::where('name','=','receipt')->first();
    $number = $number->counter;
    $account = str_pad($number,7, '0', STR_PAD_LEFT);
    $myaccount= 'RPT'.$account;

    Serials::where('name','=','receipt')->increment('counter',1);
    return  $myaccount;

}

    public function doPayment(Request $request)
    {


            $flag = 'Unpaid';

            if($request->input('payment_sum') < $request->input('premium'))
            {
                $flag = 'Partially Paid';
            }

            else
            {
                $flag = 'Paid';
            }


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

             $affectedRows = Bill::where('invoice_number', '=', $request->input('reference_number'))->increment('paid_amount',$request->input('payment_sum'),['status'=> $flag,'last_payment_date'=> Carbon::now()]);
        

            Policy::where('policy_number', '=', $request->input('payer_account_number'))
            ->update(array(
                           'status' => 'Running'
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
        'payer_id'          =>$user->account_number,
        'payer_name'        =>$user->account_name,
        'amount'            =>$user->amount-$user->paid_amount,
        'payable'           =>$user->amount-$user->paid_amount,
        'reference_number'  =>$user->invoice_number,
        'policy_number'     =>$user->policy_number,
       
    );
        return Response::json($data);
    }



}
