@extends('layouts.default')
@section('content')
        <section id="content">
          <section class="hbox stretch">
            <aside class="aside-md bg-white b-r" id="subNav">
              <div class="wrapper b-b header">User Management</div>
              <ul class="nav">
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Enquiry</a></li>
                <li class="b-b b-light"><a href="#"><i class="fa fa-chevron-right pull-right m-t-xs text-xs icon-muted"></i>Roles</a></li>
              </ul>
            </aside>
            <aside>
              <section class="vbox">
                <header class="header bg-white b-b clearfix">
                  <div class="row m-t-sm">
                    <div class="col-sm-8 m-b-xs">
                     @include('includes.alert')
                      <a href="#subNav" data-toggle="class:hide" class="btn btn-sm btn-default active"><i class="fa fa-caret-right text fa-lg"></i><i class="fa fa-caret-left text-active fa-lg"></i></a>
                      <a href="/patient.manage" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-reply-all"></i> Back to Main</a>
                    <a href="#" data-toggle="modal" class="btn btn-sm btn-default"><i class="fa fa-print"></i> Print List</a>
                     <span class="badge badge-info">Record(s) Found : {{ $users->total() }} {{ str_plural('Users', $users->total()) }} </span>
                    </div>

                  <form action="/patient.find" method="GET">
                    <div class="col-sm-4 m-b-xs">
                      <div class="input-group">
                        <input type="text" name='search' id='search' class="input-sm form-control" placeholder="Search for a patient">
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
                            <th width="20"><input type="checkbox"></th>
                            <th width="20"></th>
                            <th>User</th>
                            <th>Department</th>
                            <th>Role</th>
                            <th>Date Added</th>  
                          </tr>
                        </thead>
                        <tbody>
                        @foreach( $users as $user )
                          <tr>
                            <td><input type="checkbox" name="post[]" value="2"></td>
                            <td><a href="#modal_check_in" class="bootstrap-modal-form-open" onclick="getDetails('{{ $user->id }}')"  id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-pencil"></i></a></td>
                            <td>{{ $user->fullname }}</td>
                            <td>{{ $user->location }}</td>
                            <td>{{ $user->usertype }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                              <a href="#" class="active" onclick="deactivateAccount('{{ $user->id }}')" data-toggle="class"><i class="fa fa-check text-success text-active"></i><i class="fa fa-times text-danger text"></i></a>
                            </td>
                            
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
                     
                        {!!$users->render()!!}
                        
                    </div>
                  </div>
                </footer>
              </section>
            </aside>
          </section>
          <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="#nav"></a>
        </section>
@stop


<script>

var account_no = null;
function getDetails(acct_no)
{ 
  account_no = acct_no;
  $.get("/patient.edit",
          {"patient_id":account_no},
          function(json)
          {

                $('#modal_check_in input[name="patient_id"]').val(json.patient_id);
                $('#modal_check_in input[name="fullname"]').val(json.fullname);

          },'json').fail(function(msg) {
          alert(msg.status + " " + msg.statusText);
        });

}

</script>
