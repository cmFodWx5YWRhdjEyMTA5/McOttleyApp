@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home</a></li>
                <li class="active">Reports</li>
                
              </ul>
            
              <div class="row">

               <div class="col-sm-3 portlet ui-sortable">
              <section class="panel panel-warning portlet-item">
                <header class="panel-heading">
                 Quotes
                </header>
                <div class="list-group bg-white">
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Quotes overview
                  </a>
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Detailed quotes list
                  </a>
                </div>
              </section>
              </div>

               <div class="col-sm-3 portlet ui-sortable">
              <section class="panel panel-info portlet-item">
                <header class="panel-heading">
                 Policies
                </header>
                <div class="list-group bg-white">
                  <a href="/policy-ending" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Ending policies
                  </a>
                  <a href="/policy-cancelled" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Cancelled policies
                  </a>
                 
                  <a href="/policy-renewal" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Renewal report
                  </a>
                  <a href="/policy-active" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Active policies, overview
                  </a>

                   <a href="/policy-registered" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Registered policies report
                  </a>
                </div>
              </section>
              </div>

               <div class="col-sm-3 portlet ui-sortable">
              <section class="panel panel-success portlet-item">
                <header class="panel-heading">
                 Sales
                </header>
                <div class="list-group bg-white">
                  <a href="/sales-summary" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Sales summary report
                  </a>
                  <a href="/sales-main" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Sales report
                  </a>
                  <a href="/sales-commission" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Commission report
                  </a>
                  <a href="/sales-money-flow" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Commission Summary
                  </a>
                
                </div>
              </section>
              </div>

              <div class="col-sm-3 portlet ui-sortable">
              <section class="panel panel-danger portlet-item">
                <header class="panel-heading">
                 Customer billing
                </header>
                <div class="list-group bg-white">
                  <a href="/paid-invoices" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Payments report
                  </a>
                  <a href="/unpaid-invoices" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Unpaid invoices
                  </a>
                 
                  <a href="/invoices-generated" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Generated invoices
                  </a>
                  
                  <a href="/receivables-summary" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Receivables: summary
                  </a>
                  <a href="/receivables-details" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Receivables: detailed report
                  </a>
                
                </div>
              </section>
              </div>
    
              </div>
              

              <div class="row">

              <div class="col-sm-3 portlet ui-sortable">
              <section class="panel panel-danger portlet-item">
                <header class="panel-heading">
                 
                Insurer reporting
                </header>
                <div class="list-group bg-white">
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Accrued installments report to insurer
                  </a>
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Installments unbound to insurer reporting
                  </a>
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Installments accrued, but unpaid to insurer
                  </a>
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Unpaid installments connected to insurer reports
                  </a>
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Installments unpaid to insurer
                  </a>
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Insurer balance report
                  </a>
                  
                
                </div>
              </section>
              </div>


              <div class="col-sm-3 portlet ui-sortable">
              <section class="panel panel-warning portlet-item">
                <header class="panel-heading">
                 
               Customers
                </header>
                <div class="list-group bg-white">
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Customers
                  </a>
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Customer balance report
                  </a>
                  <a href="#" class="list-group-item">
                    <i class="fa fa-fw fa-file"></i> Customer TOP
                  </a>  
                </div>
              </section>
              </div>
               
               

              </div>
     
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop