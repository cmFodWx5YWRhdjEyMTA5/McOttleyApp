@extends('layouts.default')
@section('content')
        <section id="content">
          <section class="hbox stretch">
            <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">Invoice Manager</div>
              <ul class="nav">
                <li class="b-b b-light"><a href="/invoice"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Pending Invoices</a></li>
                <li class="b-b b-light"><a href="/payments"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Processed Invoices</a></li>
              </ul>
            </aside>
            <aside>
              <section class="vbox">
                <header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                    <div class="col-sm-8 m-b-xs">
                      <a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
                      <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-upload"></i> Upload</a>
                      <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-file"></i> File</a>
                    <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print List</a>
                   <span class="badge badge-info">Record(s) Found : {{ $bills->total() }} {{ str_plural('Invoice', $bills->total()) }} </span> 
                    </div>

                  <form action="/find-invoice" method="GET">
                    <div class="col-sm-4 m-b-xs">
                      <div class="input-group">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Customer, Invoice #, Policy #">
                        <span class="input-group-btn">
                          <button class="btn btn-sm btn-default" type="submit">Go!</button>
                        </span>
                      </div>
                    </div>
                     </form>
                    </div>
                  </div>
                </header>
                <section class="scrollable wrapper w-f">
                  <section class="panel panel-default">
                    <div class="table-responsive">
                      <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            
                            <th width="20"></th>
                            <th width="20"></th>
                            <th>Invoice #</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Date</th>
                             <th>Currency</th>
                            <th>Premium</th>
                            <th>Status</th>
                            <th>Generated By</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                       @foreach( $bills as $bill )
                          <tr>
                             <td><a onclick="makepayment('{{ $bill->id  }}')" class="bootstrap-modal-form-open" href="#make_payment" data-toggle="modal" ><i class="fa fa-money"></i></a></td>
                             <td><a href="/print-invoice/{{ $bill->id }}" data-toggle="modal" ><i class="fa fa-print"></i></a></td>
                            <td>{{ $bill->invoice_number }}</td>
                            <td>{{ $bill->account_name }}</td>
                            <td>{{ $bill->policy_product }}</td>
                            <td>{{ $bill->created_on }}</td>
                            <td>{{ $bill->currency }}</td>
                            <td>{{ $bill->amount }}</td>
                            <td>{{ $bill->status }}</td>
                            <td>{{ $bill->created_by }}</td>
                          </tr>
                         @endforeach 
                        </tbody>
 
                      </table>
                    </div>
                  </section>
                </section>
                <footer class="footer bg-white b-t">
                  <div class="row text-center-xs">
                    <div class="col-md-6 hidden-sm">
                      <p class="text-muted m-t">
                      </p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-right text-center-xs">                
                     
                         {!!$bills->render()!!} 
                        
                    </div>
                  </div>
                </footer>
              </section>
            </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop





<div class="modal fade" id="make_payment" size="600">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Payment</h4>
        </div>
        <div class="modal-body">
          <p></p>
                      <section class="vbox">
                    <header class="header bg-light bg-gradient">
                      <ul class="nav nav-tabs nav-white">
                        
                      </ul>
                    </header>
                    <section class="scrollable">
                      <div class="tab-content">
                        <div class="tab-pane active" id="individual">
                           <form  class="bootstrap-modal-form" data-validate="parsley" method="post" action="/do-payment" class="panel-body wrapper-lg">
                           @include('invoices/dopay')
                        <input type="hidden" name="_token" value="{{ Session::token() }}">
                      </form>
                        </div>
                  
                  
                        </div>
                      </div>
                    </section>
                  </section>
        </div>
        
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>


<script type="text/javascript">
  
function makepayment(id)
{ 

  $.get("/get-invoice-info",
          {"id":id
       
          },
          function(json)
          {

              
                $('#make_payment input[name="payer_name"]').val(json.payer_name);
                $('#make_payment input[name="payer_id"]').val(json.payer_id);
                $('#make_payment input[name="payment_sum"]').val(json.amount);
                $('#make_payment input[name="premium"]').val(json.payable);
                $('#make_payment input[name="reference_number"]').val(json.reference_number);
                $('#make_payment input[name="payer_account_number"]').val(json.policy_number);
               
          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}

</script>
<script src="{{ asset('/event_components/jquery.min.js')}}"></script>


<script type="text/javascript">
$(function () {
  $('#payment_date').daterangepicker({
    "minDate": moment('2016-08-01 0'),
    "singleDatePicker":true,
    "autoApply": true,
    "locale": {
      "format": "DD/MM/YYYY",
      "separator": " - ",
    }
  });
});
</script>
  

