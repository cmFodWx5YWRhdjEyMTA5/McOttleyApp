@extends('layouts.default')
@section('content')
<section class="vbox">
            <header class="header bg-white b-b b-light">
              <p class="h4 text-dark"><strong>Policy : {{ $policydetails->policy_number }}</strong></p>
              
              <div class="btn-group pull-right">
              <p>
                    <a href="#" onclick="suspendPolicy('{{ $policydetails->id }}','{{ $policydetails->fullname }}')" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-archive"></i> Suspend</a>
                    <a href="/edit-policy/{{ $policydetails->id }}" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-pencil"></i> Edit</a>
                    <a href="#" onclick="cancelPolicy('{{ $policydetails->id }}','{{ $policydetails->fullname }}')" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-ban"></i> Cancel</a>
                    <a href="#" onclick="deletePolicy('{{ $policydetails->id }}','{{ $policydetails->fullname }}')" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-trash"></i> Delete</a>
                    <a href="/renew-policy/{{ $policydetails->id }}" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw  fa-refresh"></i> Renew</a>
                    <a href="#" onclick="lockPolicy('{{ $policydetails->id }}','{{ $policydetails->fullname }}')" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw  fa-lock"></i> Lock</a>
                    <a href="/print-policy/{{ $policydetails->id }}" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-print"></i> Print</a>
              </p>
              </div>
            </header>
            <section class="scrollable">
              <section class="hbox stretch">
        
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#consultation_tab" data-toggle="tab">Overview</a></li>
                        <li class=""><a href="#diagnosis_tab" data-toggle="tab">Coverage</a></li>
                        <li class=""><a href="#invoices_tab" data-toggle="tab">Invoices</a></li>
                        <li class=""><a href="#document_tab" data-toggle="tab">Document</a></li>
                        <li class=""><a href="#claims_tab" data-toggle="tab">Claims</a></li>
                        <li class=""><a href="#surgeries_tab" data-toggle="tab">CRM</a></li>
                        <li class=""><a href="#surgeries_tab" data-toggle="tab">Logs</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="consultation_tab">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                         <br>
                         <br>

                         <section class="panel panel-default">
                <header class="panel-heading font-bold">
                  Policy info
                </header>
                <div class="panel-body">
                  <form class="form-horizontal" method="get">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Customer</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $policydetails->fullname }}" class="form-control rounded">                        
                      </div>
                    </div>
                     <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Coverage</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $policydetails->policy_product }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Object</label>
                      <div class="col-sm-10">
                       @if($policydetails->policy_product == 'Motor Insurance')
                        <input type="text" readonly="true"  value="{{ $fetchrecord->vehicle_registration_number }}" class="form-control rounded">
                        @else
                       <input type="text" readonly="true"  value="Nothing to show" class="form-control rounded">
                       @endif
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Policy type</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $policydetails->policy_type }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Insurer</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $policydetails->policy_insurer }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Policy number</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $policydetails->policy_number }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Issue date</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $policydetails->created_on }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Start date</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $policydetails->insurance_period_from }}" class="form-control rounded">                        
                      </div>
                    </div>
                     <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">End date</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $policydetails->insurance_period_to }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $policydetails->status }}" class="form-control rounded">                        
                      </div>
                    </div>

                    </form>
                    </div>
                    </section>

                <section class="panel panel-default">
                <header class="panel-heading font-bold">
                  Sales
                </header>
                <div class="panel-body">
                  <form class="form-horizontal" method="get">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Sales type</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $policydetails->policy_sales_type }}" class="form-control rounded">                        
                      </div>
                    </div>
                    </form>
                    </div>
                    </section>


                <section class="panel panel-default">
                <header class="panel-heading font-bold">
                  Renewal
                </header>
                <div class="panel-body">
                  <form class="form-horizontal" method="get">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Renewal status</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="Not Renewed" class="form-control rounded">                        
                      </div>
                    </div>
                    </form>
                    </div>
                    </section>



                          </ul>
                        </div>
                        <div class="tab-pane" id="diagnosis_tab">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                                   <section class="panel panel-info portlet-item">
                                      <header class="panel-heading">
                                        Quick View
                                      </header>
                                      @if($policydetails->policy_product == 'Motor Insurance')
                                      <div class="list-group bg-white">
                                        <a href="#" class="list-group-item">
                                          </i>Cover : {{ $fetchrecord->preferedcover}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Vehicle Value : {{ $fetchrecord->vehicle_currency}}{{ $fetchrecord->vehicle_value}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Buy Back Excess : {{ $fetchrecord->vehicle_buy_back_excess}}
                                        </a>
                                       <a href="#" class="list-group-item">
                                          </i>Increase Standard Limit : {{ $fetchrecord->vehicle_tppdl_value}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Vehicle Make : {{ $fetchrecord->vehicle_make}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Vehicle Model : {{ $fetchrecord->vehicle_model}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Body Type : {{ $fetchrecord->vehicle_body_type}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Vehicle Use : {{ $fetchrecord->vehicle_use}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Make Year : {{ $fetchrecord->vehicle_make_year}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Seating Capacity : {{ $fetchrecord->vehicle_seating_capacity}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Cubic Capacity : {{ $fetchrecord->vehicle_cubic_capacity}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Registration Number : {{ $fetchrecord->vehicle_registration_number}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Chassis Number : {{ $fetchrecord->vehicle_chassis_number}}
                                        </a>
                                      </div>

                                      @elseif($policydetails->policy_product == 'Travel Insurance')
                                      <div class="list-group bg-white">
                                        <a href="#" class="list-group-item">
                                          </i>Date of Departure : {{ $fetchrecord->departure_date}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Date of Arrival : {{ $fetchrecord->arrival_date}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Destination Address : {{ $fetchrecord->destination_country}}
                                        </a>
                                       <a href="#" class="list-group-item">
                                          </i>Passport No. : {{ $fetchrecord->passport_number}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Issuing Country : {{ $fetchrecord->issuing_country}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Citizenship : {{ $fetchrecord->citizenship}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Name of Beneficiary : {{ $fetchrecord->beneficiary_name}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Relationship with Beneficiary : {{ $fetchrecord->beneficiary_relationship}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Beneficiary contact details : {{ $fetchrecord->beneficiary_contact}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Particulars of other persons who are to be insured : {{ $fetchrecord->insured_persons}}
                                        </a>
                                      </div>

                                       @elseif($policydetails->policy_product == 'Personal Accident Insurance')
                                        <div class="list-group bg-white">
                                        <a href="#" class="list-group-item">
                                          </i>Sum Insured : {{ $fetchrecord->pa_sum_insured}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Height : {{ $fetchrecord->pa_height}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Weight : {{ $fetchrecord->pa_weight}}
                                        </a>
                                       <a href="#" class="list-group-item">
                                          </i>Marital Status : {{ $fetchrecord->marital_status}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Nature of Work : {{ $fetchrecord->nature_of_work}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Nature of Accident : {{ $fetchrecord->pa_nature_of_accident}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Activities Detail : {{ $fetchrecord->pa_activities}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Benefit Details : {{ $fetchrecord->pa_benefit_details}}
                                        </a>
                                        
                                      </div>

                                      @elseif($policydetails->policy_product == 'Fire Insurance')
                                        <div class="list-group bg-white">
                                        <a href="#" class="list-group-item">
                                          </i>Risk Covered : {{ $fetchrecord->fire_risk_covered}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Sum Insured : {{ $fetchrecord->fire_building_cost}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Deductible : {{ $fetchrecord->fire_deductible}}
                                        </a>
                                       <a href="#" class="list-group-item">
                                          </i>Personal Property Coverage : {{ $fetchrecord->fire_personal_property_coverage}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Temporay Rental Costs Coverage : {{ $fetchrecord->fire_temporary_rental_cost}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Building Address : {{ $fetchrecord->fire_building_address}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Property Type : {{ $fetchrecord->fire_property_type}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Construction details of your wall : {{ $fetchrecord->walled_with}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Construction details of your roof : {{ $fetchrecord->roofed_with}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Is your building subject to a mortgage loan? : {{ $fetchrecord->fire_mortgage_status}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Mortgage company : {{ $fetchrecord->fire_mortgage_company}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Property Content  : {{ $fetchrecord->property_content}}
                                        </a>
                                        
                                      </div>

                                      @elseif($policydetails->policy_product == 'Bond Insurance')
                                        <div class="list-group bg-white">
                                        <a href="#" class="list-group-item">
                                          </i>Bond Type : {{ $fetchrecord->bond_risk_type}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Bond Interest : {{ $fetchrecord->bond_interest}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Bond Interest Address : {{ $fetchrecord->bond_interest_address}}
                                        </a>
                                       <a href="#" class="list-group-item">
                                          </i>Contract Sum : {{ $fetchrecord->contract_sum}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Sum Insured : {{ $fetchrecord->bond_sum_insured}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Contract Description : {{ $fetchrecord->bond_contract_description}}
                                        </a>
                                        
                                      </div>

                                      @elseif($policydetails->policy_product == 'Engineering Insurance')
                                        <div class="list-group bg-white">
                                        <a href="#" class="list-group-item">
                                          </i>Risk Type : {{ $fetchrecord->car_risk_type}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Parties Involved : {{ $fetchrecord->car_parties}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Nature of Business : {{ $fetchrecord->car_nature_of_business}}
                                        </a>
                                       <a href="#" class="list-group-item">
                                          </i>Contract Description : {{ $fetchrecord->car_contract_description}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Engineering Sum Insured : {{ $fetchrecord->car_contract_sum}}
                                        </a>
                                        <a href="#" class="list-group-item">
                                          </i>Deductible : {{ $fetchrecord->car_deductible}}
                                        </a>
                                         <a href="#" class="list-group-item">
                                          </i>Items : {{ $fetchrecord->car_endorsements}}
                                        </a>
                                        
                                      </div>

                                      @else
                                      <div>
                                        
                                      </div>
                                      @endif

                          </section>
                          </ul>
                        </div>
                        <div class="tab-pane" id="claims_tab">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <div class="table-responsive">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                                      <thead>
                                        <tr>
                                          <th>Claim ID </th>
                                          <th>Policy </th>
                                          <th>Insurer</th>
                                          <th>Status</th>
                                          <th>Product</th>
                                          <th>Broker</th>
                                          <th>Loss Date</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                     @foreach( $claims as $claim )
                                      <tr>
                                        <td><a href="/claim-profile/{{ $claim->id }}">{{ $claim->claim_number }}</a></td>
                                        <td>{{ $claim->policy_number }}</td>
                                        <td>{{ $claim->policy_insurer }}</td>
                                        <td>{{ $claim->status_of_claim }}</td>
                                        <td>{{ $claim->policy_product }}</td>
                                        <td>{{ $claim->claim_handler }}</td>
                                        <td>{{ $claim->loss_date }}</td>
                                      </tr>
                                     @endforeach 
                                      </tbody>
               
                                    </table>
                                  </div>
                          </ul>
                        </div>
                        <div class="tab-pane" id="document_tab">
                         <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <header class="panel-heading">
                      <a href="#attach_document" class="bootstrap-modal-form-open" data-toggle="modal"><span class="label bg-success pull-right">Add New</span></a>
                      
                    </header>
                          <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>File</th>
                            <th>Comment</th>
                            <th>Added</th>
                          </tr>
                        </thead>
                        <tbody>
                        
                        @foreach($images as $image)
                         <tr>
                        <td>{{ $image->filename }}</td>
                        <td>{{ $image->created_by }}</td>
                        <td>{{ $image->created_on }}</td>
                        <td>
                            <a href="{!! '/uploads/images/'.$image->filepath !!}" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-eye"></i></a>
                        </td>
                         <td>
                            <a href="#" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-trash"></i></a>
                        </td>
                          
                        </tr>
                        @endforeach

                        </tbody>
                      </table>
                    </div>
                          </ul>
                        </div>

                         <div class="tab-pane" id="allergy_tab">

                       {{--    @foreach($images as $image)
                          <div id="gallery" class="gallery">
                           <div class="item">
                            <img src="{!! '/uploads/images/'.$image->filepath !!}"  width="400px" height="400px" />
                              <a href="{!! '/uploads/images/'.$image->filepath !!}" width="800px" height="800px" ></a>                  
                                <div class="desc">
                              <h4>{{ $image->filename }}</h4>
                             <p>{{ $image->filepath }}</p>
                              <span>{{ $image->created_on }}</span>
                               </div>
                          </div>
                        </div>
                      @endforeach --}}
                        </div>

                        <div class="tab-pane" id="invoices_tab">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                                 <div class="table-responsive">
                                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                                      <thead>
                                        <tr>
                                           <th>Invoice #</th>
                                            <th>Date</th>
                                            <th>Currency</th>
                                            <th>Premium</th>
                                            <th>Paid</th>
                                            <th>Status</th>
                                            <th>Generated By</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                     @foreach($bills as $bill )
                                    <tr>
                                      <td>{{ $bill->invoice_number }}</td>
                                      <td>{{ $bill->created_on }}</td>
                                      <td>{{ $bill->currency }}</td>
                                      <td>{{ $bill->amount }}</td>
                                      <td>{{ $bill->paid_amount }}</td>
                                      <td>{{ $bill->status }}</td>
                                      <td>{{ $bill->created_by }}</td>
                                    </tr>
                                   @endforeach 
                                      </tbody>
               
                                    </table>
                                  </div>
                          </ul>
                        </div>

                        <div class="tab-pane" id="surgeries_tab">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          {{--  @foreach($consultations as $consult)
                            <li class="list-group-item">
                              <a href="#" class="thumb-sm pull-left m-r-sm">
                                <img src="/images/avatar_default.jpg" class="img-circle">
                              </a>
                              <a href="#" class="clear">
                                <small class="pull-right">{{ $consult->date }}</small>
                                <strong class="block">{{ $consult->medication }}</strong>
                                <small>{{ $consult->doctorid }}</small>
                              </a>
                            </li>
                            @endforeach --}}
                          </ul>
                        </div>


                      </div>
                    </section>
                  </section>
                </aside>
                <aside class="col-lg-4 b-l">
                  <section class="vbox">
                    <section class="scrollable">
                      <div class="wrapper">

                        <section class="panel panel-default">
                          <h4 class="font-thin padder"><strong> Premium </strong></h4>
                          <ul class="list-group">
                            <div class="list-group no-radius alt">
                          <a class="list-group-item" href="#">
                            <span class="badge bg-default">{{ $balancesheet->amount }}</span>
                            <i class="fa fa-money"></i> 
                            Gross premium
                          </a>
                          <a class="list-group-item" href="#">
                            <span class="badge bg-default">0</span>
                            <i class="fa fa-bar-chart-o"></i> 
                            Installments
                          </a>
                          <a class="list-group-item" href="#">
                            <span class="badge bg-default">{{ $balancesheet->note }}</span>
                            <i class="fa  fa-qrcode"></i> 
                           Collection
                          </a>
                          <a class="list-group-item" href="#">
                            <span class="badge bg-danger">{{ $policydetails->amount }}</span>
                            <i class="fa  fa-heart-o "></i> 
                           Net premium
                          </a>
                        </div>
                          </ul>
                        </section>
                       

                         <section class="panel panel-default">
                          <h4 class="font-thin padder"><strong> Discount </strong></h4>
                          <ul class="list-group">
                            <li class="list-group-item">
                                <p>{{ $fetchrecord->vehicle_ncd * 100}}%</p>
                               
                            </li>
                           
                          </ul>
                        </section>

                          <section class="panel panel-default">
                          <h4 class="font-thin padder"><strong> Customer payment </strong></h4>
                          <ul class="list-group">
                            <div class="list-group no-radius alt">
                          <a class="list-group-item" href="#">
                            <span class="badge bg-info">{{ $bills->sum('paid_amount') }}</span>
                            <i class="fa fa-money"></i> 
                            Customer paid
                          </a>
                          <a class="list-group-item" href="#">
                            <span class="badge bg-danger">{{ $bills->sum('amount') }}</span>
                            <i class="fa fa-bar-chart-o"></i> 
                            Customer payable
                          </a>
                          <a class="list-group-item" href="#">
                            <span class="badge bg-light">{{    $bills->sum('amount') - $bills->sum('paid_amount')  }}</span>
                            <i class="fa  fa-qrcode"></i> 
                           Policy balance
                          </a>
                        </div>
                          </ul>
                        </section>
                       

                        <section class="panel panel-default">
                          <h4 class="font-thin padder"><strong> Commission </strong></h4>
                          <ul class="list-group">
                            <div class="list-group no-radius alt">
                          <a class="list-group-item" href="#">
                            <span class="badge bg-default">{{ $balancesheet->commission_rate }}%</span>
                            <i class="fa fa-money"></i> 
                            Commission Rate
                          </a>
                           <a class="list-group-item" href="#">
                            <span class="badge bg-default">{{ $balancesheet->amount * ($balancesheet->commission_rate/100) }}</span>
                            <i class="fa fa-bar-chart-o"></i> 
                            Gross Commission
                          </a>
                          <a class="list-group-item" href="#">
                            <span class="badge bg-default">{{ (($balancesheet->amount * ($balancesheet->commission_rate/100)) * 5/100) }}</span>
                            <i class="fa fa-bar-chart-o"></i> 
                            Tax
                          </a>
                          <a class="list-group-item" href="#">
                            <span class="badge bg-default">{{ ($balancesheet->amount * ($balancesheet->commission_rate/100)) - (($balancesheet->amount * ($balancesheet->commission_rate/100)) * 5/100) }}</span>
                            <i class="fa fa-bar-chart-o"></i> 
                            Commission Receivable
                          </a>
                         
                        </div>
                          </ul>
                        </section>
                       

                

                      </div>
                    </section>
                    </section>
                    </aside>
                    </section>
                    </section>
                    </section>

  @stop

   <div class="modal fade" id="attach_document" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Attach Document</h4>
        </div>

        <div class="modal-body">
         <div class="fallback">
          <form method="post"  enctype="multipart/form-data" action="/uploadfiles">
          <input type="text" class="form-control" width="1000px" height="40px" name="filename" id="filename" placeholder="Enter file name" /><br>
          <input type="file" class="form-control dropbox" width="500px" height="40px" name="image" /><br>
          <input type="submit" name="submit"  class="btn btn-success btn-s-xs" value="upload" />
          <input type="hidden" name="_token" value="{{ Session::token() }}">
          <input type="hidden" name="selectedid" id="selectedid" value="{{ $policydetails->policy_number }}">
          <input type="hidden" name="selectedcustomer" id="selectedcustomer" value="{{ $policydetails->customer_number }}">
        </form>
        </div>
          <br>
          <br>
          <br>
              <div class="jumbotron how-to-create">
                <ul>
                    <li>Documents/Images are uploaded as soon as you drop them</li>
                    <li>Maximum allowed size of image is 8MB</li>
                </ul>

            </div>

      </div>
      </div>
      </div>
      </div>


<script type="text/javascript">
  function deletePolicy(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to remove "+name+" from the policy list?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/delete-policy',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was delete from policy list.", "success"); 
               location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to delete.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to delete.", "error");   
        } });

    
   }

   function suspendPolicy(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to suspend "+name+" from the policy list?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/suspend-policy',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Suspended!", name +" was suspended from policy list.", "success"); 
               location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to suspend.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to suspend.", "error");   
        } });

    
   }


   function cancelPolicy(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to cancel "+name+" from the policy list?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/cancel-policy',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Cancelled!", name +" was cancelled from policy list.", "success"); 
               location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to cancel.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to cancel.", "error");   
        } });

   }

   function lockPolicy(id,name)
   {
      swal({   
        title: "Are you sure?",   
        text: "Do you want to lock "+name+" from the policy list?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Yes, delete it!",   
        cancelButtonText: "No, cancel plx!",   
        closeOnConfirm: false,   
        closeOnCancel: false }, 
        function(isConfirm){   
          if (isConfirm) 
          { 
          $.get('/lock-policy',
          {
             "ID": id 
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Locked!", name +" was locked in policy list.", "success"); 
               location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to lock.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to lock.", "error");   
        } });

   }
</script>






