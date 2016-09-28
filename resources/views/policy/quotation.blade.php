
@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Policy Administration </li>   
              </ul>
             
              <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                      <i class="fa fa-gavel fa-stack-1x text-white"></i>
                    </span>
                    <a class="clear" href="/online-policies/new">
                      <span class="h3 block m-t-xs"><strong>23</strong></span>
                      <small class="text-muted text-uc">Buy New Policy</small>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-warning"></i>
                      <i class="fa fa-money fa-stack-1x text-white"></i>
                      </span>
                    </span>
                    <a class="clear" href="#">
                      <span class="h3 block m-t-xs"><strong id="bugs">799</strong></span>
                      <small class="text-muted text-uc">Payments</small>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">                     
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-danger"></i>
                      <i class="fa fa-fire-extinguisher fa-stack-1x text-white"></i>
                      <span class="easypiechart pos-abt" data-percent="0" data-line-width="4" data-track-Color="#f5f5f5" data-scale-Color="false" data-size="50" data-line-cap='butt' data-animate="3000" data-target="#firers" data-update="5000"></span>
                    </span>
                    <a class="clear" href="/online-quotation/new">
                      <span class="h3 block m-t-xs"><strong id="firers">Quotation</strong></span>
                      <small class="text-muted text-uc">New Quotation</small>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x icon-muted"></i>
                      <i class="fa fa-clock-o fa-stack-1x text-white"></i>
                    </span>
                    <a class="clear" href="#">
                      <span class="h3 block m-t-xs"><strong>{{ Carbon\Carbon::now() }}</strong></span>
                      <small class="text-muted text-uc">Left to exit</small>
                    </a>
                  </div>
                </div>
              </section>


              <div class="row">
                <div class="col-md-12">
                <section class="scrollable wrapper w-f">
                <form method="post" action="/create-policy" class="panel-body wrapper-lg">
                  <section class="panel panel-default">
                    
                    <div class="wizard clearfix">
                      <ul class="steps">
                        <li data-target="#step1" class="active"><span class="badge badge-info">1</span>Customer</li>
                        <li data-target="#step2"><span class="badge">2</span>Policy</li>
                        <li data-target="#step3"><span class="badge">3</span>Coverage</li>
                        <li data-target="#step4"><span class="badge">4</span>Premium</li>
                        
                      </ul>
                      <div class="actions">
                        <button type="button" class="btn btn-default btn-xs btn-prev" disabled="disabled">Prev</button>
                        <button type="button" class="btn btn-default btn-xs btn-next" data-last="Finish">Next</button>
                      </div>
                    </div>
                    <div class="step-content">
                    {{-- Step 1 Start --}}
                      <div class="step-pane active" id="step1">
                      
                      
                      </div>
                    {{-- Step 1 End --}}  



                    {{-- Step 2 Start --}}
                      <div class="step-pane" id="step2">
                     
                     <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Policy Info
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                         
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('policy_type') ? ' has-error' : ''}}">
                            <label>Policy Type</label>
                            <select id="policy_type" name="policy_type" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                         @foreach($policytypes as $policytype)
                        <option value="{{ $policytype->type }}">{{ $policytype->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('policy_type'))
                          <span class="help-block">{{ $errors->first('policy_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('policy_insurer') ? ' has-error' : ''}}">
                            <label>Insurer</label>
                            <select id="policy_insurer" name="policy_insurer" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                             <option value="">-- select from here --</option>
                        @foreach($insurers as $insurer)
                        <option value="{{ $insurer->name }}">{{ $insurer->name }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('policy_insurer'))
                          <span class="help-block">{{ $errors->first('policy_insurer') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        <div class="form-group @if($errors->has('insurance_period')) has-error @endif">
                        <label for="time">Insurance Period</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="insurance_period" id="insurance_period" placeholder="Select your time" value="{{ old('insurance_period') }}">
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('insurance_period'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('insurance_period') }}
                       </p>
                        @endif
                      </div>
                      
                      </div>
                    </section>
                      </div>
                    {{-- Step 2 End --}}
                    {{-- Step 3 Start --}}
                    <div class="step-pane" id="step3">
                     <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Choose Product
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                         
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('product') ? ' has-error' : ''}}">
                            <select id="product" name="product" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b" onchange="getproductform()">
                         <option value="">Select Insurance Cover</option>
                        <option value="Motor Insurance">Motor Insurance</option>
                        </select>         
                           @if ($errors->has('product'))
                          <span class="help-block">{{ $errors->first('product') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                      
                      </div>
                    </section>


                    <div id="motorinsurance" name="motorinsurance">
                     <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Motor Insurance
                    </header>
                      <div class="panel-body">
                        
                                 <div class="form-group pull-in clearfix">
                          
                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('preferedcover') ? ' has-error' : ''}}">
                            <label>Prefered Cover</label>
                            <select id="preferedcover" name="preferedcover" onchange="getcomprehensiveform()" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">Choose Cover Type</option>
                        <option value="Comprehensive">Comprehensive</option>
                        <option value="Third Party Fire & Theft">Third Party Fire & Theft</option>
                         <option value="Third Party">Third Party</option>
                        </select>         
                           @if ($errors->has('preferedcover'))
                          <span class="help-block">{{ $errors->first('preferedcover') }}</span>
                           @endif    
                          </div>   
                        </div>
                            

                        <div class="col-sm-4">
                            <label>Vehicle Use</label> 
                          <select id="vehicle_use" name="vehicle_use" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                           <option value="">-- select from here --</option>
                          <option value="Commercial">Commercial</option>
                           <option value="Private">Private</option>
                        </select> 
                           @if ($errors->has('vehicle_use'))
                          <span class="help-block">{{ $errors->first('vehicle_use') }}</span>
                           @endif    
                          </div>

                          <div class="col-sm-4">
                            <label>Vehicle Risk</label> 
                          <select id="vehicle_risk" name="vehicle_risk" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                           <option value="">-- select from here --</option>
                          @foreach($vehicleuses as $vehicleuse)
                        <option value="{{ $vehicleuse->risk }}"> {{$vehicleuse->risk }}</option>
                          @endforeach
                        </select> 
                           @if ($errors->has('vehicle_risk'))
                          <span class="help-block">{{ $errors->first('vehicle_risk') }}</span>
                           @endif    
                          </div>
                        </div>

     
                        <div class="form-group pull-in clearfix">
                       
                        <div class="col-sm-4">
                            <label>Currency</label> 
                          <select id="vehicle_currency" name="vehicle_currency" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                          <option value="">-- not set --</option>
                         @foreach($currencies as $currency)
                        <option value="{{ $currency->type }}">{{ $currency->type }}</option>
                          @endforeach
                        </select> 
                           @if ($errors->has('vehicle_currency'))
                          <span class="help-block">{{ $errors->first('vehicle_currency') }}</span>
                           @endif    
                          </div>

                          <div class="col-sm-4">
                            <label>Vehicle Value</label> 
                           <input type="number" class="form-control" id="vehicle_value"  value="0"  name="vehicle_value">
                          @if ($errors->has('vehicle_value'))
                          <span class="help-block">{{ $errors->first('vehicle_value') }}</span>
                           @endif   
                          </div>


                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('vehicle_buy_back_excess') ? ' has-error' : ''}}">
                            <label>Buy Back Excess</label>
                            <select id="vehicle_buy_back_excess" name="vehicle_buy_back_excess" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                         <option value="">-- not set --</option>
                         @foreach($selectstatus as $selectstatus)
                        <option value="{{ $selectstatus->type }}">{{ $selectstatus->type }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('vehicle_buy_back_excess'))
                          <span class="help-block">{{ $errors->first('vehicle_buy_back_excess') }}</span>
                           @endif    
                          </div>   
                        </div>
                            

                       
                        </div>

                  


                        <div class="form-group pull-in clearfix">
                       
                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('vehicle_make') ? ' has-error' : ''}}">
                            <label>Vehicle Make</label>
                            <select id="vehicle_make" name="vehicle_make" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                             <option value="">-- select from here --</option>
                          @foreach($vehiclemakes as $vehiclemake)
                        <option value="{{ $vehiclemake->type }}">{{ $vehiclemake->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('vehicle_make'))
                          <span class="help-block">{{ $errors->first('vehicle_make') }}</span>
                           @endif    
                          </div>   
                        </div>

                         <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('vehicle_model') ? ' has-error' : ''}}">
                            <label>Vehicle Make</label>
                            <select id="vehicle_model" name="vehicle_model" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                             <option value="">-- select from here --</option>
                          @foreach($vehiclemodels as $vehiclemodel)
                        <option value="{{ $vehiclemodel->type }}">{{ $vehiclemodel->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('vehicle_model'))
                          <span class="help-block">{{ $errors->first('vehicle_model') }}</span>
                           @endif    
                          </div>   
                        </div>
                            

                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('vehicle_body_type') ? ' has-error' : ''}}">
                            <label>Body Type</label>
                            <select id="vehicle_body_type" name="vehicle_body_type" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                          <option value="">-- select from here --</option>
                         @foreach($vehicletypes as $vehicletype)
                        <option value="{{ $vehicletype->type }}">{{ $vehicletype->type }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('vehicle_body_type'))
                          <span class="help-block">{{ $errors->first('vehicle_body_type') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>



                    

                        <div class="form-group pull-in clearfix">

                          <div class="col-sm-4">
                            <label>TPPDL Limit Amount</label> 
                           <input type="number" class="form-control" id="vehicle_tppdl_value"  value="{{ '2000' }}"  name="vehicle_tppdl_value">
                          @if ($errors->has('vehicle_tppdl_value'))
                          <span class="help-block">{{ $errors->first('vehicle_tppdl_value') }}</span>
                           @endif   
                          </div>
                         

                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('vehicle_make_year') ? ' has-error' : ''}}">
                            <label>Make Year </label>
                            <select id="vehicle_make_year" name="vehicle_make_year" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        @foreach($year as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                          @endforeach  

                        </select>         
                           @if ($errors->has('vehicle_make_year'))
                          <span class="help-block">{{ $errors->first('vehicle_make_year') }}</span>
                           @endif    
                          </div>   
                        </div>

                          <div class="col-sm-4">
                            <label>Seating Capacity</label> 
                           <input type="number" class="form-control" id="vehicle_seating_capacity"  value="{{ Request::old('vehicle_seating_capacity') ?: '' }}"  name="vehicle_seating_capacity">
                          @if ($errors->has('vehicle_seating_capacity'))
                          <span class="help-block">{{ $errors->first('vehicle_seating_capacity') }}</span>
                           @endif   
                          </div>
                            
                        </div>


                      
                        <div class="form-group pull-in clearfix">
                           <div class="col-sm-4">
                            <label>Cubic Capacity</label> 
                           <input type="number" class="form-control" id="vehicle_cubic_capacity"  value="0"  name="vehicle_cubic_capacity">
                          @if ($errors->has('vehicle_cubic_capacity'))
                          <span class="help-block">{{ $errors->first('vehicle_cubic_capacity') }}</span>
                           @endif   
                          </div>
                            
                          <div class="col-sm-4">
                            <label>Registration Number</label> 
                           <input type="text" class="form-control" id="vehicle_registration_number"  value="{{ Request::old('vehicle_registration_number') ?: '' }}"  name="vehicle_registration_number">
                          @if ($errors->has('vehicle_registration_number'))
                          <span class="help-block">{{ $errors->first('vehicle_registration_number') }}</span>
                           @endif   
                          </div>
                          <div class="col-sm-4">
                            <label>Chassis Number</label> 
                           <input type="text" class="form-control" id="vehicle_chassis_number"  value="{{ Request::old('vehicle_chassis_number') ?: '' }}"  name="vehicle_chassis_number">
                          @if ($errors->has('vehicle_chassis_number'))
                          <span class="help-block">{{ $errors->first('vehicle_chassis_number') }}</span>
                           @endif   
                          </div>
                        </div>
                    </div>
                   </section> 

                    <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Discount
                    </header>
                      <div class="panel-body">
                        
                       <div class="form-group pull-in clearfix">
                       
                         <div class="col-sm-6">
                            <label>NCD</label> 
                          <select id="vehicle_ncd" name="vehicle_ncd" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                           <option value="">-- select from here --</option>
                        @foreach($noclaimdiscount as $noclaimdiscount)
                        <option value="{{ $noclaimdiscount->rate }}">{{ $noclaimdiscount->type }}</option>
                          @endforeach 
                        </select> 
                           @if ($errors->has('vehicle_ncd'))
                          <span class="help-block">{{ $errors->first('vehicle_ncd') }}</span>
                           @endif    
                          </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('vehicle_fleet_discount') ? ' has-error' : ''}}">
                            <label>Fleet Discount </label>
                            <select id="vehicle_fleet_discount" name="vehicle_fleet_discount" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                       @foreach($fleetdiscount as $fleetdiscount)
                        <option value="{{ $fleetdiscount->charge }}">{{ $fleetdiscount->type }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('vehicle_fleet_discount'))
                          <span class="help-block">{{ $errors->first('vehicle_fleet_discount') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                        <div  class="btn-group pull-right"> 
                        <button type="button" class="btn btn-rounded btn-sm btn-info" onclick="computePremium()">Compute Premium
                        </button>
                        </div>
                        </div>
                        </div>
                      </div>
                    </section>
                      </div>



                    <div id="motorinsurancecomprehensive" name="motorinsurancecomprehensive">
                     <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      About the Vehicle (Comprehensive Cover)
                    </header>
                      <div class="panel-body">
                        
                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('vehicle_interest_status') ? ' has-error' : ''}}">
                            <label>Any Interest</label>
                            <select id="vehicle_interest_status" name="vehicle_interest_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                         <option value="">-- not set --</option>
                        <option value="Yes">Yes</option>
                         <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('vehicle_interest_status'))
                          <span class="help-block">{{ $errors->first('vehicle_interest_status') }}</span>
                           @endif    
                          </div>   
                        </div>
                       


                        <div class="form-group">
                        <div class="col-sm-12">
                         <div class="form-group{{ $errors->has('vehicle_interest_name') ? ' has-error' : ''}}">
                          <label>Interest Name </label>
                         <textarea type="text" rows="3" class="form-control" id="vehicle_interest_name" name="vehicle_interest_name" value="{{ Request::old('vehicle_interest_name') ?: '' }}"></textarea> 
                          @if ($errors->has('vehicle_interest_name'))
                          <span class="help-block">{{ $errors->first('vehicle_interest_name') }}</span>
                           @endif                        
                        </div>
                        </div>
                        </div>
                        </div>   



                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('vehicle_declined_status') ? ' has-error' : ''}}">
                            <label>Has any insurance company ever in connection with any motor vehicle declined your proposal?</label>
                            <select id="vehicle_declined_status" name="vehicle_declined_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                         <option value="">-- not set --</option>
                        <option value="Yes">Yes</option>
                         <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('vehicle_declined_status'))
                          <span class="help-block">{{ $errors->first('vehicle_declined_status') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="form-group">
                        <div class="col-sm-12">
                         <div class="form-group{{ $errors->has('vehicle_declined_reason') ? ' has-error' : ''}}">
                          <label>Declined reasons </label>
                         <textarea type="text" rows="3" class="form-control" id="vehicle_declined_reason" name="vehicle_declined_reason" value="{{ Request::old('vehicle_declined_reason') ?: '' }}"></textarea> 
                          @if ($errors->has('vehicle_declined_reason'))
                          <span class="help-block">{{ $errors->first('vehicle_declined_reason') }}</span>
                           @endif                        
                        </div>
                        </div>
                        </div>
                        </div>       
     
                     <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('vehicle_cancelled_status') ? ' has-error' : ''}}">
                            <label>Has any insurance company ever in connection with any motor vehicle cancelled your policy?</label>
                            <select id="vehicle_cancelled_status" name="vehicle_cancelled_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- not set --</option>
                        <option value="Yes">Yes</option>
                         <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('vehicle_cancelled_status'))
                          <span class="help-block">{{ $errors->first('vehicle_cancelled_status') }}</span>
                           @endif    
                          </div>   
                        </div>
                        
                        <div class="form-group">
                        <div class="col-sm-12">
                         <div class="form-group{{ $errors->has('vehicle_cancelled_reason') ? ' has-error' : ''}}">
                          <label>Cancelled reasons </label>
                         <textarea type="text" rows="3" class="form-control" id="vehicle_cancelled_reason" name="vehicle_cancelled_reason" value="{{ Request::old('vehicle_cancelled_reason') ?: '' }}"></textarea> 
                          @if ($errors->has('vehicle_cancelled_reason'))
                          <span class="help-block">{{ $errors->first('vehicle_cancelled_reason') }}</span>
                           @endif                        
                        </div>
                        </div>
                        </div>
                        </div>

                    </div>
                   </section> 
                  </div>


                    {{-- Travel Insurance Start--}}
                  <div id="travelinsurance" name="travelinsurance">
                     <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Travel Insurance
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('destination_country') ? ' has-error' : ''}}">
                            <label>Destination Country</label>
                            <select id="destination_country" name="destination_country" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                            <option value="">-- select from here --</option>
                          @foreach($countries as $country)
                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('destination_country'))
                          <span class="help-block">{{ $errors->first('destination_country') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('destination_phone') ? ' has-error' : ''}}">
                            <label>Destination Phone</label>
                            <input type="text" class="form-control" id="destination_phone"  value="{{ Request::old('destination_phone') ?: '' }}"  name="destination_phone">         
                           @if ($errors->has('destination_phone'))
                          <span class="help-block">{{ $errors->first('destination_phone') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('destination_address') ? ' has-error' : ''}}">
                            <label>Destination Address</label>
                            <textarea type="text" rows="3" class="form-control" id="destination_address" name="destination_address" value="{{ Request::old('destination_address') ?: '' }}"></textarea> 
                           @if ($errors->has('destination_address'))
                          <span class="help-block">{{ $errors->first('destination_address') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        </div>
                   </section> 

                    <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Passport Information
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('passport_number') ? ' has-error' : ''}}">
                            <label>Passport No.</label>
                             <input type="text" class="form-control" id="passport_number"  value="{{ Request::old('passport_number') ?: '' }}"  name="passport_number">         
                           @if ($errors->has('passport_number'))
                          <span class="help-block">{{ $errors->first('passport_number') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('issuing_country') ? ' has-error' : ''}}">
                            <label>Issuing Country</label>
                            <select id="issuing_country" name="issuing_country" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                          <option value="Ghana">-- Ghana --</option>
                          @foreach($countries as $country2)
                        <option value="{{ $country2->name }}">{{ $country2->name }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('issuing_country'))
                          <span class="help-block">{{ $errors->first('issuing_country') }}</span>
                           @endif    
                          </div>   
                        </div>
                        

                        <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('citizenship') ? ' has-error' : ''}}">
                            <label>Citizenship</label>
                            <select id="citizenship" name="citizenship" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="Ghanaian">-- Ghanaian --</option>
                          @foreach($countries as $country3)
                        <option value="{{ $country3->name }}">{{ $country3->name }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('citizenship'))
                          <span class="help-block">{{ $errors->first('citizenship') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        </div>
                   </section> 

                   <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Beneficiary Information
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('beneficiary_name') ? ' has-error' : ''}}">
                            <label>Name of Beneficiary</label>
                           <input type="text" class="form-control" id="beneficiary_name"  value="{{ Request::old('beneficiary_name') ?: '' }}"  name="beneficiary_name">          
                           @if ($errors->has('beneficiary_name'))
                          <span class="help-block">{{ $errors->first('beneficiary_name') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('beneficiary_relationship') ? ' has-error' : ''}}">
                            <label>Relationship with Beneficiary</label>
                            <select id="beneficiary_relationship" name="beneficiary_relationship" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                            <option value="">-- not set --</option>
                          @foreach($beneficiaries as $beneficiary)
                        <option value="{{ $beneficiary->type }}">{{ $beneficiary->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('beneficiary_relationship'))
                          <span class="help-block">{{ $errors->first('beneficiary_relationship') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('beneficiary_contact') ? ' has-error' : ''}}">
                            <label>Beneficiary contact details</label>
                             <input type="text" class="form-control" id="beneficiary_contact"  value="{{ Request::old('beneficiary_contact') ?: '' }}"  name="beneficiary_contact">         
                           @if ($errors->has('beneficiary_contact'))
                          <span class="help-block">{{ $errors->first('beneficiary_contact') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        </div>
                   </section> 


                  
                   <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                     Particulars of other persons who are to be insured
                    </header>
                      <div class="panel-body">
                        
                      

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('insured_persons') ? ' has-error' : ''}}">
                            <label>Name, Gender, Date of Birth, Passport No of each person on a new line</label>
                          <textarea type="text" rows="3" class="form-control" id="insured_persons" name="insured_persons" value="{{ Request::old('insured_persons') ?: '' }}"></textarea>        
                           @if ($errors->has('insured_persons'))
                          <span class="help-block">{{ $errors->first('insured_persons') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        </div>
                   </section> 

                      </div>

                     {{-- Travel Insurance End--}}


                       {{-- Personal Accident Insurance Start--}}
                             <div id="personalaccidentinsurance" name="personalaccidentinsurance">

                             <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                              Insurance Cover Details
                               </header>
                            <div class="panel-body">

                              <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('pa_sum_insured') ? ' has-error' : ''}}">
                            <label>Sum Insured</label>
                            <input type="text" class="form-control" id="pa_sum_insured"  value="{{ Request::old('pa_sum_insured') ?: '' }}"  name="pa_sum_insured">         
                           @if ($errors->has('pa_sum_insured'))
                          <span class="help-block">{{ $errors->first('pa_sum_insured') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                            </div>
                            </section>
                               <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                               Personal Details
                               </header>
                            <div class="panel-body">
                              
                            <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('pa_height') ? ' has-error' : ''}}">
                            <label>Height</label>
                            <input type="text" class="form-control" id="pa_height"  value="{{ Request::old('pa_height') ?: '' }}"  name="pa_height">         
                           @if ($errors->has('pa_height'))
                          <span class="help-block">{{ $errors->first('pa_height') }}</span>
                           @endif    
                          </div>   
                        </div>
                            

                         <div class="col-sm-3">
                            <label>Weight</label> 
                              <div class="form-group{{ $errors->has('pa_weight') ? ' has-error' : ''}}">
                          <input type="text" class="form-control" id="pa_weight"  value="{{ Request::old('pa_weight') ?: '' }}"  name="pa_weight">   
                           @if ($errors->has('pa_weight'))
                          <span class="help-block">{{ $errors->first('pa_weight') }}</span>
                           @endif    
                          </div>
                          </div>   

                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('marital_status') ? ' has-error' : ''}}">
                            <label>Marital Status</label>
                            <select id="marital_status" name="marital_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                           @foreach($maritalstatus as $maritalstatus)
                        <option value="{{ $maritalstatus->type }}">{{ $maritalstatus->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('marital_status'))
                          <span class="help-block">{{ $errors->first('marital_status') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('nature_of_work') ? ' has-error' : ''}}">
                            <label>Nature of Work</label>
                            <select id="nature_of_work" name="nature_of_work" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        {{--   @foreach($dosage as $dosage)
                        <option value="{{ $dosage->Name }}">{{ $dosage->Name }}</option>
                          @endforeach --}}
                        </select>         
                           @if ($errors->has('nature_of_work'))
                          <span class="help-block">{{ $errors->first('nature_of_work') }}</span>
                           @endif    
                          </div>   
                        </div>
                              

                            </div>
                            </section>

                             <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                               Previous Accident Information
                               </header>
                            <div class="panel-body">
                              

                            <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('pa_accident_received') ? ' has-error' : ''}}">
                            <label>Accident Received?</label>
                            <select id="pa_accident_received" name="pa_accident_received" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- not set --</option>
                        <option value="Yes">Yes</option>
                        <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('pa_accident_received'))
                          <span class="help-block">{{ $errors->first('pa_accident_received') }}</span>
                           @endif    
                          </div>   
                        </div>
                            

                         <div class="col-sm-3">
                            <label>Nature of Accident</label> 
                             <div class="form-group{{ $errors->has('pa_nature_of_accident') ? ' has-error' : ''}}">
                          <select id="pa_nature_of_accident" name="pa_nature_of_accident" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
{{--                           @foreach($application as $application)
                        <option value="{{ $application->Name }}">{{ $application->Name }}</option>
                          @endforeach --}}
                        </select> 
                           @if ($errors->has('pa_nature_of_accident'))
                          <span class="help-block">{{ $errors->first('pa_nature_of_accident') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('accident_duration') ? ' has-error' : ''}}">
                            <label>Duration</label>
                            <select id="accident_duration" name="accident_duration" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="0">-- not set --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="5">6</option>
                        <option value="5">7</option>
                        <option value="5">8</option>
                        <option value="5">9</option>
                        <option value="5">10</option>
                        </select>         
                           @if ($errors->has('accident_duration'))
                          <span class="help-block">{{ $errors->first('accident_duration') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('accident_period') ? ' has-error' : ''}}">
                            <label>Period</label>
                            <select id="accident_period" name="accident_period" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="0">-- not set --</option>
                        <option value="Days">Days</option>
                        <option value="Weeks">Weeks</option>
                        <option value="Months">Months</option>
                        <option value="Years">Years</option>
                        </select>         
                           @if ($errors->has('accident_period'))
                          <span class="help-block">{{ $errors->first('accident_period') }}</span>
                           @endif    
                          </div>   
                        </div>
                              


                            </div>
                            </section>

                            <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                               Activities Detail
                               </header>
                            <div class="panel-body">
                              
                             <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                            <div class="form-group{{ $errors->has('pa_activities') ? ' has-error' : ''}}">
                           
                            <select id="pa_activities" name="pa_activities" multiple="multiple" rows="3" tabindex="1" data-placeholder="Choose Activities Engaged In" style="width:100%">
                           <option value="Motor Cycling">Motor Cycling</option>
                           <option value="Football">Football</option>
                           <option value="Big Game Hunting">Big Game Hunting</option>
                          <option value="Parachuting">Parachuting</option>
                          <option value="Big Game Hunting">Diving</option>
                          <option value="Parachuting">Mining</option>
                        </select>         
                           @if ($errors->has('pa_activities'))
                          <span class="help-block">{{ $errors->first('pa_activities') }}</span>
                           @endif    
                          </div>   
                          </div>
                          
                        </div>

                            </div>
                            </section>


                             <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                               Has any insurance company ever...
                               </header>
                            <div class="panel-body">
                                  <div class="form-group pull-in clearfix">
                       
                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('pa_special_term_status') ? ' has-error' : ''}}">
                            <label>1. Required Special Terms?</label>
                            <select id="pa_special_term_status" name="pa_special_term_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- not set --</option>
                        <option value="Yes">Yes</option>
                        <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('pa_special_term_status'))
                          <span class="help-block">{{ $errors->first('pa_special_term_status') }}</span>
                           @endif    
                          </div>   
                        </div>
                            

                         <div class="col-sm-4">
                            <label>2. Cancelled or refused your insurance?</label> 
                            <div class="form-group{{ $errors->has('pa_cancelled_insurance_status') ? ' has-error' : ''}}">
                          <select id="pa_cancelled_insurance_status" name="pa_cancelled_insurance_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- not set --</option>
                        <option value="Yes">Yes</option>
                        <option value="Yes">No</option>
                        </select> 
                           @if ($errors->has('pa_cancelled_insurance_status'))
                          <span class="help-block">{{ $errors->first('pa_cancelled_insurance_status') }}</span>
                           @endif    
                          </div>
                          </div>

                          <div class="col-sm-4">
                          <div class="form-group{{ $errors->has('pa_increased_premium_status') ? ' has-error' : ''}}">
                            <label>3. Increase your premium on renewal?</label>
                            <select id="pa_increased_premium_status" name="pa_increased_premium_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- not set --</option>
                        <option value="Yes">Yes</option>
                        <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('pa_increased_premium_status'))
                          <span class="help-block">{{ $errors->first('pa_increased_premium_status') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>



                            </div>
                            </section>

                            <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                               Benefit Details
                               </header>
                            <div class="panel-body">
                              
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('pa_benefit_details') ? ' has-error' : ''}}">
                            <label>Name, Gender, Date of Birth, Passport No of each person on a new line</label>
                            <textarea type="text" rows="3" class="form-control" id="pa_benefit_details" name="pa_benefit_details" value="{{ Request::old('pa_benefit_details') ?: '' }}"></textarea>         
                           @if ($errors->has('pa_benefit_details'))
                          <span class="help-block">{{ $errors->first('pa_benefit_details') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                            </div>
                            </section>
                          </div>


                         {{-- Personal Accident Insurance End--}}
                             {{--Bond Insurance Start--}}
                      <div id="liabilityinsurance" name="liabilityinsurance">
                            <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Liability Information
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('liability_risk_type') ? ' has-error' : ''}}">
                            <label>Liability Type</label>
                            <select id="liability_risk_type" name="liability_risk_type" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- Select coverage --</option>
{{--                          @foreach($bondtypes as $bondtype)
                        <option value="{{ $bondtype->type }}">{{ $bondtype->type }}</option>
                          @endforeach  --}}
                        </select>         
                           @if ($errors->has('liability_risk_type'))
                          <span class="help-block">{{ $errors->first('liability_risk_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        
                           <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('bond_contract_description') ? ' has-error' : ''}}">
                            <label>Schedule description of each object on a new line </label>
                             <textarea type="text" class="form-control" rows="3" id="bond_contract_description"  value="{{ Request::old('bond_contract_description') ?: '' }}"  name="bond_contract_description"></textarea>           
                           @if ($errors->has('bond_contract_description'))
                          <span class="help-block">{{ $errors->first('bond_contract_description') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>




                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('bond_contract_description') ? ' has-error' : ''}}">
                            <label>List of beneficiaries of limits on a new line </label>
                             <textarea type="text" class="form-control" rows="3" id="bond_contract_description"  value="{{ Request::old('bond_contract_description') ?: '' }}"  name="bond_contract_description"></textarea>           
                           @if ($errors->has('bond_contract_description'))
                          <span class="help-block">{{ $errors->first('bond_contract_description') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                       
                      </div>
                   </section>

            </div>
                        {{--Bond Insurance Start--}}
                            <div id="bondinsurance" name="bondinsurance">
                            <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Bond Details
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('bond_risk_type') ? ' has-error' : ''}}">
                            <label>Bond Type</label>
                            <select id="bond_risk_type" name="bond_risk_type" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- Select coverage --</option>
                         @foreach($bondtypes as $bondtype)
                        <option value="{{ $bondtype->type }}">{{ $bondtype->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('bond_risk_type'))
                          <span class="help-block">{{ $errors->first('bond_risk_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('bond_interest') ? ' has-error' : ''}}">
                            <label>Bond Interest</label>
                             <input type="text" class="form-control" id="bond_interest"  value="{{ Request::old('bond_interest') ?: '' }}"  name="bond_interest">           
                           @if ($errors->has('bond_interest'))
                          <span class="help-block">{{ $errors->first('bond_interest') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('bond_interest_address') ? ' has-error' : ''}}">
                            <label>Bond Interest Address</label>
                                 <input type="text" class="form-control" id="bond_interest_address"  value="{{ Request::old('bond_interest_address') ?: '' }}"  name="bond_interest_address">          
                           @if ($errors->has('bond_interest_address'))
                          <span class="help-block">{{ $errors->first('bond_interest_address') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>
                        </div>
                   </section>

                    <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Bond Details
                    </header>
                      <div class="panel-body">
                        
              

                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('contract_sum') ? ' has-error' : ''}}">
                            <label>Contract Sum</label>
                             <input type="text" class="form-control" id="contract_sum"  value="{{ Request::old('contract_sum') ?: '' }}"  name="contract_sum">           
                           @if ($errors->has('contract_sum'))
                          <span class="help-block">{{ $errors->first('contract_sum') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('bond_sum_insured') ? ' has-error' : ''}}">
                            <label>Sum Insured</label>
                                 <input type="text" class="form-control" id="bond_sum_insured"  value="{{ Request::old('pa_height') ?: '' }}"  name="bond_sum_insured">          
                           @if ($errors->has('bond_sum_insured'))
                          <span class="help-block">{{ $errors->first('bond_sum_insured') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('bond_contract_description') ? ' has-error' : ''}}">
                            <label>Contract Description</label>
                             <textarea type="text" class="form-control" rows="3" id="bond_contract_description"  value="{{ Request::old('bond_contract_description') ?: '' }}"  name="bond_contract_description"></textarea>           
                           @if ($errors->has('bond_contract_description'))
                          <span class="help-block">{{ $errors->first('bond_contract_description') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>



                        </div>
                    
                   </section>


                            </div>


                        {{--Bond Insurance End--}}

                             {{--Bond Insurance Start--}}
                            <div id="marineinsurance" name="marineinsurance">
                            <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Marine
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('bond_risk_type') ? ' has-error' : ''}}">
                            <label>Marine Type</label>
                            <select id="bond_risk_type" name="bond_risk_type" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- Select coverage --</option>
{{--                          @foreach($bondtypes as $bondtype)
                        <option value="{{ $bondtype->type }}">{{ $bondtype->type }}</option>
                          @endforeach  --}}
                        </select>         
                           @if ($errors->has('bond_risk_type'))
                          <span class="help-block">{{ $errors->first('bond_risk_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('bond_interest') ? ' has-error' : ''}}">
                            <label>Invoice Number</label>
                             <input type="text" class="form-control" id="bond_interest"  value="{{ Request::old('bond_interest') ?: '' }}"  name="bond_interest">           
                           @if ($errors->has('bond_interest'))
                          <span class="help-block">{{ $errors->first('bond_interest') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('bond_interest_address') ? ' has-error' : ''}}">
                            <label>Bill of Landing No.</label>
                                 <input type="text" class="form-control" id="bond_interest_address"  value="{{ Request::old('bond_interest_address') ?: '' }}"  name="bond_interest_address">          
                           @if ($errors->has('bond_interest_address'))
                          <span class="help-block">{{ $errors->first('bond_interest_address') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>
                        </div>
                   </section>

                    <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      Marine Details
                    </header>
                      <div class="panel-body">
                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('contract_sum') ? ' has-error' : ''}}">
                            <label>Interest & Marks</label>
                             <input type="text" class="form-control" id="contract_sum"  value="{{ Request::old('contract_sum') ?: '' }}"  name="contract_sum">           
                           @if ($errors->has('contract_sum'))
                          <span class="help-block">{{ $errors->first('contract_sum') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('bond_sum_insured') ? ' has-error' : ''}}">
                            <label>Name of Vessel</label>
                                 <input type="text" class="form-control" id="bond_sum_insured"  value="{{ Request::old('pa_height') ?: '' }}"  name="bond_sum_insured">          
                           @if ($errors->has('bond_sum_insured'))
                          <span class="help-block">{{ $errors->first('bond_sum_insured') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('contract_sum') ? ' has-error' : ''}}">
                            <label>Insurance Condition</label>
                             <input type="text" class="form-control" id="contract_sum"  value="{{ Request::old('contract_sum') ?: '' }}"  name="contract_sum">           
                           @if ($errors->has('contract_sum'))
                          <span class="help-block">{{ $errors->first('contract_sum') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('bond_sum_insured') ? ' has-error' : ''}}">
                            <label>Valution Basis</label>
                                 <input type="text" class="form-control" id="bond_sum_insured"  value="{{ Request::old('pa_height') ?: '' }}"  name="bond_sum_insured">          
                           @if ($errors->has('bond_sum_insured'))
                          <span class="help-block">{{ $errors->first('bond_sum_insured') }}</span>
                           @endif    
                          </div>   
                        </div>

                        </div>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('bond_contract_description') ? ' has-error' : ''}}">
                            <label>Ship or vessel or other means of conveyance </label>
                             <textarea type="text" class="form-control" rows="3" id="bond_contract_description"  value="{{ Request::old('bond_contract_description') ?: '' }}"  name="bond_contract_description"></textarea>           
                           @if ($errors->has('bond_contract_description'))
                          <span class="help-block">{{ $errors->first('bond_contract_description') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('contract_sum') ? ' has-error' : ''}}">
                            <label>Voyage</label>
                             <input type="text" class="form-control" id="contract_sum"  value="{{ Request::old('contract_sum') ?: '' }}"  name="contract_sum">           
                           @if ($errors->has('contract_sum'))
                          <span class="help-block">{{ $errors->first('contract_sum') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('bond_contract_description') ? ' has-error' : ''}}">
                            <label>Conditions of insurance subject to </label>
                             <textarea type="text" class="form-control" rows="3" id="bond_contract_description"  value="{{ Request::old('bond_contract_description') ?: '' }}"  name="bond_contract_description"></textarea>           
                           @if ($errors->has('bond_contract_description'))
                          <span class="help-block">{{ $errors->first('bond_contract_description') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        </div>
                   </section>
            </div>


                      
          
                      {{-- Fire Insurance End--}}
                       <div id="fireinsurance" name="fireinsurance">
                     <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      ABOUT YOUR INSURANCE
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('fire_risk_type') ? ' has-error' : ''}}">
                            <label>What insurance do you need?</label>
                            <select id="fire_risk_type" name="fire_risk_type" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value="">-- Select coverage --</option>
                         @foreach($firerisks as $firerisk)
                        <option value="{{ $firerisk->type }}">{{ $firerisk->type }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('fire_risk_type'))
                          <span class="help-block">{{ $errors->first('fire_risk_type') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('fire_house_hold_insurance_5years') ? ' has-error' : ''}}">
                            <label>Had Household Insurance within the past 5 years?</label>
                            <select id="fire_house_hold_insurance_5years" name="fire_house_hold_insurance_5years" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value=""></option>
                        <option value="Yes">Yes</option>
                         <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('fire_house_hold_insurance_5years'))
                          <span class="help-block">{{ $errors->first('fire_house_hold_insurance_5years') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('fire_insurance_5years') ? ' has-error' : ''}}">
                            <label>Had Fire Insurance within the past 5 years?</label>
                                <select id="fire_insurance_5years" name="fire_insurance_5years" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                           <option value=""></option>
                        <option value="Yes">Yes</option>
                         <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('fire_insurance_5years'))
                          <span class="help-block">{{ $errors->first('fire_insurance_5years') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('fire_burglary_5years') ? ' has-error' : ''}}">
                            <label>Have you had Burglary Insurance the past 5 years?</label>
                            <select id="fire_burglary_5years" name="fire_burglary_5years" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                         <option value=""></option>
                        <option value="Yes">Yes</option>
                         <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('fire_burglary_5years'))
                          <span class="help-block">{{ $errors->first('fire_burglary_5years') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('fire_claims_5years') ? ' has-error' : ''}}">
                            <label>Made any insurance claim within the past 5 years?</label>
                            <select id="fire_claims_5years" name="fire_claims_5years" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                         <option value=""></option>
                        <option value="Yes">Yes</option>
                         <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('fire_claims_5years'))
                          <span class="help-block">{{ $errors->first('fire_claims_5years') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        </div>
                    
                   </section> 

                   <section class="panel panel-default">
                     <header class="panel-heading font-bold">                  
                      BUILDING INFORMATION
                    </header>
                      <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('fire_mortgage_status') ? ' has-error' : ''}}">
                            <label>Is your building subject to a mortgage loan?</label>
                            <select id="fire_mortgage_status" name="fire_mortgage_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                         <option value=""></option>
                        <option value="Yes">Yes</option>
                         <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('fire_mortgage_status'))
                          <span class="help-block">{{ $errors->first('fire_mortgage_status') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('fire_mortgage_company') ? ' has-error' : ''}}">
                            <label>Provide name of mortgage company</label>
                            <select id="fire_mortgage_company" name="fire_mortgage_company" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
{{--                           @foreach($accounttype as $accounttype)
                        <option value="{{ $accounttype->type }}">{{ $accounttype->type }}</option>
                          @endforeach --}}
                        </select>         
                           @if ($errors->has('fire_mortgage_company'))
                          <span class="help-block">{{ $errors->first('fire_mortgage_company') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                        
                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('fire_residential_status') ? ' has-error' : ''}}">
                            <label>Are your buildings occupied for residential purposes?</label>
                            <select id="fire_residential_status" name="fire_residential_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                          <option value=""></option>
                        <option value="Yes">Yes</option>
                         <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('fire_residential_status'))
                          <span class="help-block">{{ $errors->first('fire_residential_status') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('fire_business_status') ? ' has-error' : ''}}">
                            <label>Is any Business or trade carried out in your building?</label>
                            <select id="fire_business_status" name="fire_business_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                          <option value=""></option>
                        <option value="Yes">Yes</option>
                         <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('fire_business_status'))
                          <span class="help-block">{{ $errors->first('fire_business_status') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('fire_premises_status') ? ' has-error' : ''}}">
                            <label>Will your premises be occupied always?</label>
                            <select id="fire_premises_status" name="fire_premises_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                          <option value=""></option>
                        <option value="Yes">Yes</option>
                         <option value="Yes">No</option>
                        </select>         
                           @if ($errors->has('fire_premises_status'))
                          <span class="help-block">{{ $errors->first('fire_premises_status') }}</span>
                           @endif    
                          </div>   
                        </div>

                        <div class="col-sm-3">
                          <div class="form-group{{ $errors->has('fire_other_insurance_status') ? ' has-error' : ''}}">
                            <label>Any other insurance on your building?</label>
                            <select id="fire_other_insurance_status" name="fire_other_insurance_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        <option value=""></option>
                        <option value="Yes">Yes</option>
                         <option value="Yes">No</option>  
                        </select>         
                           @if ($errors->has('fire_other_insurance_status'))
                          <span class="help-block">{{ $errors->first('fire_other_insurance_status') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('walled_with') ? ' has-error' : ''}}">
                            <label>Construction details of your wall</label>
                            <select id="walled_with" multiple="multiple" name="walled_with" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                          @foreach($walled as $walled)
                        <option value="{{ $walled->type }}">{{ $walled->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('walled_with'))
                          <span class="help-block">{{ $errors->first('walled_with') }}</span>
                           @endif    
                          </div>   
                        </div>

                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('roofed_with') ? ' has-error' : ''}}">
                            <label>Construction details of your roof</label>
                            <select id="roofed_with" multiple="multiple" name="roofed_with" rows="3" tabindex="1" data-placeholder="Select here.." style="width:100%">
                        @foreach($roofed as $roofed)
                        <option value="{{ $roofed->type }}">{{ $roofed->type }}</option>
                          @endforeach
                        </select>         
                           @if ($errors->has('roofed_with'))
                          <span class="help-block">{{ $errors->first('roofed_with') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        </div>
                    
                   </section>

                    <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                              AMOUNT OF COVER REQUIRED
                               </header>
                            <div class="panel-body">
                              
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('fire_building_cost') ? ' has-error' : ''}}">
                            <label>Rebuilding cost</label>
                            <input type="number" class="form-control" id="fire_building_cost"  value="{{ Request::old('fire_building_cost') ?: '' }}"  name="fire_building_cost">         
                           @if ($errors->has('fire_building_cost'))
                          <span class="help-block">{{ $errors->first('fire_building_cost') }}</span>
                           @endif    
                          </div>   
                        </div>

                         <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('fire_content_cost') ? ' has-error' : ''}}">
                            <label>Contents cost</label>
                           <input type="number" class="form-control" id="fire_content_cost"  value="{{ Request::old('fire_content_cost') ?: '' }}"  name="fire_content_cost">  
                           @if ($errors->has('fire_content_cost'))
                          <span class="help-block">{{ $errors->first('fire_content_cost') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('fire_public_liability_cost') ? ' has-error' : ''}}">
                            <label>Public liablity cost</label>
                              <input type="number" class="form-control" id="fire_public_liability_cost"  value="{{ Request::old('fire_public_liability_cost') ?: '' }}"  name="fire_public_liability_cost">
                           @if ($errors->has('fire_public_liability_cost'))
                          <span class="help-block">{{ $errors->first('fire_public_liability_cost') }}</span>
                           @endif    
                          </div>   
                        </div>

                         <div class="col-sm-6">
                          <div class="form-group{{ $errors->has('fire_personal_accident_cost') ? ' has-error' : ''}}">
                            <label>Personal accident cost</label>
                            <input type="number" class="form-control" id="fire_personal_accident_cost"  value="{{ Request::old('fire_personal_accident_cost') ?: '' }}"  name="fire_personal_accident_cost">

                           @if ($errors->has('fire_personal_accident_cost'))
                          <span class="help-block">{{ $errors->first('fire_personal_accident_cost') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('fire_pa_benefit_spouse_status') ? ' has-error' : ''}}">
                            <label>If personal accident insurance is required, should it cover spouse too?</label>
                            <select id="fire_pa_benefit_spouse_status" name="fire_pa_benefit_spouse_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
{{--                           @foreach($accounttype as $accounttype)
                        <option value="{{ $accounttype->type }}">{{ $accounttype->type }}</option>
                          @endforeach --}}
                        </select>         
                           @if ($errors->has('fire_pa_benefit_spouse_status'))
                          <span class="help-block">{{ $errors->first('fire_pa_benefit_spouse_status') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>



                        </div>
                        </section>


                      </div>
                      {{-- Fire Insurance End--}}
                         
                      </div>

                    {{-- Step 3 End --}}
                      <div class="step-pane" id="step4">
                      <section class="panel panel-default">
                                 <header class="panel-heading font-bold">                  
                              Premium / Payment
                               </header>
                            <div class="panel-body">
                              
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-8">
                          <div class="form-group{{ $errors->has('gross_premium') ? ' has-error' : ''}}">
                            <label>Gross Premium</label>
                            <div class="input-group m-b">
                            <input type="number" class="form-control" id="gross_premium"  value="{{ Request::old('gross_premium') ?: '' }}"  name="gross_premium"><span class="input-group-addon">.00</span>   
                            </div>      
                           @if ($errors->has('gross_premium'))
                          <span class="help-block">{{ $errors->first('gross_premium') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                           <div class="form-group pull-in clearfix">
                          <div class="col-sm-8">
                          <div class="form-group{{ $errors->has('commission_rate') ? ' has-error' : ''}}">
                            <label>Commission Rate</label>
                            <input type="number" class="form-control" id="commission_rate"  value="{{ Request::old('commission_rate') ?: '' }}"  name="commission_rate">         
                           @if ($errors->has('commission_rate'))
                          <span class="help-block">{{ $errors->first('commission_rate') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                           <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('collection_mode') ? ' has-error' : ''}}">
                            <label>Collection</label>
                            <select id="collection_mode" name="collection_mode" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                            <option value="">-- Not set --</option>
                         @foreach($collectionmodes as $collectionmodes)
                        <option value="{{ $collectionmodes->type }}">{{ $collectionmodes->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('collection_mode'))
                          <span class="help-block">{{ $errors->first('collection_mode') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        
                        <div class="btn-group pull-right">
                        <button type="submit" class="btn btn-rounded btn-sm btn-info">Save Record</button>
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                        </div>

                        </div>
                        </section>

                      </div>

                     
                    </div>
                  </section>
                       
                      </form>
                </section>
                </div>
              </div>


            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop

                 
                   

<script src="{{ asset('/event_components/jquery.min.js')}}"></script>


<script type="text/javascript">
$(function () {
  $('#insurance_period').daterangepicker({
    "minDate": moment('2016-06-14 0'),
    "timePicker": true,
    "timePicker24Hour": true,
    "timePickerIncrement": 15,
    "autoApply": true,
    "locale": {
      "format": "DD/MM/YYYY HH:mm:ss",
      "separator": " - ",
    }
  });
});
</script>

<script>
function  getproductform() 
{

  //alert($('#product').val());
   if( $('#product').val() == "Motor Insurance")
    {
         $('#motorinsurance').show();
          $('#fireinsurance').hide(); 
          $('#travelinsurance').hide(); 
          $('#personalaccidentinsurance').hide(); 
          $('#bondinsurance').hide();
          $('#marineinsurance').hide();
          $('#liabilityinsurance').hide();
   }
  else if( $('#product').val() == "Fire Insurance")
    {
         $('#fireinsurance').show();
          $('#motorinsurance').hide(); 
          $('#travelinsurance').hide(); 
           $('#motorinsurancecomprehensive').hide();
           $('#personalaccidentinsurance').hide(); 
           $('#bondinsurance').hide();
           $('#marineinsurance').hide();
           $('#liabilityinsurance').hide();
   }
else if( $('#product').val() == "Travel Insurance")
    {
      $('#travelinsurance').show(); 
         $('#fireinsurance').hide();
          $('#motorinsurance').hide(); 
           $('#motorinsurancecomprehensive').hide();
           $('#personalaccidentinsurance').hide();
           $('#bondinsurance').hide();
           $('#marineinsurance').hide(); 
           $('#liabilityinsurance').hide();
   }

   else if( $('#product').val() == "Personal Accident Insurance")
    {
      $('#personalaccidentinsurance').show();
      $('#travelinsurance').hide(); 
         $('#fireinsurance').hide();
          $('#motorinsurance').hide(); 
           $('#motorinsurancecomprehensive').hide();
           $('#bondinsurance').hide();
           $('#marineinsurance').hide();
           $('#liabilityinsurance').hide();
            
   }
    else if( $('#product').val() == "Bond Insurance")
    {
      $('#bondinsurance').show();
      $('#personalaccidentinsurance').hide();
      $('#travelinsurance').hide(); 
         $('#fireinsurance').hide();
          $('#motorinsurance').hide(); 
           $('#motorinsurancecomprehensive').hide();
           $('#marineinsurance').hide();
           $('#liabilityinsurance').hide();
            
   }

    else if( $('#product').val() == "Marine Insurance")
    {
      $('#marineinsurance').show();
      $('#bondinsurance').hide();
      $('#personalaccidentinsurance').hide();
      $('#travelinsurance').hide(); 
         $('#fireinsurance').hide();
          $('#motorinsurance').hide(); 
           $('#motorinsurancecomprehensive').hide();
           $('#liabilityinsurance').hide();
           
            
   }

    else if( $('#product').val() == "Liability Insurance")
    {
      $('#marineinsurance').hide();
      $('#bondinsurance').hide();
      $('#personalaccidentinsurance').hide();
      $('#travelinsurance').hide(); 
         $('#fireinsurance').hide();
          $('#motorinsurance').hide(); 
           $('#motorinsurancecomprehensive').hide();
           $('#liabilityinsurance').show();
           
            
   }

   else if( $('#product').val() == "")
    {
        $('#motorinsurance').hide(); 
        $('#fireinsurance').hide(); 
       $('#motorinsurancecomprehensive').hide();
       $('#travelinsurance').hide(); 
       $('#personalaccidentinsurance').hide(); 
       $('#bondinsurance').hide();
       $('#marineinsurance').hide();
       $('#liabilityinsurance').hide();
   }
   else
   {
      $('#motorinsurance').hide(); 
      $('#fireinsurance').hide(); 
      $('#motorinsurancecomprehensive').hide();
      $('#travelinsurance').hide();
      $('#personalaccidentinsurance').hide(); 
      $('#bondinsurance').hide(); 
      $('#marineinsurance').hide();
      $('#liabilityinsurance').hide();


    }
}
</script>

<script>
function  getcomprehensiveform() 
{

  //alert($('#product').val());
   if( $('#preferedcover').val() == "Comprehensive")
    {
         
      $('#motorinsurancecomprehensive').show();
      $('#vehicle_value').prop('disabled', false);
      $('#vehicle_buy_back_excess').prop('disabled', false);
      $('#vehicle_tppdl_value').prop('disabled', false);

          $('#vehicle_body_type').prop('disabled', false);
        $('#vehicle_chassis_number').prop('disabled', false);
         $('#vehicle_cubic_capacity').prop('disabled', false);
          $('#vehicle_make_year').prop('disabled', false);
    }

    else if( $('#preferedcover').val() == "Third Party")
    {
     
       $('#motorinsurancecomprehensive').hide();
       $('#vehicle_value').prop('disabled', true);

     // $('#vehicle_buy_back_excess').prop('disabled', true);
      $('#vehicle_tppdl_value').prop('disabled', true);

       $('#vehicle_body_type').prop('disabled', true);
        $('#vehicle_chassis_number').prop('disabled', true);
         $('#vehicle_cubic_capacity').prop('disabled', true);
          $('#vehicle_make_year').prop('disabled', true);
      
     }

     else if( $('#preferedcover').val() == "Third Party Fire & Theft")
    {
     
       $('#motorinsurancecomprehensive').hide();
        $('#vehicle_value').prop('disabled', false);
      $('#vehicle_buy_back_excess').prop('disabled', false);
      $('#vehicle_tppdl_value').prop('disabled', false);

          $('#vehicle_body_type').prop('disabled', false);
        $('#vehicle_chassis_number').prop('disabled', false);
         $('#vehicle_cubic_capacity').prop('disabled', false);
          $('#vehicle_make_year').prop('disabled', false);
     }

     else if( $('#preferedcover').val() == "")
    {
     
       $('#motorinsurancecomprehensive').hide();
     }

   else
   {
      $('#motorinsurancecomprehensive').hide();
  }
}
</script>

<script type="text/javascript">
$(document).ready(function () {
    $('#motorinsurance').hide(); 
    $('#fireinsurance').hide(); 
    $('#motorinsurancecomprehensive').hide();
    $('#marineinsurance').hide();
    $('#bondinsurance').hide();
    $('#travelinsurance').hide(); 
    $('#personalaccidentinsurance').hide(); 
    $('#liabilityinsurance').hide();   
    $('#pa_activities').select2();
    $('#policy_insurer').select2();
    $('#roofed_with').select2();
    $('#walled_with').select2();
    $('#customer_number').select2();
    $('#vehicle_body_type').select2();
    $('#vehicle_make').select2();
    $('#vehicle_model').select2();
     
  });
</script>


<script type="text/javascript">
function computePremium()
{

  if($('#preferedcover').val()=="")
  {sweetAlert("Please select cover ",'Fill all fields', "error");}
  else if($('#vehicle_value').val()=="" & $('#preferedcover').val()!="Third Party")
  {sweetAlert("Enter vehicle value ",'Fill all fields', "error");}
  else if($('#vehicle_currency').val()=="")
  {sweetAlert("Please select currency ",'Fill all fields', "error");}
 else if($('#vehicle_buy_back_excess').val()=="" & $('#preferedcover').val()!="Third Party")
  {sweetAlert("Please select excess ",'Fill all fields', "error");}
else if($('#vehicle_use').val()=="")
  {sweetAlert("Please select use ",'Fill all fields', "error");}
else if($('#vehicle_risk').val()=="")
  {sweetAlert("Please select risk ",'Fill all fields', "error");}
else if($('#vehicle_seating_capacity').val()=="")
  {sweetAlert("Please enter seat number ",'Fill all fields', "error");}
else if($('#vehicle_cubic_capacity').val()=="")
  {sweetAlert("Please enter cubic capacity ",'Fill all fields', "error");}
else if($('#vehicle_ncd').val()=="")
  {sweetAlert("Please select ncd ",'Fill all fields', "error");}
else if($('#vehicle_fleet_discount').val()=="")
  {sweetAlert("Please select fleet discount ",'Fill all fields', "error");}
  else
  {
    $.get('/compute-motor',
        {


          "preferedcover": $('#preferedcover').val(),
          "vehicle_value": $('#vehicle_value').val(),
          "vehicle_currency": $('#vehicle_currency').val(),
          "vehicle_buy_back_excess": $('#vehicle_buy_back_excess').val(),
          "vehicle_use":  $('#vehicle_use').val(),
          "vehicle_tppdl_value":  $('#vehicle_tppdl_value').val(),
          "vehicle_risk":  $('#vehicle_risk').val(),
          "vehicle_make_year":  $('#vehicle_make_year').val(),
          "vehicle_seating_capacity":  $('#vehicle_seating_capacity').val(), 
          "vehicle_cubic_capacity":  $('#vehicle_cubic_capacity').val(),
          "vehicle_ncd":  $('#vehicle_ncd').val(),      
          "vehicle_fleet_discount":  $('#vehicle_fleet_discount').val()


        },
        function(data)
        { 
          
          $.each(data, function (key, value) {
        
          sweetAlert("Premium Payable : ", data["Premium"], "info");
          $('#gross_premium').val(data.Premium);
       
      });
                                        
        },'json');
  }
}
  
</script>




