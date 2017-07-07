<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;
use OrionMedical\Models\Customer;
use OrionMedical\Models\Event;
use OrionMedical\Models\Bill;
use OrionMedical\Models\ProcessedPolicy;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $customercount     =  Customer::count();
        $processedpolicies =  ProcessedPolicy::count();
        $endingpolicies    =  ProcessedPolicy::limit(5)->where('insurance_period_to','<=',Carbon::now())->get();
        $bills             =  Bill::where('status','Unpaid')->orderBy('created_on','desc')->limit(5)->get();
        $paidbills         =  Bill::get();
        $getactivities     =  DB::table('activity_log')->limit(5)->orderBy('created_at','desc')->get();
        $events            =  Event::orderBy('start_time','DESC')->get();
        $customers         =  Customer::orderBy('created_on','DESC')->take(5)->get();
        $visits            =  Customer::orderBy('created_on','DESC')->take(5)->get();
        $birthdays         =  Customer::whereRaw('DAYOFYEAR(curdate()) <= DAYOFYEAR(date_of_birth) AND DAYOFYEAR(curdate()) + 7 >=  dayofyear(date_of_birth)' )->get();
        return View('pages.dashboard', compact('getactivities','birthdays','processedpolicies','paidbills','customercount','events','customers','visits','bills','endingpolicies'));
    }


    public function getTotals()
    {


    	

    }




}
