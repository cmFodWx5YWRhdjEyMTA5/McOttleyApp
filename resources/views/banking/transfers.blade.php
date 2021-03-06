@extends('layouts.default')
@section('content')
        <section id="content">
          <section class="hbox stretch">
            <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">Payment</div>
              <ul class="nav">
                <li class="b-b b-light"><a href="/banking.banks"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Banks</a></li>
                <li class="b-b b-light"><a href="/banking.accounts"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Banks Accounts</a></li>
                <li class="b-b b-light"><a href="/banking.deposites"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Deposites</a></li>
                <li class="b-b b-light"><a href="/banking.payments"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Payments</a></li>
                <li class="b-b b-light"><a href="/banking.transfers"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Transfers</a></li>
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
                      <a href="#modal_new_bank"  data-toggle="modal" class="btn btn-sm btn-default bootstrap-modal-form-open"><i class="fa fa-group"></i>Perform New Transfer</a>
                    <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print List</a>
                     <span class="badge badge-info">Record(s) Found : {{ $banks->total() }} {{ str_plural('Bank Account', $banks->total()) }} </span>
                    </div>

                  <form action="/account.find" method="GET">
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
                      <table class="table table-striped m-b-none text-sm" width="100%">
                        <thead>
                          <tr>
                            <th width="20"></th>
                            <th>Date</th>
                            <th>Source Bank Name</th>
                            <th>Source Account Name</th>
                            <th>Source Account Number</th>
                            <th>Dest. Bank Name</th>
                            <th>Dest. Account Name</th>
                            <th>Dest. Account Number</th>
                            <th>Transfered By</th>
                            <th>Ref #</th>
                            <th>Soruce Amount</th>
                            <th>Soruce Currency</th>
                            <th>Dest. Amount</th>
                            <th>Dest. Currency</th>
                          </tr>
                        </thead>
                        <tbody>
                     {{--   @foreach( $bank_accounts as $bank_account)
                          <tr>
                            
                            <td><a href="#edit_modal_client" class="bootstrap-modal-form-open" onclick="setAccountNo('{{ $bank_account->id }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-pencil"></i></a></td>
                         
                            <td>{{ $bank_account->bank }}</td>
                            <td>{{ $bank_account->account_name }}</td>
                            <td>{{ $bank_account->account_number }}</td>
                            <td>{{ $bank_account->currency }}</td>
                            <td>{{ $bank_account->created_by }}</td>
                            <td>{{ $bank_account->created_on }}</td>
                            <td>
                              <a href="#" class="active" onclick="deactivateAccount('{{ $bank_account->id }}')" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                            </td> 
                            
                          </tr>
                         @endforeach --}}
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
                     
                        {{--  {!!$bank_accounts->render()!!} --}}
                        
                    </div>
                  </div>
                </footer>
              </section>
            </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop



   
  