@extends('layouts.default')
@section('content')
        <section id="content">
          <section class="hbox stretch">
            <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">Invoice Manager</div>
              <ul class="nav">
                <li class="b-b b-light"><a href="/posting-index"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Pending Debts</a></li>
                <li class="b-b b-light"><a href="/posted-guards"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Processed Debts</a></li>
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
                     <span class="badge badge-info">Record(s) Found : {{ $bills->total() }} {{ str_plural('Bill', $bills->total()) }} </span> 
                    </div>

                  <form action="/find-account" method="GET">
                    <div class="col-sm-4 m-b-xs">
                      <div class="input-group">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search for a client">
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
                      <table class="table table-striped m-b-none">
                        <thead>
                          <tr>
                            
                            <th width="20"></th>
                            <th>Invoice #</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Date</th>
                            <th>Days OverDue</th>
                            <th>Currency</th>
                            <th>Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach( $bills as $bill )
                          <tr>
                           
                            <td><a onclick="makeNewPost('{{ $bill->id  }}')" class="bootstrap-modal-form-open" href="#modal_posting" data-toggle="modal" ><i class="fa fa-print"></i></a></td>
                            
                            <td>{{ $bill->invoice_number }}</td>
                            <td>{{ $bill->account_name }}</td>
                            <td>{{ $bill->policy_product }}</td>
                            <td>{{ $bill->created_on }}</td>
                            <td>{{ $bill->created_on->age }}</td>
                            <td>{{ $bill->currency }}</td>
                            <td>{{ $bill->amount }}</td>
                           
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


  




