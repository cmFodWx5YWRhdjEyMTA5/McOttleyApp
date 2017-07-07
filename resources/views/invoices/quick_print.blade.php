@extends('layouts.default')
@section('content')
          <section class="vbox bg-white">
            <header class="header b-b b-light hidden-print">
              <button href="#" class="btn btn-sm btn-info pull-right" onClick="javascript:window.print();">Print</button>
              
              <p>Invoice</p>
            </header>
            <section class="scrollable wrapper">
              <i class="fa fa-power-off fa fa-3x"></i>
              <div class="row">
                <div class="col-xs-6">
                    <h4>Asterix Brokers Limited</h4>
                  <p><a href="#">www.asterixghana.com</a></p>
                   <p><a href="#">P. O. Box AD 50, Adabraka-Accra</a></p>
                    <p><a href="#">+233 302 544060;+233 302 946019;+233 28 9523683</a></p>
                    
                 <p><a href="#">Account Manager :</a> {{ $bills->account_manager }} </p>
                 <p><a href="#">Description :</a> {{ $bills->description }} </p>
                </div>
                <div class="col-xs-6 text-right">
                  <p class="h4"># {{ $bills->invoice_number }}</p>
                  <h5>{{ date('Y-m-d') }}</h5>   
                  <img src="data:image/png;base64,{{DNS2D::getBarcodePNG($bills->gross_premium, 'QRCODE')}}" alt="barcode" />        
                </div>
              </div>          
          516956257
          1257
              <div class="line"></div>
              <table class="table">
                <thead>
                  <tr>
                    <th width="60">QTY</th>
                   
                    <th>Customer</th>
                    <th>Product</th>
                    <th align="center">Period</th>
                    <th>Currency</th>
                    <th>Sum Insured</th>
                    <th>Premium</th>
                    <th width="140">Unit Price</th>
                    <th width="90">Total</th>
                  </tr>
                </thead>
                <tbody>
                 
                  <tr>
                    <td>1</td>
                
                    <td>{{ $bills->account_name }}</td>
                    <td>{{ $bills->business_class }}</td>
                    <td>{{ $bills->insurance_period_from }} to {{ $bills->insurance_period_to }}</td>
                    <td>{{ $bills->currency }}</td>
                    <td>{{ $bills->sum_insured }}</td>
                    <td>{{ $bills->gross_premium }}</td>
                    <td>{{ $bills->gross_premium }}</td>
                    
                  </tr>
                 
                  <tr>
                    <td colspan="7" class="text-right"><strong>Subtotal</strong></td>
                    <td>{{ $bills->currency }} {{ $bills->gross_premium }}</td>
                  </tr>
         
                  <tr>
                    <td colspan="7" class="text-right no-border"><strong>Total</strong></td>
                    <td><strong>{{ $bills->currency }} {{ $bills->gross_premium }}</strong></td>
                  </tr>
                </tbody>
              </table>
              <h4 class="text-center">Thank you for doing business with us! </h4><br><h4 class="text-center">Please pay in the name of <b>{{ $bills->status }}</b></h4><br><br>
            <p class="text-right payment-methods"><i class="fa fa-cc-visa fa-3x"></i> <i class="fa fa-cc-mastercard fa-3x"></i> <i class="fa fa-cc-discover fa-3x"></i> <i class="fa fa-cc-amex fa-3x"></i> <i class="fa fa-cc-paypal fa-3x"></i> <i class="fa fa-cc-stripe fa-3x"></i></p>

            
            
            </section>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop