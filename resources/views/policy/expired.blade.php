
@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Renewal Administration </li>
              </ul>
 


              <div class="row">

                <div class="col-md-12">
                <section class="scrollable wrapper w-f">
                  <section class="panel panel-default">
                  <header class="panel-heading">
                    <form action="/find-policy-detail" method="GET">
                      <div class="input-group text-ms">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search by policy, insurer, customer, cover, status">
                        <div class="input-group-btn">
                           <button class="btn btn-sm btn-dark" type="submit">Search!</button>
                        </div>
                      </div>
                      </form>
                    </header>
                    <div class="table-responsive">

                      <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th>Policy</th>
                            <th>Insurer </th>
                            <th>Validity </th>
                            <th>Customer </th>
                            <th>Cover Type</th>
                            <th>Created By</th>
                           <th>Created On</th>
                            <th>Status</th>
                             @permission('edit-patient')
                            <th width="30"></th>
                            <th width="30"></th>
                            @endpermission 
                            
                          </tr>
                        </thead>
                        <tbody>
                        @foreach( $policies as $key => $policy )
                          <tr>
                           <td>{{ ++$key }}</td>
                           @if($policy->status =='Running')
                            
                              <td><a href="/view-policy/{{ $policy->id }}" class="text-info">{{ $policy->policy_number }}</a></td>
                            @else
                           <td><a href="/view-policy/{{ $policy->id }}" class="text-danger">{{ $policy->policy_number }}</a></td>
                            @endif
                            <td>{{ $policy->policy_insurer }}</td>
                            <td>{{ $policy->insurance_period_from}} to {{ $policy->insurance_period_to}}</td>
                            <td><a href="/customer-profile/{{ $policy->customer_number }}" class="text-default">{{ $policy->fullname }}</a></td>
                            <td>{{ $policy->policy_product }}</td>
                             <td>{{ $policy->created_by }}</td> 
                             <td>{{ $policy->created_on }}</td> 
                            <td>{{ $policy->status }}</td>

                            @permission('edit-patient')
                            <td>
                            <a href="/renew-policy/{{ $policy->id }}" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-refresh"></i></a>
                             </td>
                             <td>
                            <a href="/print-policy/{{ $policy->id }}" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-print"></i></a>
                             </td>
                            
                          
                            @endpermission 
                          </tr>
                         @endforeach 
                        </tbody>
 
                      </table>
                    </div>
                  </section>
                </section>
                </div>
              </div>

            </section>
             <footer class="footer bg-white b-t">
                  

                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t pull-center">
                      <span class="badge badge-info">Record(s) Found : {{ $policies->total() }} {{ str_plural('Policy', $policies->total()) }}</span>
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                        {!!$policies->render()!!}
                        
                    </div>
                  </div>


                </footer>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>

@stop






