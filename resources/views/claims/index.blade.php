
@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Claims Administration </li>   
              </ul>
             
              <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                      <i class="fa fa-wheelchair fa-stack-1x text-white"></i>
                    </span>
                    <a class="clear" href="/add-claims">
                      <span class="h3 block m-t-xs"><strong>23</strong></span>
                      <small class="text-muted text-uc">File New Claim</small>
                    </a>
                  </div>
                 
                </div>
              </section>


              <div class="row">
                <div class="col-md-12">
                <section class="scrollable wrapper w-f">
                  <section class="panel panel-default">
                  <header class="panel-heading">
                    <form action="/find-provider" method="GET">
                      <div class="input-group text-ms">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Claim ID,Customer, Status, Product">
                        <div class="input-group-btn">
                           <button class="btn btn-sm btn-dark" type="submit">Search!</button>
                        </div>
                      </div>
                      </form>
                    </header>
                    <div class="table-responsive">
                      <table class="table table-striped m-b-none">
                        <thead>
                          <tr>
                            <th>Claim ID </th>
                            <th>Policy </th>
                            <th>Customer</th>
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
                            <td>{{ $claim->fullname }}</td>
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
                  </section>
                </section>
                </div>
              </div>


            </section>
              <footer class="footer bg-white b-t">
                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t">
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                        
                        
                    </div>
                  </div>
                </footer>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop
