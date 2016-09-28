<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use JasperPHP\JasperPHP;
use OrionMedical\Http\Requests;
use OrionMedical\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
   
    public function statsreports()
    {
        return view('reporting.overview');
    }

     public function reportsmain()
    {
        return view('reporting.index');
    }

    //Policy

     public function endingPolicy()
    {
        return view('reporting.policies.ending');
    }

    public function cancelledPolicy()
    {
        return view('reporting.policies.cancelled');
    }
    
    public function installmentPolicy()
    {
        return view('reporting.policies.installments');
    }

     public function renewalPolicy()
    {
        return view('reporting.policies.renewal');
    }

     public function activePolicy()
    {
        return view('reporting.policies.active');
    }
    
         public function registeredPolicy()
    {
        return view('reporting.policies.registered');
    }

          public function salesSummary()
    {
        return view('reporting.sales.summary');
    }

     public function salesMain()
    {
        return view('reporting.sales.main');
    }
 
    public function salesCommission()
    {
        return view('reporting.sales.commission');
    }
 
    public function salesMoneyflow()
    {
        return view('reporting.sales.moneyflow');
    }

      public function generatedInvoices()
    {
        return view('reporting.customer.generatedinvoice');
    }

      public function installmentsUnpaid()
    {
        return view('reporting.customer.installmentsunpaid');
    }

     public function overPaid()
    {
        return view('reporting.customer.overpaid');
    }
 
    public function customerPayments()
    {
        return view('reporting.customer.payment');
    }

    public function receivableDetails()
    {
        return view('reporting.customer.receivabledetails');
    }

    public function receivableSummary()
    {
        return view('reporting.customer.receivablesummary');
    }

    public function customersUnpaid()
    {
        return view('reporting.customer.unpaid');
    }
 
 

 
    
}
