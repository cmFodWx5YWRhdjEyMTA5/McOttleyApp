
@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Claims Administration </li>   
              </ul>
             

              <div class="row">
                <div class="col-md-12">
                <section class="scrollable wrapper w-f">
                 <form method="post" data-validate="parsley" action="/save-claim" class="panel-body wrapper-lg">
                  <section class="panel panel-default">
                    
                    <div class="wizard clearfix">
                      <ul class="steps">
                        <li data-target="#step1" class="active"><span class="badge badge-info">1</span>Policy Information</li>
                        <li data-target="#step2"><span class="badge">2</span>Claim Information</li>
                        <li data-target="#step3"><span class="badge">3</span>Product Information</li>
                        <li data-target="#step4"><span class="badge">4</span>Claimant</li>
                        <li data-target="#step5"><span class="badge">5</span>Save</li>
                        
                      </ul>
                      <div class="actions">
                        <button type="button" class="btn btn-default btn-xs btn-prev" disabled="disabled">Prev</button>
                        <button type="button" class="btn btn-default btn-xs btn-next" data-last="Finish">Next</button>
                      </div>
                    </div>
                    <div class="step-content">
                    {{-- Step 1 Start --}}
                      <div class="step-pane active" id="step1">
                      
                        <section class="panel panel-default">
                      <div class="panel-body">
                       
                    
                        
                        <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('policy_number') ? ' has-error' : ''}}">
                            <label>Policy</label>
                            <select id="policy_number" data-required="true" name="policy_number" rows="3"  data-trigger="change" tabindex="1" data-placeholder="Select a customer" style="width:100%">
                             <option value="">-- select from here --</option>
                        @foreach($policies as $policies)
                        <option value="{{ $policies->policy_number }}">{{ $policies->policy_number }} | {{ $policies->fullname }} | {{ $policies->policy_product }} </option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('policy_number'))
                          <span class="help-block">{{ $errors->first('policy_number') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                      </div>
                    </section>

                      </div>
                    {{-- Step 1 End --}}  



                    {{-- Step 2 Start --}}
                      <div class="step-pane" id="step2">
                     
                          <section class="panel panel-default">
                             <header class="panel-heading font-bold">                  
                              Claim Information
                             </header>
                        <div class="panel-body">
                        
                        <div class="form-group pull-in clearfix">
                         
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('status_of_claim') ? ' has-error' : ''}}">
                            <label>Status</label>
                            <select id="status_of_claim" name="status_of_claim" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                        @foreach($status_of_claim as $status_of_claim)
                        <option value="{{ $status_of_claim->type }}">{{ $status_of_claim->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('status_of_claim'))
                          <span class="help-block">{{ $errors->first('status_of_claim') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('insurer_reference_id') ? ' has-error' : ''}}">
                            <label>Insurer Reference ID</label>
                            <input type="text" class="form-control" name="insurer_reference_id" id="insurer_reference_id" placeholder="" value="{{ old('time') }}">
                           @if ($errors->has('insurer_reference_id'))
                          <span class="help-block">{{ $errors->first('insurer_reference_id') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                        <div class="form-group @if($errors->has('loss_date')) has-error @endif">
                        <label for="loss_date">Loss Date & Time</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="loss_date" id="loss_date" placeholder="Select your time" value="{{ old('loss_date') }}">
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('loss_date'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('loss_date') }}
                       </p>
                        @endif
                      </div>
                      </div>
                      </div>

                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                       <div class="form-group @if($errors->has('submit_broker_date')) has-error @endif">
                        <label for="submit_broker_date">Submitted To Broker</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="submit_broker_date" id="submit_broker_date" placeholder="Select your time" value="{{ old('submit_broker_date') }}">
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('submit_broker_date'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('submit_broker_date') }}
                       </p>
                        @endif
                      </div>
                      </div>
                      </div>
                        
                        <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                       <div class="form-group @if($errors->has('submit_insurer_date')) has-error @endif">
                        <label for="submit_insurer_date">Submitted To Insurer</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="submit_insurer_date" id="submit_insurer_date" placeholder="Select your time" value="{{ old('submit_insurer_date') }}">
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('submit_insurer_date'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('submit_insurer_date') }}
                       </p>
                        @endif
                      </div>
                      </div>
                      </div>

                      <div class="form-group pull-in clearfix">
                        <div class="col-sm-12">
                       <div class="form-group @if($errors->has('settlement_date')) has-error @endif">
                        <label for="settlement_date">Settlement Date</label>
                        <div class="input-group">
                        <input type="text" class="form-control" name="settlement_date" id="settlement_date" placeholder="Select your settlement_date" value="{{ old('settlement_date') }}">
                         <span class="input-group-addon">
                      <span class="fa fa-calendar"></span>
                      </span>
                      </div>
                        @if ($errors->has('settlement_date'))
                        <p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span> 
                        {{ $errors->first('settlement_date') }}
                       </p>
                        @endif
                      </div>
                      </div>
                      </div>

                        <div class="form-group pull-in clearfix">
                         
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('claim_handler') ? ' has-error' : ''}}">
                            <label>Claim Handler</label>
                            <select id="claim_handler" name="claim_handler" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                            <option value=" {{ Auth::user()->getNameOrUsername() }}"> {{ Auth::user()->getNameOrUsername() }}</option>
                           
                     @foreach($intermediary as $intermediary)
                        <option value="{{ $intermediary->username }}">{{ $intermediary->username }}</option>
                          @endforeach --}}
                        </select>         
                           @if ($errors->has('claim_handler'))
                          <span class="help-block">{{ $errors->first('claim_handler') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                      
                      </div>
                    </section>
                    
                    <section class="panel panel-default">
                             <header class="panel-heading font-bold">                  
                              Loss Information
                             </header>
                        <div class="panel-body">


                           <div class="form-group pull-in clearfix">
                         
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('location_of_loss') ? ' has-error' : ''}}">
                            <label>Location of Loss or Incidence</label>
                             <textarea type="text" rows="3" class="form-control" id="location_of_loss" name="location_of_loss" value="{{ Request::old('location_of_loss') ?: '' }}"></textarea>         
                           @if ($errors->has('location_of_loss'))
                          <span class="help-block">{{ $errors->first('location_of_loss') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        

                          <div class="form-group pull-in clearfix">
                         
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('loss_amount') ? ' has-error' : ''}}">
                            <label>Loss Amount</label>
                            <input type="number" class="form-control" name="loss_amount" id="loss_amount" placeholder="" value="{{ old('loss_amount') }}">         
                           @if ($errors->has('loss_amount'))
                          <span class="help-block">{{ $errors->first('loss_amount') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('excess_amount') ? ' has-error' : ''}}">
                            <label>Deductible/Excess Amount </label>
                            <div class="input-group">
                             <input type="number" class="form-control" name="excess_amount" id="excess_amount" placeholder="" value="{{ old('excess_amount') }}">
                             <span class="input-group-addon">
                            <span class="fa fa-money"></span>
                            </span>         
                           @if ($errors->has('excess_amount'))
                          <span class="help-block">{{ $errors->first('excess_amount') }}</span>
                           @endif    
                          </div>
                          </div>   
                        </div>
                        </div>

                        </div>
                    </section>

                     <section class="panel panel-default">
                             <header class="panel-heading font-bold">                  
                              Insurer Contact
                             </header>
                        <div class="panel-body">


                           <div class="form-group pull-in clearfix">
                         
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('insurer_contact_name') ? ' has-error' : ''}}">
                            <label>Insurer Contact Name</label>
                            <input type="text" class="form-control" name="insurer_contact_name" id="insurer_contact_name" placeholder="" value="{{ old('insurer_contact_name') }}">
                           @if ($errors->has('insurer_contact_name'))
                          <span class="help-block">{{ $errors->first('insurer_contact_name') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        

                          <div class="form-group pull-in clearfix">
                         
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('insurer_contact_email') ? ' has-error' : ''}}">
                            <label>Insurer Contact Email</label>
                            <input type="text" class="form-control" name="insurer_contact_email" id="insurer_contact_email" placeholder="" value="{{ old('insurer_contact_email') }}">
                           @if ($errors->has('insurer_contact_email'))
                          <span class="help-block">{{ $errors->first('insurer_contact_email') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                          <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('insurer_contact_phone') ? ' has-error' : ''}}">
                            <label>Insurer Contact Phone </label>
                            <input type="text" class="form-control" name="insurer_contact_phone" id="insurer_contact_phone" placeholder="" value="{{ old('insurer_contact_phone') }}">       
                           @if ($errors->has('insurer_contact_phone'))
                          <span class="help-block">{{ $errors->first('insurer_contact_phone') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                        </div>
                    </section>
        
                      </div>
                    {{-- Step 2 End --}}
                    {{-- Step 3 Start --}}
                    <div class="step-pane" id="step3">
                        <section class="panel panel-default">
                             <header class="panel-heading font-bold">                  
                              Insurer Contact
                             </header>
                        <div class="panel-body">

                           <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('loss_cause') ? ' has-error' : ''}}">
                            <label>Cause Of Loss </label>
                            <select id="loss_cause" name="loss_cause" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b">
                             <option value="">-- Not set --</option>
                          @foreach($loss_causes as $loss_cause)
                        <option value="{{ $loss_cause->type }}">{{ $loss_cause->type }}</option>
                          @endforeach 
                        </select>         
                           @if ($errors->has('loss_cause'))
                          <span class="help-block">{{ $errors->first('loss_cause') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        

                          <div class="form-group pull-in clearfix">
                         
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('loss_description') ? ' has-error' : ''}}">
                            <label>Loss / Damage Description </label>
                            <textarea type="text" rows="3" class="form-control" id="loss_description" name="loss_description" value="{{ Request::old('loss_description') ?: '' }}"></textarea> 
                           @if ($errors->has('loss_description'))
                          <span class="help-block">{{ $errors->first('loss_description') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                      

                        </div>
                    </section>

                    </div>

                    {{-- Step 3 End --}}
                      <div class="step-pane" id="step4">

                       <section class="panel panel-default">
                             <header class="panel-heading font-bold">                  
                              Claimant Info
                             </header>
                        <div class="panel-body">

                           <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('claimant_insured_status') ? ' has-error' : ''}}">
                            <label>Is policy holder claimant ? </label>
                            <select id="claimant_insured_status" name="claimant_insured_status" rows="3" tabindex="1" data-placeholder="Select here.." class="form-control m-b" onchange="getclaimsform()">
                          <option value=""></option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>         
                           @if ($errors->has('claimant_insured_status'))
                          <span class="help-block">{{ $errors->first('claimant_insured_status') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>
                        </div>
                    </section>

                    
                    <div id="claimantdetails" name="claimantdetails">
                       <section class="panel panel-default">
                             <header class="panel-heading font-bold">                  
                              Claimant(s)
                             </header>
                        <div class="panel-body">

                           <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('claimant_name') ? ' has-error' : ''}}">
                            <label>Claimant Name  </label>
                            <input type="text" class="form-control" name="claimant_name" id="claimant_name" placeholder="" value="{{ old('claimant_name') }}">       
                           @if ($errors->has('claimant_name'))
                          <span class="help-block">{{ $errors->first('claimant_name') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('claimant_address') ? ' has-error' : ''}}">
                            <label>Claimant Address  </label>
                            <input type="text" class="form-control" name="claimant_address" id="claimant_address" placeholder="" value="{{ old('claimant_address') }}">       
                           @if ($errors->has('claimant_address'))
                          <span class="help-block">{{ $errors->first('claimant_address') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('claimant_email') ? ' has-error' : ''}}">
                            <label>Claimant E-mail Address  </label>
                            <input type="text" class="form-control" name="claimant_email" id="claimant_email" placeholder="" value="{{ old('claimant_email') }}">       
                           @if ($errors->has('claimant_email'))
                          <span class="help-block">{{ $errors->first('claimant_email') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('claimant_phone') ? ' has-error' : ''}}">
                            <label>Claimant Phone No.  </label>
                            <input type="text" class="form-control" name="claimant_phone" id="claimant_phone" placeholder="" value="{{ old('claimant_phone') }}">       
                           @if ($errors->has('claimant_phone'))
                          <span class="help-block">{{ $errors->first('claimant_phone') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>


                         <div class="form-group pull-in clearfix">
                          <div class="col-sm-12">
                          <div class="form-group{{ $errors->has('claimant_dob') ? ' has-error' : ''}}">
                            <label>Claimant Date of Birth  </label>
                            <input type="text" class="form-control" name="claimant_dob" id="claimant_dob" placeholder="" value="{{ old('claimant_dob') }}">       
                           @if ($errors->has('claimant_dob'))
                          <span class="help-block">{{ $errors->first('claimant_dob') }}</span>
                           @endif    
                          </div>   
                        </div>
                        </div>

                    </div>
                    </section>
                    </div>


                      </div>
                      
                       <div class="step-pane" id="step5">

                  


                       <button type="submit" class="btn btn-success btn-s-xs">Save Record</button>
                       </div>

                    </div>
                  </section>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
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
  $('#loss_date').daterangepicker({
    "minDate": moment('2010-06-14 0'),
     "maxDate": moment(),
    "singleDatePicker":true,
    "timePicker": true,
    "timePicker24Hour": true,
    "timePickerIncrement": 1,
    "autoApply": true,
    "showDropdowns": true,
    "locale": {
      "format": "DD/MM/YYYY HH:mm:ss",
      "separator": " - ",
    }
  });
});
</script>

<script type="text/javascript">
$(function () {
  $('#submit_broker_date').daterangepicker({
     "minDate": moment('2010-06-14 0'),
    "maxDate": moment(),
    "singleDatePicker":true,
    "autoApply": true,
    "showDropdowns": true,
    "locale": {
      "format": "DD/MM/YYYY HH:mm:ss",
      "separator": " - ",
    }
  });
});
</script>
<script type="text/javascript">
$(function () {
  $('#submit_insurer_date').daterangepicker({
     "minDate": moment('2010-06-14 0'),
    "maxDate": moment(),
    "singleDatePicker":true,
    "autoApply": true,
    "showDropdowns": true,
    "locale": {
      "format": "DD/MM/YYYY HH:mm:ss",
      "separator": " - ",
    }
  });
});
</script>
<script type="text/javascript">
$(function () {
  $('#settlement_date').daterangepicker({
    "minDate": moment('2010-06-14 0'),
    "maxDate": moment(),
    "singleDatePicker":true,
    "autoApply": true,
    "showDropdowns": true,
    "locale": {
      "format": "DD/MM/YYYY HH:mm:ss",
      "separator": " - ",
    }
  });
});
</script>
<script>
function  getclaimsform() 
{
    //alert($('#claimant_insured_status'));
  //alert($('#product').val());
   if( $('#claimant_insured_status').val() == "No")
    {

         $('#claimantdetails').show();
         
   }
  else if( $('#claimant_insured_status').val() == "Yes")
    {
        $('#claimantdetails').hide();
   }

   else
   {
     $('#claimantdetails').hide();
    }
}
</script>


<script type="text/javascript">
$(document).ready(function () {
     $('#claimantdetails').hide();
     $('#policy_number').select2();
  });
</script>
