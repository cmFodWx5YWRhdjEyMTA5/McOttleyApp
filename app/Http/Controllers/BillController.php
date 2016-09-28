<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use OrionMedical\Models\Bill;
use OrionMedical\Models\Customer;
use OrionMedical\Models\Prescription;
use OrionMedical\Models\Consultation;
use OrionMedical\Models\Payments;
use OrionMedical\Models\BalanceSheet;
use OrionMedical\Http\Requests;
use DB;
use OrionMedical\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Input;
use Response;
use Carbon\Carbon;
use Auth;
use PDF;



class BillController extends Controller
{
     public function __construct()
    {

        $this->middleware('role:Billing|System Admin');
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function patientEnquiry()
    {

        return view('errors.503');
    }

    public function getPatientBill($id)
   {

    $patientid=Bill::where('visit_id' ,'=', $id)->pluck('patient_id');

    $patients =  Customer::where('patient_id' ,'=', $patientid)->get();

    $balances=BalanceSheet::where('patient_id' ,'=', $patientid)->get();
    //dd($balances);
    $bills=Bill::where('visit_id' ,'=', $id)->where('note', 'Unpaid')->orderBy('date', 'ASC')->get();
    $receiptmodes=DB::table('receipt_mode')->get();
    return view('billing.invoice', compact('patients','bills','receiptmodes','balances'));
}

 public function printBill($id)
   {

    $patientid=Bill::where('visit_id' ,'=', $id)->pluck('patient_id');
    $patients =  Customer::where('patient_id' ,'=', $patientid)->get();
    $bills=Bill::where('visit_id' ,'=', $id)->where('note', 'Unpaid')->orderBy('date', 'ASC')->get();
    return view('billing.print', compact('patients','bills'));

    }

    public function emailBill($id)
   {

    $patientid=Bill::where('visit_id' ,'=', $id)->pluck('patient_id');
    $patients =  Customer::where('patient_id' ,'=', $patientid)->get();
    $bills=Bill::where('visit_id' ,'=', $id)->where('note', 'Unpaid')->orderBy('date', 'ASC')->get();
    return view('billing.invoice', compact('patients','bills'));

    }


public function index()
   {

    $bills=Bill::where('note', 'Unpaid')->orderBy('date', 'DESC')->paginate(30);
    $receiptmodes=DB::table('receipt_mode')->get();
      
    return view('billing.index', compact('bills','receiptmodes'));

    }

    public function downloadpendinginvoices(Request $request)
    {
        $bills=Bill::where('note', 'Unpaid')->orderBy('date', 'DESC')->get();
        $receiptmodes=DB::table('receipt_mode')->get();

       // $items = DB::table("items")->get();
        view()->share('bills',$bills);

        if($request->has('download')){
            $pdf = PDF::loadView('billing.index');
            return $pdf->download('billing.index');
        }

        return view('billing.index', compact('bills','receiptmodes'));
    }


public function dashboard()
   {

    $bills=Bill::orderBy('date', 'DESC')->paginate(30);
      
    return view('billing.dashboard', compact('bills'));

    }


    public function getBillitems(Request $request)
    {
    try
    {

            $opd_number = Input::get("opd_number");
            $bills=Bill::where('visit_id' , $opd_number)->where('note', 'Unpaid')->orderBy('date', 'ASC')->get();
            return  Response::json($bills);        
    }

    catch (\Exception $e) 
    {
           echo $e->getMessage();
        
    }
    }

    public function fetchbilldetails()
    {
      //dd($opd_id);
    $id = Input::get('id');
    $user = Bill::find($id);
    $data = Array(
        'patient_id'=>$user->patient_id,
        'visit_id'=>$user->visit_id,
        'fullname'=>$user->fullname,
      
    );
        return Response::json($data);
    }

    function generatePin($number) 
      {
        $alpha = array();
    for ($u = 65; $u <= 90; $u++) {
        // Uppercase Char
        array_push($alpha, chr($u));
    }

  

    // Get random alpha character
    $rand_alpha_key = array_rand($alpha);
    $rand_alpha = $alpha[$rand_alpha_key];

    // Add the other missing integers
    $rand = array($rand_alpha);
    for ($c = 0; $c < $number - 1; $c++) {
        array_push($rand, mt_rand(0, 9));
        shuffle($rand);
    }

    return implode('', $rand);
    }


    public function doPayment(Request $request)
    {


        $payments = new Payments();
        $payments->PaymentID =  $this->generatePin(15);
        $payments->PatientID =  $request->input('patient_id');
        $payments->EventID=$request->input('visit_id');
        $payments->AmountReceived =  $request->input('amountreceived');
        $payments->Currency =  'GHS';
        $payments->Narration =  'Medical Bill Payments';
        $payments->PaymentMethod= $request->input('paymentmethod');
        $payments->RefNumber= $request->input('referencenumber');
        $payments->CreateDate= Carbon::now();
        $payments->CreatedBy = Auth::user()->getNameOrUsername();
        $payments->LastModifiedTime =  Carbon::now();
        
        if($payments->save())
        {

            $affectedRows = Bill::where('visit_id', '=', $request->input('visit_id'))
            ->update(array(
                           'note' => 'Paid'
                           ));


            if($affectedRows > 0)
            {
             return redirect()
            ->route('billing-index')
            ->with('info','Payment has successfully been processed!');
            }

            else
            {
                 return redirect()
            ->route('billing-index')
            ->with('warning','Error processing payments!');
            }

        }

        else
        {

              return redirect()
            ->route('billing-index')
            ->with('warning','Error processing payments!');

        } 
    
    }

    public function getSearchResults(Request $request)
    {
    
     
   

        $this->validate($request, [
            'search' => 'required'
        ]);

        $search = $request->get('search');
        $receiptmodes=DB::table('receipt_mode')->get();
        $bills = Bill::where('note', 'Unpaid')->where('fullname', 'like', "%$search%")
            ->orWhere('patient_id', 'like', "%$search%")
            ->orderBy('fullname')
            ->paginate(30)
            ->appends(['search' => $search])
        ;

            return view('billing.index', compact('bills','receiptmodes'));
    
    }

    public function doEnquiry(Request $request)
    {
    
     
   

        $this->validate($request, [
            'search' => 'required'
        ]);

        $search = $request->get('search');
        $receiptmodes=DB::table('receipt_mode')->get();
        $bills = Bill::where('note', 'Unpaid')->where('fullname', 'like', "%$search%")
            ->orWhere('patient_id', 'like', "%$search%")
            ->orderBy('fullname')
            ->paginate(30)
            ->appends(['search' => $search])
        ;

            return view('billing.index', compact('bills','receiptmodes'));
    
    }




}
