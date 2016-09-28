@extends('layouts.default')
@section('content')
<section class="vbox">
            <header class="header bg-white b-b b-light">
              <p class="h4 text-dark"><strong>Customer Number : {{ $customers[0]->account_number  }}</strong></p>
              
              <div class="btn-group pull-right">
              <p>
                    <a href="#" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-ban"></i> Cancel</a>
                    <a href="#" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-trash"></i> Delete</a>
                    <a href="#" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw  fa-refresh"></i> Renew</a>
                    <a href="#" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw  fa-lock"></i> Lock</a>
                    <a href="#" class="btn btn-rounded btn-sm btn-default"><i class="fa fa-fw fa-print"></i> Print</a>
              </p>
              </div>
            </header>
            <section class="scrollable">
              <section class="hbox stretch">
        
                <aside class="bg-white">
                  <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        <li class="active"><a href="#my_info" data-toggle="tab">Overview</a></li>
                        <li class=""><a href="#my_policies" data-toggle="tab">Policies</a></li>
                        <li class=""><a href="#my_objects" data-toggle="tab">Objects</a></li>
                        <li class=""><a href="#my_quotes" data-toggle="tab">Quotes</a></li>
                        <li class=""><a href="#my_invoices" data-toggle="tab">Invoices</a></li>
                        <li class=""><a href="#my_documents" data-toggle="tab">Documents</a></li>
                        <li class=""><a href="#my_claims" data-toggle="tab">Claims</a></li>
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="my_info">
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
                      <label class="col-sm-2 control-label">Customer Type</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $customers[0]->account_type }}" class="form-control rounded">                        
                      </div>
                    </div>
                     <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Name</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $customers[0]->fullname }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Email</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $customers[0]->email }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Mobile Phone</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $customers[0]->mobile_number }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Account Manager</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $customers[0]->account_manager }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Address</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $customers[0]->postal_address }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Filed of Activity</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $customers[0]->field_of_activity }}" class="form-control rounded">                        
                      </div>
                    </div>
                    <div class="line line-dashed line-lg pull-in"></div>
                     <div class="form-group">
                      <label class="col-sm-2 control-label">Status</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $customers[0]->status }}" class="form-control rounded">                        
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
                      <label class="col-sm-2 control-label">Sales Channel</label>
                      <div class="col-sm-10">
                        <input type="text" readonly="true" value="{{ $customers[0]->sales_channel }}" class="form-control rounded">                        
                      </div>
                    </div>
                    </form>
                    </div>
                    </section>



                          </ul>
                        </div>
                        <div class="tab-pane" id="my_policies">
                         <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                           <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th> #</th>
                            <th>Policy Number</th>
                            <th>Insurer</th>
                            <th>Validity</th>
                            <th>Object</th>
                            <th>Premium</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        @foreach($policies as $key => $policy )
                          <tr>
                            <td>{{ $key++ }}</td>
                            <td>{{ $policy->policy_number }}</td>
                            <td>{{ $policy->policy_insurer }}</td>
                            <td>{{ $policy->insurance_period_from }} to {{ $policy->insurance_period_to }}</td>
                            <td>{{ $policy->policy_product }}</td>
                            <td>{{ $policy->amount }}</td>
                            <td>{{ $policy->status }}</td>
                          </tr>
                         @endforeach
                        </tbody>
 
                      </table>
                    </div>
                          </ul>
                        </div>
                        <div class="tab-pane" id="my_objects">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                          <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>Object</th>
                            <th>Type</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    </div>
                          </ul>
                        </div>
                    <div class="tab-pane" id="my_quotes">
                          <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                     <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th>Quote #</th>
                            <th>Object</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Broker</th>
                          </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                      </table>
                    </div>
                          </ul>
                        </div>

                  <div class="tab-pane" id="my_invoices">
                        <ul class="list-group no-radius m-b-none m-t-n-xxs list-group-lg no-border">
                     <div class="table-responsive">
                      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th></th>
                            <th>Invoice #</th>
                            <th>Date</th>
                            <th>Last Payment</th>
                            <th>Currency</th>
                            <th>Invoice Sum</th>
                            <th>Paid Sum</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach($policydetails as $key => $balancesheet )
                          <tr>
                            <td>{{ $key++ }}</td>
                            <td>{{ $balancesheet->invoice_number }}</td>
                            <td>{{ $balancesheet->created_on }}</td>
                            <td>{{ $balancesheet->payment_date }}</td>
                            <td>{{ $balancesheet->currency }}</td>
                            <td>{{ $balancesheet->amount }}</td>
                            <td>{{ $balancesheet->payment_sum }}</td>
                            <td>{{ $balancesheet->status }}</td>
                          </tr>
                         @endforeach
                        </tbody>
                      </table>
                    </div>
                          </ul>
                       
                        </div>

                        <div class="tab-pane" id="my_documents">
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

                        <div class="tab-pane" id="my_claims">
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
                          <h4 class="font-thin padder"><strong> Customer Balance </strong></h4>
                          <ul class="list-group">
                            <div class="list-group no-radius alt">
                          <a class="list-group-item" href="#">
                            <span class="badge bg-default">{{ $policydetails[0]->amount }}</span>
                            <i class="fa fa-money"></i> 
                            Unpaid Invoice
                          </a>
                          <a class="list-group-item" href="#">
                            <span class="badge bg-default">{{ $policydetails[0]->payment_sum }}</span>
                            <i class="fa fa-bar-chart-o"></i> 
                            Payment
                          </a>
                          <a class="list-group-item" href="#">
                            <span class="badge bg-danger">{{ $policydetails[0]->amount - $policydetails[0]->payment_sum }}</span>
                            <i class="fa  fa-heart-o "></i> 
                           Total
                          </a>
                        </div>
                          </ul>
                        </section>
                       


                          <section class="panel panel-default">
                          <h4 class="font-thin padder"><strong> Policies </strong></h4>
                          <ul class="list-group">
                            <div class="list-group no-radius alt">
                          <a class="list-group-item" href="#">
                            <span class="badge bg-info">{{ $policydetails[0]->amount }}</span>
                            <i class="fa fa-money"></i> 
                            Customer paid
                          </a>
                          <a class="list-group-item" href="#">
                            <span class="badge bg-danger">0</span>
                            <i class="fa fa-bar-chart-o"></i> 
                            Customer payable
                          </a>
                          <a class="list-group-item" href="#">
                            <span class="badge bg-light">5</span>
                            <i class="fa  fa-qrcode"></i> 
                           Policy balance
                          </a>
                        </div>
                          </ul>
                        </section>
                       

                        <section class="panel panel-default">
                          <h4 class="font-thin padder"><strong> Sales Opoortunities </strong></h4>
                          <ul class="list-group">
                            <div class="list-group no-radius alt">
                          {{-- <a class="list-group-item" href="#">
                            <span class="badge bg-default">{{ $policydetails[0]->commission }}%</span>
                            <i class="fa fa-money"></i> 
                            Commission 
                          </a>
                          <a class="list-group-item" href="#">
                            <span class="badge bg-default">{{ $policydetails[0]->amount * ($policydetails[0]->commission/100) }}</span>
                            <i class="fa fa-bar-chart-o"></i> 
                            Commission 
                          </a> --}}
                         
                        </div>
                          </ul>
                        </section>
                       

                         <section class="panel panel-default">
                          <h4 class="font-thin padder"><strong>Task</strong></h4>
                          <ul class="list-group">
                            <li class="list-group-item">
                                <p>Wellcome <a href="#" class="text-info">@Drew Wllon</a> and play this web application template, have fun1 </p>
                                <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>
                            </li>
                           
                          </ul>
                        </section>

                           <section class="panel panel-default">
                          <h4 class="font-thin padder"><strong>Notes</strong></h4>
                          <ul class="list-group">
                            <li class="list-group-item">
                                <p>Wellcome <a href="#" class="text-info">@Drew Wllon</a> and play this web application template, have fun1 </p>
                                <small class="block text-muted"><i class="fa fa-clock-o"></i> 2 minuts ago</small>
                            </li>
                           
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






