<?php

namespace OrionMedical\Http\Controllers;

use Illuminate\Http\Request;
use OrionMedical\Models\User;
use OrionMedical\Models\Customer;
use OrionMedical\Models\SalesChannel;
use OrionMedical\Models\SalesType;
use OrionMedical\Models\PolicyType;

use OrionMedical\Models\PolicyProductType;
use OrionMedical\Models\VehicleModel;
use OrionMedical\Models\VehicleMake;
use OrionMedical\Models\VehicleType;
use OrionMedical\Models\VehicleUse;
use OrionMedical\Models\SelectStatus;
use OrionMedical\Models\Currency;
use OrionMedical\Models\FireRoofed;
use OrionMedical\Models\FireWalled;
use OrionMedical\Models\FireRisk;
use OrionMedical\Models\FireDetails;
use OrionMedical\Models\CollectionMode;
use OrionMedical\Models\Policy;
use OrionMedical\Models\MotorDetails;
use OrionMedical\Models\Bill;
use OrionMedical\Models\ProcessedPolicy;
use OrionMedical\Models\TravelDetails;
use OrionMedical\Models\Country;
use OrionMedical\Models\Beneficiary;
use OrionMedical\Models\MaritalStatus;
use OrionMedical\Models\Accident;
use OrionMedical\Models\NCD;
use OrionMedical\Models\Loadings;
use OrionMedical\Models\FleetDiscount;
use OrionMedical\Models\BuyBackExcess;
use OrionMedical\Models\BondTypes;
use OrionMedical\Models\CustomerBalanceSheet;
use OrionMedical\Models\ClaimProcessed;

use OrionMedical\Models\NatureofAcccident;
use OrionMedical\Models\NatureofWork;

use OrionMedical\Models\BondDetails;

use OrionMedical\Models\MortgageCompanies;
use OrionMedical\Models\PropertyType;
use OrionMedical\Models\EngineeringDetails;
use OrionMedical\Models\AccidentDetails;

use OrionMedical\Models\MarineDetails;
use OrionMedical\Models\MarineRisktypes;
use OrionMedical\Models\AccidentRiskType;
use OrionMedical\Models\LiabilityRiskTypes;
use OrionMedical\Models\LiabilityDetails;
use OrionMedical\Models\EngineeringRisktypes;

use OrionMedical\Models\Insurers;
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
use Excel;

class PolicyController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $policies = ProcessedPolicy::orderby('id','desc')->paginate(30);
        return View('policy.index',compact('policies'));
    }

    public function excludePolicy()
   {
        if(Input::get("ID"))
        {
            $ID = Input::get("ID");
            $affectedRows = Policy::where('id', '=', $ID)->delete();

            if($affectedRows > 0)
            {
                $ini   = array('OK'=>'OK');
                return  Response::json($ini);
            }
            else
            {
                $ini   = array('No Data'=>$ID);
                return  Response::json($ini);
            }
        }
        else
        {
           $ini   = array('No Data'=>'No Data');
           return  Response::json($ini);
        }

   }

   public function loadncd()
   {

     try
    {

            $vehicle_use = Input::get("vehicle_use");
            $use_types = NCD::where('use',$vehicle_use)->get();
            return  Response::json($use_types);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }

   }

    public function loadrisk()
   {

     try
    {

            $vehicle_use = Input::get("vehicle_use");
            $risk_types =VehicleUse::where('use',$vehicle_use)->distinct()->get(['risk']);
            return  Response::json($risk_types);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }


   }


   public function loadvehiclemodels()
   {

     try
    {

            $vehicle_make = Input::get("vehicle_make");
            $models =VehicleModel::where('type',$vehicle_make)->distinct()->get(['model']);
            return  Response::json($models);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }


   }

    public function loadinsurer()
   {

     try
    {

            $policytype = Input::get("policy_type");
            $insurer =Insurers::where('type',$policytype)->orderBy('name','asc')->get();
            return  Response::json($insurer);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }


   }

    public function loadproduct()
   {

     try
    {

            $policytype = Input::get("policy_type");
            $productfetched =PolicyProductType::where('group',$policytype)->orderBy('type','asc')->get();
            return  Response::json($productfetched);
    }

    catch (\Exception $e) 
    { 
           echo $e->getMessage();
        
    }


   }



      public function viewPolicy($id)
    {


    $policydetails   =  ProcessedPolicy::where('id' ,'=', $id)->get()->first();
    $balancesheet    =  CustomerBalanceSheet::where('policy_number' ,'=', $policydetails->policy_number)->get()->first();
    $bills           =  CustomerBalanceSheet::where('policy_number' ,'=', $policydetails->policy_number)->get();
    $claims          =  ClaimProcessed::where('policy_number' ,'=', $policydetails->policy_number)->get();
    $customers       =  Customer::where('account_number' ,'=', $policydetails->customer_number)->get()->first();

    switch($policydetails->policy_product) 
    {
        case 'Motor Insurance':
            $fetchrecord  = MotorDetails::where('ref_number','=',$policydetails->policy_number)->first();
            break;
        case 'Travel Insurance':
             $fetchrecord = TravelDetails::where('ref_number','=',$policydetails->policy_number)->first();
            break;
        case 'Personal Accident Insurance':
             $fetchrecord = Accident::where('ref_number','=',$policydetails->policy_number)->first();
            break;

        case 'Fire Insurance':
             $fetchrecord = FireDetails::where('ref_number','=',$policydetails->policy_number)->first();
            break;

       case 'Bond Insurance':
             $fetchrecord = BondDetails::where('ref_number','=',$policydetails->policy_number)->first();
            break;

        case 'Marine Insurance':
             $fetchrecord = MarineDetails::where('ref_number','=',$policydetails->policy_number)->first();
            break;

            case 'Engineering Insurance':
             $fetchrecord = EngineeringDetails::where('ref_number','=',$policydetails->policy_number)->first();
            break;

             case 'Liability Insurance':
             $fetchrecord = LiabilityDetails::where('ref_number','=',$policydetails->policy_number)->first();
            break;

             case 'General Accident Insurance':
             $fetchrecord = AccidentDetails::where('ref_number','=',$policy->policy_number)->first();
            break;



      }

    return view('policy.view', compact('policydetails','balancesheet','bills','claims','fetchrecord','customers'));
    }


     public function printPolicy($id)
    {


    $policydetails   =  ProcessedPolicy::where('id' ,'=', $id)->get()->first();
    $balancesheet    =  CustomerBalanceSheet::where('policy_number' ,'=', $policydetails->policy_number)->get()->first();
    $bills           =  CustomerBalanceSheet::where('policy_number' ,'=', $policydetails->policy_number)->get();
    $claims          =  ClaimProcessed::where('policy_number' ,'=', $policydetails->policy_number)->get();
    $customers       =  Customer::where('id' ,'=', $policydetails->customer_number)->get()->first();

    //dd($customers);
    switch($policydetails->policy_product) 
    {
        case 'Motor Insurance':
            $fetchrecord  = MotorDetails::where('ref_number','=',$policydetails->policy_number)->first();
            break;
        case 'Travel Insurance':
             $fetchrecord = TravelDetails::where('ref_number','=',$policydetails->policy_number)->first();
            break;
        case 'Personal Accident Insurance':
             $fetchrecord = Accident::where('ref_number','=',$policydetails->policy_number)->first();
            break;

       case 'Fire Insurance':
             $fetchrecord = FireDetails::where('ref_number','=',$policydetails->policy_number)->first();
            break;

       case 'Bond Insurance':
             $fetchrecord = BondDetails::where('ref_number','=',$policydetails->policy_number)->first();
            break;

        case 'Marine Insurance':
             $fetchrecord = MarineDetails::where('ref_number','=',$policydetails->policy_number)->first();
            break;

        
            case 'Engineering Insurance':
             $fetchrecord = EngineeringDetails::where('ref_number','=',$policydetails->policy_number)->first();
            break;

             case 'Liability Insurance':
             $fetchrecord = LiabilityDetails::where('ref_number','=',$policydetails->policy_number)->first();
            break;

             case 'General Accident Insurance':
             $fetchrecord = AccidentDetails::where('ref_number','=',$policy->policy_number)->first();
            break;

      }

    return view('policy.print', compact('policydetails','balancesheet','bills','claims','fetchrecord','customers'));
    }


    public function downloadschedule($type)
    {


        $data = Customer::get()->toArray();
        return Excel::create('ListOfCustomers', function($excel) use ($data) {
            $excel->sheet('List', function($sheet) use ($data)
            {
               
                $sheet->protect('jason');
                $sheet->fromArray($data);
                $sheet->setAutoSize(true);
                // Set font
                $sheet->setStyle(array(
                'font' => array(
                    'name'      =>  'Calibri',
                    'size'      =>  10,
                    'bold'      =>  false
                    )
                ));

            });
        })->download($type);

    }

      public function newpolicy()
    {
      
    $noclaimdiscount = NCD::all();
    $fleetdiscount = FleetDiscount::all();
    $vehiclemodels =  VehicleModel::all();
    $saleschannel = SalesChannel::all();
    $salestype    = SalesType::all();
    $insurers     = Insurers::orderby('name','asc')->get();
    $policytypes  = PolicyType::all();
    $intermediary = User::orderby('username','ASC')->get();
    $vehiclemakes = VehicleMake::all();
    $vehicletypes = VehicleType::all();
    $vehicleuses  = VehicleUse::distinct()->get(['risk']);
    $beneficiaries= Beneficiary::all();
    $selectstatus = SelectStatus::all();
    $roofed       = FireRoofed::all();
    $walled       = FireWalled::all();
    $selectstatus = SelectStatus::all();
    $currencies   = Currency::all();
    $firerisks    = FireRisk::all();
    $collectionmodes = CollectionMode::all();
    $customers    = Customer::all();
    $countries    = Country::all();
    $maritalstatus= MaritalStatus::all();
    $bondtypes    = BondTypes::all();
    $natureofwork = NatureofWork::all();
    $natureofaccident    = NatureofAcccident::all();
    $mortagecompanies = MortgageCompanies::all();
    $propertytypes    = PropertyType::all();
    $marinetypes    = MarineRisktypes::all();
    $engineeringrisktypes    = EngineeringRisktypes::all();
    $accidenttypes    = AccidentRiskType::all();
    $liabilitytypes    = LiabilityRiskTypes::all();
    $producttypes =PolicyProductType::orderby('type','asc')->get();
    $year = range( date("Y") , 1990 );

    return view('policy.new', compact('intermediary','liabilitytypes','accidenttypes','engineeringrisktypes','marinetypes','mortagecompanies','propertytypes','natureofwork','natureofaccident','bondtypes','producttypes','fleetdiscount','noclaimdiscount','vehiclemodels','year','beneficiaries','maritalstatus','countries','customers','collectionmodes','firerisks','roofed','walled','policytypes','insurers','saleschannel','salestype','vehicleuses','vehicletypes','vehiclemakes'))
    ->with('currencies',$currencies)
    ->with('selectstatus',$selectstatus);
    }


        public function newquotation()
    {
      
    $noclaimdiscount = NCD::all();
    $fleetdiscount = FleetDiscount::all();
    $vehiclemodels =  VehicleModel::all();
    $saleschannel = SalesChannel::all();
    $salestype    = SalesType::all();
    $insurers     = Insurers::orderby('name','asc')->get();
    $policytypes  = PolicyType::all();
    $intermediary = User::orderby('username','ASC')->get();
    $vehiclemakes = VehicleMake::all();
    $vehicletypes = VehicleType::all();
    $vehicleuses  = VehicleUse::distinct()->get(['risk']);
    $beneficiaries= Beneficiary::all();
    $selectstatus = SelectStatus::all();
    $roofed       = FireRoofed::all();
    $walled       = FireWalled::all();
    $selectstatus = SelectStatus::all();
    $currencies   = Currency::all();
    $firerisks    = FireRisk::all();
    $collectionmodes = CollectionMode::all();
    $customers    = Customer::all();
    $countries    = Country::all();
    $maritalstatus= MaritalStatus::all();
    $bondtypes    = BondTypes::all();
    $natureofwork= NatureofWork::all();
    $natureofaccident    = NatureofAcccident::all();
    $mortagecompanies = MortgageCompanies::all();
    $propertytypes    = PropertyType::all();
    $marinetypes    = MarineRisktypes::all();
    $engineeringrisktypes    = EngineeringRisktypes::all();
    $accidenttypes    = AccidentRiskType::all();
    $liabilitytypes    = LiabilityRiskTypes::all();
    $producttypes =PolicyProductType::orderby('type','asc')->get();
    $year = range( date("Y") , 1990 );

    return view('policy.quotation', compact('intermediary','accidenttypes','liabilitytypes','engineeringrisktypes','marinetypes','mortagecompanies','propertytypes','bondtypes','natureofwork','natureofaccident','producttypes','fleetdiscount','noclaimdiscount','vehiclemodels','year','beneficiaries','maritalstatus','countries','customers','collectionmodes','firerisks','roofed','walled','policytypes','insurers','saleschannel','salestype','vehicleuses','vehicletypes','vehiclemakes'))
    ->with('currencies',$currencies)
    ->with('selectstatus',$selectstatus);

    }

    public function generatePolicyNumber($policytype)
    {
    $number = Policy::count();
    $policynumber = str_pad($number+1,7, '0', STR_PAD_LEFT);
    $generate = '';
    switch($policytype) 
    {
        case 'Motor Insurance':
           $generate= 'P'.$policynumber;
            break;
        case 'Travel Insurance':
             $generate= 'T'.$policynumber;
            break;
        case 'Personal Accident Insurance':
              $generate= 'PA'.$policynumber;
            break;
        case 'Fire Insurance':
             $generate= 'F'.$policynumber;
            break;

       case 'Bond Insurance':
              $generate= 'B'.$policynumber;
            break;

        case 'Marine Insurance':
              $generate= 'M'.$policynumber;
            break;

        case 'Engineering Insurance':
             $generate= 'E'.$policynumber;
            break;

        case 'Liability Insurance':
             $generate= 'L'.$policynumber;
            break;

        case 'General Accident Insurance':
              $generate= 'GA'.$policynumber;
            break;

      }

      return  $generate;
    }

    public function generateInoviceNumber()
    {
    $number = Bill::count();
    $invoicenumber = str_pad($number+1,7, '0', STR_PAD_LEFT);
    $generate= 'INV'.$invoicenumber;
    return  $generate;
    }




    public function change_date_format($date)
    {
        $time = DateTime::createFromFormat('d/m/Y', $date);
        return $time->format('Y-m-d');
    }


    public function getSearchResults(Request $request)
    {
      

        $this->validate($request, [
            'search' => 'required'
        ]);

        $search = $request->get('search');

        $policies = ProcessedPolicy::where('fullname', 'like', "%$search%")
            ->orWhere('policy_insurer', 'like', "%$search%")
            ->orWhere('policy_product', 'like', "%$search%")
            ->orderBy('fullname')
            ->paginate(30)
            ->appends(['search' => $search])
        ;


        return View('policy.index',compact('policies'));
  
    }

 

      public function editPolicy($id)
    {

   $noclaimdiscount = NCD::all();
    $fleetdiscount = FleetDiscount::all();
    $vehiclemodels =  VehicleModel::all();
    $saleschannel = SalesChannel::all();
    $salestype    = SalesType::all();
    $insurers     = Insurers::orderby('name','asc')->get();
    $policytypes  = PolicyType::all();
    $intermediary = User::orderby('username','ASC')->get();
    $vehiclemakes = VehicleMake::all();
    $vehicletypes = VehicleType::all();
    $vehicleuses  = VehicleUse::distinct()->get(['risk']);
    $beneficiaries= Beneficiary::all();
    $selectstatus = SelectStatus::all();
    $roofed       = FireRoofed::all();
    $walled       = FireWalled::all();
    $selectstatus = SelectStatus::all();
    $currencies   = Currency::all();
    $firerisks    = FireRisk::all();
    $collectionmodes = CollectionMode::all();
    $customers    = Customer::all();
    $countries    = Country::all();
    $maritalstatus= MaritalStatus::all();
    $bondtypes    = BondTypes::all();
    $natureofwork= NatureofWork::all();
    $natureofaccident    = NatureofAcccident::all();
    $mortagecompanies = MortgageCompanies::all();
    $propertytypes    = PropertyType::all();
    $marinetypes    = MarineRisktypes::all();
    $engineeringrisktypes    = EngineeringRisktypes::all();
    $accidenttypes    = AccidentRiskType::all();
    $liabilitytypes    = LiabilityRiskTypes::all();
    $producttypes =PolicyProductType::orderby('type','asc')->get();
    $year = range( date("Y") , 1990 );

    $policy = ProcessedPolicy::find($id);
    $bills = CustomerBalanceSheet::where('policy_number',$policy->policy_number)->first();

    
    

    switch($policy->policy_product) 
    {
        case 'Motor Insurance':
            $fetchrecord  = MotorDetails::where('ref_number','=',$policy->policy_number)->first();
            break;
        case 'Travel Insurance':
             $fetchrecord = TravelDetails::where('ref_number','=',$policy->policy_number)->first();
            break;
        case 'Personal Accident Insurance':
             $fetchrecord = Accident::where('ref_number','=',$policy->policy_number)->first();
            break;
        case 'Fire Insurance':
             $fetchrecord = FireDetails::where('ref_number','=',$policy->policy_number)->first();
            break;

       case 'Bond Insurance':
             $fetchrecord = BondDetails::where('ref_number','=',$policy->policy_number)->first();
            break;

        case 'Marine Insurance':
             $fetchrecord = MarineDetails::where('ref_number','=',$policy->policy_number)->first();
            break;

        case 'Engineering Insurance':
             $fetchrecord = EngineeringDetails::where('ref_number','=',$policy->policy_number)->first();
            break;

        case 'Liability Insurance':
             $fetchrecord = LiabilityDetails::where('ref_number','=',$policy->policy_number)->first();
            break;

        case 'General Accident Insurance':
             $fetchrecord = AccidentDetails::where('ref_number','=',$policy->policy_number)->first();
            break;

      }

    //dd($year);
    return view('policy.edit', compact('policy','bills','fetchrecord','intermediary','liabilitytypes','accidenttypes','engineeringrisktypes','marinetypes','mortagecompanies','propertytypes','natureofwork','natureofaccident','bondtypes','producttypes','fleetdiscount','noclaimdiscount','vehiclemodels','year','beneficiaries','maritalstatus','countries','customers','collectionmodes','firerisks','roofed','walled','policytypes','insurers','saleschannel','salestype','vehicleuses','vehicletypes','vehiclemakes'))
    ->with('currencies',$currencies)
    ->with('selectstatus',$selectstatus);
   
    
    } 

    public function computeMotorPremium()
    {


          $vehiclerisk          = Input::get('vehicle_risk');
          $vehicleuse           = Input::get('vehicle_use');
          $vehiclecover         = Input::get('preferedcover');

          $buybackexcessstatus  = Input::get('vehicle_buy_back_excess');
          $suminsured           = Input::get('vehicle_value');
          $seatnumber           = Input::get('vehicle_seating_capacity');
          $vehiclebuildyear     = Input::get('vehicle_make_year');
          $vehicletppdl         = Input::get('vehicle_tppdl_value');
          $vehiclevoluntaryexcess = 0;
          $vehicelcubiccapacity = Input::get('vehicle_cubic_capacity');
          $ncd_rate             = Input::get('vehicle_ncd');
          $fleet_rate           = Input::get('vehicle_fleet_discount');
          $vehiclecurrency      = Input::get('vehicle_currency');
          $vehicle_buy_back_excess      = Input::get('vehicle_buy_back_excess');



        $loading = Loadings::where('cover', $vehiclecover)
        ->where('use',$vehicleuse)
        ->where('risk',$vehiclerisk)
        ->get()
        ->first();

          $excess = BuyBackExcess::where('cover',$vehiclecover)
        ->where('use',$vehicleuse)
        ->where('risk',$vehiclerisk)
        ->get()
        ->first();


         
          //loadings
          $cover                = $loading->cover;
          $use                  = $loading->use;
          $risk                 = $loading->risk;
          $basic_premium        = $loading->basic_premium;
          $addition_perils      = $loading->addition_perils;
          $eco_perils           = $loading->eco_perils;
          $emergency_treatment  = $loading->emergency_treatment;
          $pa_benefit           = $loading->pa_benefit;
          $tppdl                = $loading->tppdl;
          $ncd                  = $loading->ncd;
          $nic                  = $loading->nic;
          $nhis                 = $loading->nhis;
          $nrsc                 = $loading->nrsc;
          $rate                 = $loading->rate;
          $tppdl_rate           = $loading->tppdl_rate;
          $seat_limit           = $loading->seat_limit;
          $seat_charge_rate     = $loading->seat_charge;
          $brown_card           = $loading->brown_card;
          $tpi                  = $loading->tpi;
          $tpi_limit            = $loading->tpi_limit;
          $extra_tppdl          = $loading->extra_tppdl;

          $tpicharge            = $loading->tpi_limit * $loading->tpi;
          $tppdlcharge          = $loading->tppdl * $loading->tppdl_rate;


          if($vehiclecover == 'Third Party')
          {
             $execessbought = 0;
          }
          else if($buybackexcessstatus=='No')
          {
            $execessbought = 0;
          }

          else
          {
          //compute Excess
          $buy_back_yes         = $excess->yes;
          $excess_charge_rate   = $excess->charge;
          $execessbought        = (($suminsured * ($rate / 100)) * ($buy_back_yes/100));
        }


          //compute Age Charge
          $vehicelyear = Carbon::createFromDate($vehiclebuildyear)->age;
          if($vehicelyear > 10 ) { $vehiceage_charge_rate = 0.07500; } 
          else if($vehicelyear > 5 & $vehicelyear <= 10 ) { $vehiceage_charge_rate = 0.05000; } 
          else { $vehiceage_charge_rate = 0.0; }
          $vehicleyearcharge = (($suminsured * ($rate / 100)) + ($tpicharge + $tppdlcharge)) * $vehiceage_charge_rate;

           //compute Cubic Capacity Charge
          if($vehicelcubiccapacity > 2000 ) { $cubiccapacity_charge_rate = 0.10000; } 
          else if($vehicelcubiccapacity > 1600 & $vehicelyear <= 2000 ) { $cubiccapacity_charge_rate = 0.05000; } 
          else { $cubiccapacity_charge_rate = 0.0; }
          $vehiclecubiccharge = (($suminsured * ($rate / 100)) + ($tpicharge + $tppdlcharge)) * $cubiccapacity_charge_rate;

          //compute Driving Experience Charge
          $drivingexperience = 0;

          //Compute Seat charge
          
          $seatchargeamount = ($seatnumber - $seat_limit) * $seat_charge_rate;

          //Emergency Treatment
          $emergencytreatmentcharge = $emergency_treatment * $seatnumber ;

          //compute Basic premium
           $basicpremiumcharge = (($suminsured * ($rate / 100)) + ($tpicharge + $tppdlcharge)) + $vehiclecubiccharge + $vehicleyearcharge;
           $basicpremiumcharge_init = $tpicharge + $tppdlcharge;


          //compute extra tppdl
           $extratppdl = ($vehicletppdl - $tppdl) * $extra_tppdl ;


          //compute voluntary excess
           $voluntaryexcesscharge = ($vehiclevoluntaryexcess/100) * $basicpremiumcharge ;


           //Compute NCD
           $ncdamount = $basicpremiumcharge * $ncd_rate;

           //Premium less ncd
           $premium_less_ncd = $basicpremiumcharge - $ncdamount;

           //Compute Fleet Discount
           $fleetdiscountamount =  $premium_less_ncd *  ($fleet_rate /100) ;

           //Office Premium 
           $officepremiumcharge =  $basicpremiumcharge;

           //Premium less ncd and fleet
           $premium_less_ncd_fleet = $premium_less_ncd - $fleetdiscountamount;

           //Annual Premium Payable
           if($vehiclecover == 'Third Party')
           {
            $payableanually = $premium_less_ncd_fleet + $seatchargeamount + $extratppdl + $drivingexperience + $pa_benefit + $eco_perils + $nic + $nhis + $addition_perils + $brown_card;
           }
           else
           {
           $payableanually = $premium_less_ncd_fleet + $execessbought +  $drivingexperience + $pa_benefit + $eco_perils + $seatchargeamount + $extratppdl - $voluntaryexcesscharge + $addition_perils + $nic + $nhis +  $nrsc + $brown_card;
           }
           //dd($payableanually);
            $added_response = array('Premium'=>$payableanually);
            return  Response::json($added_response);

    }

    public function createPolicy(Request $request)
    {
            $this->validate($request,[
             'customer_number'=> 'required',
             'policy_product'=> 'required',
             'policy_insurer'=> 'required',
             'policy_type'=> 'required',
             'gross_premium' => 'required',
             'commission_rate' => 'required',
             'collection_mode' => 'required'
           ]); 

        //dd($request->input('policy_product'));
        $policynumberval  = $this->generatePolicyNumber($request->input('policy_product'));
        $invoicenumberval = $this->generateInoviceNumber(10);

        if($request->input('policy_product')=='Motor Insurance')
        {
        

        $time = explode(" - ", $request->input('insurance_period'));

        
        //Policy Details
        $policy                         = new Policy;
        $policy->customer_number        = $request->input('customer_number');  
        $policy->policy_type            = $request->input('policy_type');
        $policy->policy_product         = $request->input('policy_product');
        $policy->policy_insurer         = $request->input('policy_insurer'); 
        $policy->insurance_period_from  = $this->change_date_format($time[0]);
        $policy->insurance_period_to    = $this->change_date_format($time[1]);
        $policy->policy_sales_type      = $request->input('policy_sales_type');
        $policy->policy_sales_channel   = $request->input('policy_sales_channel');
        $policy->policy_number          = $policynumberval;
        $policy->ref_number             = uniqid();
        $policy->status                 = 'Pending Payment';
        $policy->approved_by            = Auth::user()->getNameOrUsername();
        $policy->created_by             = Auth::user()->getNameOrUsername();
        $policy->created_on             = Carbon::now();


        //Motor Details
        $motor                              = new MotorDetails;
        $motor->preferedcover               = $request->input('preferedcover');  
        $motor->vehicle_currency            = $request->input('vehicle_currency');
        $motor->vehicle_value               = $request->input('vehicle_value');
        $motor->vehicle_buy_back_excess     = $request->input('vehicle_buy_back_excess'); 
        $motor->vehicle_tppdl_standard      = $request->input('vehicle_tppdl_standard'); 
        $motor->vehicle_tppdl_value         = $request->input('vehicle_tppdl_value');
        $motor->vehicle_body_type           = $request->input('vehicle_body_type');
        $motor->vehicle_model               = $request->input('vehicle_model');
        $motor->vehicle_make                = $request->input('vehicle_make');
        $motor->vehicle_use                 = $request->input('vehicle_use');
        $motor->vehicle_make_year           = $request->input('vehicle_make_year');
        $motor->vehicle_seating_capacity    = $request->input('vehicle_seating_capacity');
        $motor->vehicle_cubic_capacity      = $request->input('vehicle_cubic_capacity');
        $motor->vehicle_registration_number = $request->input('vehicle_registration_number');
        $motor->vehicle_chassis_number      = $request->input('vehicle_chassis_number');
        $motor->vehicle_interest_status     = $request->input('vehicle_interest_status');

        $motor->vehicle_interest_name       = $request->input('vehicle_interest_name');
        $motor->vehicle_declined_status     = $request->input('vehicle_declined_status');
        $motor->vehicle_declined_reason     = $request->input('vehicle_declined_reason');
        $motor->vehicle_cancelled_status    = $request->input('vehicle_cancelled_status');
        $motor->vehicle_cancelled_reason    = $request->input('vehicle_cancelled_reason');
        $motor->ref_number                  = $policynumberval;
        $motor->vehicle_risk                = $request->input('vehicle_risk');
        $motor->vehicle_ncd                 = $request->input('vehicle_ncd');
        $motor->vehicle_fleet_discount      = $request->input('vehicle_fleet_discount');

        //Invoice Generation

   
        $bill                               = new Bill;
        $bill->invoice_number               = $invoicenumberval;
        $bill->account_number               = $request->input('customer_number');
        $bill->account_name                 = $request->input('billed_to'); 
        $bill->policy_number                = $policynumberval; 
        $bill->policy_product               = $request->input('policy_product');
        $bill->currency                     = $request->input('vehicle_currency');   
        $bill->amount                       = $request->input('gross_premium'); 
        $bill->commission_rate              = $request->input('commission_rate'); 
        $bill->note                         = $request->input('collection_mode'); 
        $bill->status                       = 'Unpaid'; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();



         if($policy->save())
          {


                            if($motor->save())  
                                { 


                                    if($bill->save())
                                    {                 
                                   Activity::log([
                                  'contentId'   =>  $request->input('account_number'),
                                  'contentType' => 'User',
                                  'action'      => 'Create',
                                  'description' => 'Policy '.$policynumberval.' - '.$request->input('billed_to').' was created successfully!',
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
                                    ->route('invoice')
                                    ->with('success','Policy has successfully been created!');

                                    }

                                    else
                                      {
                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Invoice failed to create!');
                                      }


                                }

                                else
                                  {

                                     return redirect()
                                    ->route('online-policies')
                                    ->with('error','Motor details failed to create!');
                                  }


          }

          else
          {

             return redirect()
            ->route('online-policies')
            ->with('error','Policy details failed to create!');
          }
      }

  //Fire Policy
   
 if($request->input('policy_product')=='Fire Insurance')
        {
    $time = explode(" - ", $request->input('insurance_period'));

        //$policynumberval = $this->generatePolicyNumber(10);
        //Policy Details
        $policy                         = new Policy;
        $policy->customer_number        = $request->input('customer_number');  
        $policy->policy_type            = $request->input('policy_type');
        $policy->policy_product         = $request->input('policy_product');
        $policy->policy_insurer         = $request->input('policy_insurer'); 
        $policy->insurance_period_from  = $this->change_date_format($time[0]);
        $policy->insurance_period_to    = $this->change_date_format($time[1]);
        $policy->policy_sales_type      = $request->input('policy_sales_type');
        $policy->policy_sales_channel   = $request->input('policy_sales_channel');
        $policy->policy_number          = $policynumberval;
        $policy->ref_number             = uniqid();
        $policy->status                 = 'Pending Payment';
        $policy->approved_by            = Auth::user()->getNameOrUsername();
        $policy->created_by             = Auth::user()->getNameOrUsername();
        $policy->created_on             = Carbon::now();


        //Fire Details
        $fire                                   = new FireDetails;
        $fire->fire_risk_covered                = $request->input('fire_risk_covered');  
        $fire->fire_building_cost               = $request->input('fire_building_cost');
        $fire->fire_deductible                  = $request->input('fire_deductible');
        $fire->fire_personal_property_coverage  = $request->input('fire_personal_property_coverage'); 
        $fire->fire_temporary_rental_cost       = $request->input('fire_temporary_rental_cost'); 
        $fire->fire_building_address            = $request->input('fire_building_address');
        $fire->fire_property_type               = $request->input('fire_property_type');
        $fire->walled_with                      = $request->input('walled_with');
        $fire->roofed_with                      = $request->input('roofed_with');
        $fire->fire_mortgage_status             = $request->input('fire_mortgage_status');

        $fire->fire_mortgage_company            = $request->input('fire_mortgage_company');
        $fire->property_content                 = $request->input('property_content');
        $fire->created_on                       = Carbon::now();
        $fire->created_by                       = Auth::user()->getNameOrUsername();
        $fire->ref_number                       = $policynumberval;

        //Invoice Generation

   
        $bill                               = new Bill;
        $bill->invoice_number               =  $invoicenumberval;
        $bill->account_number               = $request->input('customer_number');
        $bill->account_name                 = $request->input('billed_to'); 
        $bill->policy_number                = $policynumberval; 
        $bill->policy_product               = $request->input('policy_product');
        $bill->currency                     = 'GHS';   
        $bill->amount                       = $request->input('gross_premium'); 
        $bill->commission_rate              = $request->input('commission_rate'); 
        $bill->note                         = $request->input('collection_mode'); 
        $bill->status                       = 'Unpaid'; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();



         if($policy->save())
          {


                            if($fire->save())  
                                { 


                                    if($bill->save())
                                    {                 
                                   Activity::log([
                                  'contentId'   =>  $request->input('account_number'),
                                  'contentType' => 'User',
                                  'action'      => 'Create',
                                  'description' => 'Policy '.$policynumberval.' - '.$request->input('billed_to').' was created successfully!',
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
                                    ->route('invoice')
                                    ->with('success','Policy has successfully been created!');

                                    }

                                    else
                                      {

                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to create!');
                                      }



                                }

                                else
                                  {

                                     return redirect()
                                    ->route('online-policies')
                                    ->with('error','Policy failed to create!');
                                  }


          }

          else
          {

             return redirect()
            ->route('online-policies')
            ->with('error','Policy failed to create!');
          }
      }
    
//Marine Insurance

if($request->input('policy_product')=='Marine Insurance')
        {
    $time = explode(" - ", $request->input('insurance_period'));

        //$policynumberval = $this->generatePolicyNumber(10);
        //Policy Details
        $policy                         = new Policy;
        $policy->customer_number        = $request->input('customer_number');  
        $policy->policy_type            = $request->input('policy_type');
        $policy->policy_product         = $request->input('policy_product');
        $policy->policy_insurer         = $request->input('policy_insurer'); 
        $policy->insurance_period_from  = $this->change_date_format($time[0]);
        $policy->insurance_period_to    = $this->change_date_format($time[1]);
        $policy->policy_sales_type      = $request->input('policy_sales_type');
        $policy->policy_sales_channel   = $request->input('policy_sales_channel');
        $policy->policy_number          = $policynumberval;
        $policy->ref_number             = uniqid();
        $policy->status                 = 'Pending Payment';
        $policy->approved_by            = Auth::user()->getNameOrUsername();
        $policy->created_by             = Auth::user()->getNameOrUsername();
        $policy->created_on             = Carbon::now();


        //Fire Details
        $marine                                   = new MarineDetails;
        $marine->marine_risk_type                 = $request->input('marine_risk_type');  
        $marine->marine_sum_insured               = $request->input('marine_sum_insured');
        $marine->marine_bill_landing              = $request->input('marine_bill_landing');
        $marine->marine_interest                  = $request->input('marine_interest'); 
        $marine->marine_vessel                    = $request->input('marine_vessel'); 
        $marine->marine_insurance_condition       = $request->input('marine_insurance_condition');
        $marine->marine_valuation                 = $request->input('marine_valuation');
        $marine->marine_means_of_conveyance       = $request->input('marine_means_of_conveyance');
        $marine->marine_voyage                    = $request->input('marine_voyage');
        $marine->marine_condition                 = $request->input('marine_condition');
        $marine->created_on                       = Carbon::now();
        $marine->created_by                   = Auth::user()->getNameOrUsername();
        $marine->ref_number                       = $policynumberval;

        //Invoice Generation

   
        $bill                               = new Bill;
        $bill->invoice_number               =  $invoicenumberval;
        $bill->account_number               = $request->input('customer_number');
        $bill->account_name                 = $request->input('billed_to'); 
        $bill->policy_number                = $policynumberval; 
        $bill->policy_product               = $request->input('policy_product');
        $bill->currency                     = 'GHS';   
        $bill->amount                       = $request->input('gross_premium'); 
        $bill->commission_rate              = $request->input('commission_rate'); 
        $bill->note                         = $request->input('collection_mode'); 
        $bill->status                       = 'Unpaid'; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();



         if($policy->save())
          {


                            if($marine->save())  
                                { 


                                    if($bill->save())
                                    {                 
                                   Activity::log([
                                  'contentId'   =>  $request->input('account_number'),
                                  'contentType' => 'User',
                                  'action'      => 'Create',
                                  'description' => 'Policy '.$policynumberval.' - '.$request->input('billed_to').' was created successfully!',
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
                                    ->route('invoice')
                                    ->with('success','Policy has successfully been created!');

                                    }

                                    else
                                      {

                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to create!');
                                      }



                                }

                                else
                                  {

                                     return redirect()
                                    ->route('online-policies')
                                    ->with('error','Policy failed to create!');
                                  }


          }

          else
          {

             return redirect()
            ->route('online-policies')
            ->with('error','Policy failed to create!');
          }
      }


      //Engineering Insurance

      if($request->input('policy_product')=='Engineering Insurance')
        {
    $time = explode(" - ", $request->input('insurance_period'));

        //$policynumberval = $this->generatePolicyNumber(10);
        //Policy Details
        $policy                         = new Policy;
        $policy->customer_number        = $request->input('customer_number');  
        $policy->policy_type            = $request->input('policy_type');
        $policy->policy_product         = $request->input('policy_product');
        $policy->policy_insurer         = $request->input('policy_insurer'); 
        $policy->insurance_period_from  = $this->change_date_format($time[0]);
        $policy->insurance_period_to    = $this->change_date_format($time[1]);
        $policy->policy_sales_type      = $request->input('policy_sales_type');
        $policy->policy_sales_channel   = $request->input('policy_sales_channel');
        $policy->policy_number          = $policynumberval;
        $policy->ref_number             = uniqid();
        $policy->status                 = 'Pending Payment';
        $policy->approved_by            = Auth::user()->getNameOrUsername();
        $policy->created_by             = Auth::user()->getNameOrUsername();
        $policy->created_on             = Carbon::now();


        //Fire Details
        $engineering                                   = new EngineeringDetails;
        $engineering->car_risk_type                    = $request->input('car_risk_type');  
        $engineering->car_parties                      = $request->input('car_parties');
        $engineering->car_nature_of_business           = $request->input('car_nature_of_business');
        $engineering->car_contract_description         = $request->input('car_contract_description'); 
        $engineering->car_contract_sum                 = $request->input('car_contract_sum'); 
        $engineering->car_deductible                   = $request->input('car_deductible');
        $engineering->car_endorsements                 = $request->input('car_endorsements');
        $engineering->created_on                       = Carbon::now();
        $engineering->created_by                       = Auth::user()->getNameOrUsername();
        $engineering->ref_number                       = $policynumberval;

        //Invoice Generation

   
        $bill                               = new Bill;
        $bill->invoice_number               =  $invoicenumberval;
        $bill->account_number               = $request->input('customer_number');
        $bill->account_name                 = $request->input('billed_to'); 
        $bill->policy_number                = $policynumberval; 
        $bill->policy_product               = $request->input('policy_product');
        $bill->currency                     = 'GHS';   
        $bill->amount                       = $request->input('gross_premium'); 
        $bill->commission_rate              = $request->input('commission_rate'); 
        $bill->note                         = $request->input('collection_mode'); 
        $bill->status                       = 'Unpaid'; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();



         if($policy->save())
          {


                            if($engineering->save())  
                                { 


                                    if($bill->save())
                                    {                 
                                   Activity::log([
                                  'contentId'   =>  $request->input('account_number'),
                                  'contentType' => 'User',
                                  'action'      => 'Create',
                                  'description' => 'Policy '.$policynumberval.' - '.$request->input('billed_to').' was created successfully!',
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
                                    ->route('invoice')
                                    ->with('success','Policy has successfully been created!');

                                    }

                                    else
                                      {

                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to create!');
                                      }



                                }

                                else
                                  {

                                     return redirect()
                                    ->route('online-policies')
                                    ->with('error','Policy failed to create!');
                                  }


          }

          else
          {

             return redirect()
            ->route('online-policies')
            ->with('error','Policy failed to create!');
          }
      }


        if($request->input('policy_product')=='Liability Insurance')
        {
    $time = explode(" - ", $request->input('insurance_period'));

        //$policynumberval = $this->generatePolicyNumber(10);
        //Policy Details
        $policy                         = new Policy;
        $policy->customer_number        = $request->input('customer_number');  
        $policy->policy_type            = $request->input('policy_type');
        $policy->policy_product         = $request->input('policy_product');
        $policy->policy_insurer         = $request->input('policy_insurer'); 
        $policy->insurance_period_from  = $this->change_date_format($time[0]);
        $policy->insurance_period_to    = $this->change_date_format($time[1]);
        $policy->policy_sales_type      = $request->input('policy_sales_type');
        $policy->policy_sales_channel   = $request->input('policy_sales_channel');
        $policy->policy_number          = $policynumberval;
        $policy->ref_number             = uniqid();
        $policy->status                 = 'Pending Payment';
        $policy->approved_by            = Auth::user()->getNameOrUsername();
        $policy->created_by             = Auth::user()->getNameOrUsername();
        $policy->created_on             = Carbon::now();


        //Fire Details
        $liability                                   = new LiabilityDetails;
        $liability->liability_risk_type              = $request->input('liability_risk_type');  
        $liability->liability_schedule               = $request->input('liability_schedule');
        $liability->liability_beneficiary            = $request->input('liability_beneficiary');
        $liability->created_on                       = Carbon::now();
        $liability->created_by                       = Auth::user()->getNameOrUsername();
        $liability->ref_number                       = $policynumberval;

        //Invoice Generation

   
        $bill                               = new Bill;
        $bill->invoice_number               =  $invoicenumberval;
        $bill->account_number               = $request->input('customer_number');
        $bill->account_name                 = $request->input('billed_to'); 
        $bill->policy_number                = $policynumberval; 
        $bill->policy_product               = $request->input('policy_product');
        $bill->currency                     = 'GHS';   
        $bill->amount                       = $request->input('gross_premium'); 
        $bill->commission_rate              = $request->input('commission_rate'); 
        $bill->note                         = $request->input('collection_mode'); 
        $bill->status                       = 'Unpaid'; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();



         if($policy->save())
          {


                            if($liability->save())  
                                { 


                                    if($bill->save())
                                    {                 
                                   Activity::log([
                                  'contentId'   =>  $request->input('account_number'),
                                  'contentType' => 'User',
                                  'action'      => 'Create',
                                  'description' => 'Policy '.$policynumberval.' - '.$request->input('billed_to').' was created successfully!',
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
                                    ->route('invoice')
                                    ->with('success','Policy has successfully been created!');

                                    }

                                    else
                                      {

                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to create!');
                                      }



                                }

                                else
                                  {

                                     return redirect()
                                    ->route('online-policies')
                                    ->with('error','Policy failed to create!');
                                  }


          }

          else
          {

             return redirect()
            ->route('online-policies')
            ->with('error','Policy failed to create!');
          }
      }




//Bond Insurance

if($request->input('policy_product')=='Bond Insurance')
        {
    $time = explode(" - ", $request->input('insurance_period'));

        //$policynumberval = $this->generatePolicyNumber(10);
        //Policy Details
        $policy                         = new Policy;
        $policy->customer_number        = $request->input('customer_number');  
        $policy->policy_type            = $request->input('policy_type');
        $policy->policy_product         = $request->input('policy_product');
        $policy->policy_insurer         = $request->input('policy_insurer'); 
        $policy->insurance_period_from  = $this->change_date_format($time[0]);
        $policy->insurance_period_to    = $this->change_date_format($time[1]);
        $policy->policy_sales_type      = $request->input('policy_sales_type');
        $policy->policy_sales_channel   = $request->input('policy_sales_channel');
        $policy->policy_number          = $policynumberval;
        $policy->ref_number             = uniqid();
        $policy->status                 = 'Pending Payment';
        $policy->approved_by            = Auth::user()->getNameOrUsername();
        $policy->created_by             = Auth::user()->getNameOrUsername();
        $policy->created_on             = Carbon::now();


        //Fire Details
        $bond                                   = new BondDetails;
        $bond->bond_risk_type                   = $request->input('bond_risk_type');  
        $bond->bond_interest                    = $request->input('bond_interest');
        $bond->bond_interest_address            = $request->input('bond_interest_address');
        $bond->contract_sum                     = $request->input('contract_sum'); 
        $bond->bond_sum_insured                 = $request->input('bond_sum_insured'); 
        $bond->bond_contract_description        = $request->input('bond_contract_description');
        $bond->created_on                       = Carbon::now();
        $bond->created_by                       = Auth::user()->getNameOrUsername();
        $bond->ref_number                       = $policynumberval;

        //Invoice Generation

   
        $bill                               = new Bill;
        $bill->invoice_number               = $invoicenumberval;
        $bill->account_number               = $request->input('customer_number');
        $bill->account_name                 = $request->input('billed_to'); 
        $bill->policy_number                = $policynumberval; 
        $bill->policy_product               = $request->input('policy_product');
        $bill->currency                     = 'GHS';   
        $bill->amount                       = $request->input('gross_premium'); 
        $bill->commission_rate              = $request->input('commission_rate'); 
        $bill->note                         = $request->input('collection_mode'); 
        $bill->status                       = 'Unpaid'; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();



         if($policy->save())
          {


                            if($bond->save())  
                                { 


                                    if($bill->save())
                                    {                 
                                   Activity::log([
                                  'contentId'   =>  $request->input('account_number'),
                                  'contentType' => 'User',
                                  'action'      => 'Create',
                                  'description' => 'Policy '.$policynumberval.' - '.$request->input('billed_to').' was created successfully!',
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
                                    ->route('invoice')
                                    ->with('success','Policy has successfully been created!');

                                    }

                                    else
                                      {

                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to create!');
                                      }



                                }

                                else
                                  {

                                     return redirect()
                                    ->route('online-policies')
                                    ->with('error','Policy failed to create!');
                                  }


          }

          else
          {

             return redirect()
            ->route('online-policies')
            ->with('error','Policy failed to create!');
          }
      }
    

//General Accident
if($request->input('policy_product')=='General Accident Insurance')
        {
    $time = explode(" - ", $request->input('insurance_period'));

        //$policynumberval = $this->generatePolicyNumber(10);
        //Policy Details
        $policy                         = new Policy;
        $policy->customer_number        = $request->input('customer_number');  
        $policy->policy_type            = $request->input('policy_type');
        $policy->policy_product         = $request->input('policy_product');
        $policy->policy_insurer         = $request->input('policy_insurer'); 
        $policy->insurance_period_from  = $this->change_date_format($time[0]);
        $policy->insurance_period_to    = $this->change_date_format($time[1]);
        $policy->policy_sales_type      = $request->input('policy_sales_type');
        $policy->policy_sales_channel   = $request->input('policy_sales_channel');
        $policy->policy_number          = $policynumberval;
        $policy->ref_number             = uniqid();
        $policy->status                 = 'Pending Payment';
        $policy->approved_by            = Auth::user()->getNameOrUsername();
        $policy->created_by             = Auth::user()->getNameOrUsername();
        $policy->created_on             = Carbon::now();


        //General Accident Details
        $accident                                   = new AccidentDetails;
        $accident->accident_risk_type               = $request->input('accident_risk_type');  
        $accident->general_accident_sum_insured     = $request->input('general_accident_sum_insured');
        $accident->general_accident_deductible      = $request->input('general_accident_deductible');
        $accident->accident_description             = $request->input('accident_description'); 
        $accident->accident_beneficiaries           = $request->input('accident_beneficiaries'); 
        $accident->accident_clause_limit            = $request->input('accident_clause_limit');
        $accident->created_on                       = Carbon::now();
        $accident->created_by                       = Auth::user()->getNameOrUsername();
        $accident->ref_number                       = $policynumberval;

        //Invoice Generation

   
        $bill                               = new Bill;
        $bill->invoice_number               =  $invoicenumberval;
        $bill->account_number               = $request->input('customer_number');
        $bill->account_name                 = $request->input('billed_to'); 
        $bill->policy_number                = $policynumberval; 
        $bill->policy_product               = $request->input('policy_product');
        $bill->currency                     = 'GHS';   
        $bill->amount                       = $request->input('gross_premium'); 
        $bill->commission_rate              = $request->input('commission_rate'); 
        $bill->note                         = $request->input('collection_mode'); 
        $bill->status                       = 'Unpaid'; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();



         if($policy->save())
          {


                            if($accident->save())  
                                { 


                                    if($bill->save())
                                    {                 
                                   Activity::log([
                                  'contentId'   =>  $request->input('account_number'),
                                  'contentType' => 'User',
                                  'action'      => 'Create',
                                  'description' => 'Policy '.$policynumberval.' - '.$request->input('billed_to').' was created successfully!',
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
                                    ->route('invoice')
                                    ->with('success','Policy has successfully been created!');

                                    }

                                    else
                                      {

                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to create!');
                                      }



                                }

                                else
                                  {

                                     return redirect()
                                    ->route('online-policies')
                                    ->with('error','Policy failed to create!');
                                  }


          }

          else
          {

             return redirect()
            ->route('online-policies')
            ->with('error','Policy failed to create!');
          }
      }


// Travel Poloicy

    if($request->input('policy_product')=='Travel Insurance')
        {
    $time = explode(" - ", $request->input('insurance_period'));

        //$policynumberval = $this->generatePolicyNumber(10);
        //Policy Details
        $policy                         = new Policy;
        $policy->customer_number        = $request->input('customer_number');  
        $policy->policy_type            = $request->input('policy_type');
        $policy->policy_product         = $request->input('policy_product');
        $policy->policy_insurer         = $request->input('policy_insurer'); 
        $policy->insurance_period_from  = $this->change_date_format($time[0]);
        $policy->insurance_period_to    = $this->change_date_format($time[1]);
        $policy->policy_sales_type      = $request->input('policy_sales_type');
        $policy->policy_sales_channel   = $request->input('policy_sales_channel');
        $policy->policy_number          = $policynumberval;
        $policy->ref_number             = '13209092';
        $policy->status                 = 'Pending Payment';
        $policy->approved_by            = Auth::user()->getNameOrUsername();
        $policy->created_by             = Auth::user()->getNameOrUsername();
        $policy->created_on             = Carbon::now();


        //Travel Details
        $travel                              = new TravelDetails;
        $travel->destination_country         = $request->input('destination_country');  
        $travel->destination_phone           = $request->input('destination_phone');
        $travel->destination_address         = $request->input('destination_address');
        $travel->passport_number             = $request->input('passport_number'); 
        $travel->issuing_country             = $request->input('issuing_country'); 
        $travel->citizenship                 = $request->input('citizenship');
        $travel->beneficiary_name            = $request->input('beneficiary_name');
        $travel->beneficiary_relationship    = $request->input('beneficiary_relationship');
        $travel->beneficiary_contact         = $request->input('beneficiary_contact');
        $travel->insured_persons             = $request->input('insured_persons');
        $travel->ref_number                   = $policynumberval;

        //Invoice Generation

   
        $bill                               = new Bill;
        $bill->invoice_number               =  $invoicenumberval;
        $bill->account_number               = $request->input('customer_number');
        $bill->account_name                 = $request->input('billed_to'); 
        $bill->policy_number                = $policynumberval; 
        $bill->policy_product               = $request->input('policy_product');
        $bill->currency                     = 'GHS';   
        $bill->amount                       = $request->input('gross_premium'); 
        $bill->commission_rate              = $request->input('commission_rate'); 
        $bill->note                         = $request->input('collection_mode'); 
        $bill->status                       = 'Unpaid'; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();



         if($policy->save())
          {


                            if($travel->save())  
                                { 


                                    if($bill->save())
                                    {                 
                                   Activity::log([
                                  'contentId'   =>  $request->input('account_number'),
                                  'contentType' => 'User',
                                  'action'      => 'Create',
                                  'description' => 'Policy '.$policynumberval.' - '.$request->input('billed_to').' was created successfully!',
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
                                    ->route('invoice')
                                    ->with('success','Policy has successfully been created!');

                                    }

                                    else
                                      {

                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to create!');
                                      }



                                }

                                else
                                  {

                                     return redirect()
                                    ->route('online-policies')
                                    ->with('error','Policy failed to create!');
                                  }


          }

          else
          {

             return redirect()
            ->route('online-policies')
            ->with('error','Policy failed to create!');
          }
      }


      if($request->input('policy_product')=='Personal Accident Insurance')

        {
        
        $time = explode(" - ", $request->input('insurance_period'));

        //$policynumberval = $this->generatePolicyNumber(10);
        //Policy Details
        $policy                         = new Policy;
        $policy->customer_number        = $request->input('customer_number');  
        $policy->policy_type            = $request->input('policy_type');
        $policy->policy_product         = $request->input('policy_product');
        $policy->policy_insurer         = $request->input('policy_insurer'); 
        $policy->insurance_period_from  = $this->change_date_format($time[0]);
        $policy->insurance_period_to    = $this->change_date_format($time[1]);
        $policy->policy_sales_type      = $request->input('policy_sales_type');
        $policy->policy_sales_channel   = $request->input('policy_sales_channel');
        $policy->policy_number          = $policynumberval;
        $policy->ref_number             = '13209092';
        $policy->status                 = 'Pending Payment';
        $policy->approved_by            = Auth::user()->getNameOrUsername();
        $policy->created_by             = Auth::user()->getNameOrUsername();
        $policy->created_on             = Carbon::now();


        //PA Details
        $accident                                   = new Accident;
        $accident->pa_sum_insured                   = $request->input('pa_sum_insured');  
        $accident->pa_height                        = $request->input('pa_height');
        $accident->pa_weight                        = $request->input('pa_weight');
        $accident->marital_status                   = $request->input('marital_status'); 
        $accident->nature_of_work                   = $request->input('nature_of_work'); 
        $accident->pa_accident_received             = $request->input('pa_accident_received');
        $accident->pa_nature_of_accident            = $request->input('pa_nature_of_accident');
        $accident->accident_duration                = $request->input('accident_duration');
        $accident->accident_period                  = $request->input('accident_period');
        $accident->pa_activities                    = $request->input('pa_activities');
        $accident->pa_special_term_status           = $request->input('pa_special_term_status');
        $accident->pa_cancelled_insurance_status    = $request->input('pa_cancelled_insurance_status');
        $accident->pa_increased_premium_status      = $request->input('pa_increased_premium_status');
        $accident->pa_benefit_details               = $request->input('pa_benefit_details');
        $accident->ref_number                       = $policynumberval;

        //Invoice Generation

   
        $bill                               = new Bill;
        $bill->invoice_number               =  $invoicenumberval;
        $bill->account_number               = $request->input('customer_number');
        $bill->account_name                 = $request->input('billed_to'); 
        $bill->policy_number                = $policynumberval; 
        $bill->policy_product               = $request->input('policy_product');
        $bill->currency                     = 'GHS';   
        $bill->amount                       = $request->input('gross_premium'); 
        $bill->commission_rate              = $request->input('commission_rate'); 
        $bill->note                         = $request->input('collection_mode'); 
        $bill->status                       = 'Unpaid'; 
        $bill->created_by                   = Auth::user()->getNameOrUsername();
        $bill->created_on                   = Carbon::now();



         if($policy->save())
          {


                            if($accident->save())  
                                { 


                                    if($bill->save())
                                    {                 
                                   Activity::log([
                                  'contentId'   =>  $request->input('account_number'),
                                  'contentType' => 'User',
                                  'action'      => 'Create',
                                  'description' => 'Policy '.$policynumberval.' - '.$request->input('billed_to').' was created successfully!',
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
                                    ->route('invoice')
                                    ->with('success','Policy has successfully been created!');

                                    }

                                    else
                                      {

                                         return redirect()
                                        ->route('online-policies')
                                        ->with('error','Policy failed to create!');
                                      }



                                }

                                else
                                  {

                                     return redirect()
                                    ->route('online-policies')
                                    ->with('error','Policy failed to create!');
                                  }


          }

          else
          {

             return redirect()
            ->route('online-policies')
            ->with('error','Policy failed to create!');
          }
      }

      else
          {

             return redirect()
            ->route('online-policies')
            ->with('error','Policy failed to create!');
          }

    
}
}
