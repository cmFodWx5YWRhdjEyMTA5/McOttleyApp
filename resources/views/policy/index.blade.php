
@extends('layouts.default')
@section('content')
<section id="content">
          <section class="vbox">          
            <section class="scrollable padder">
              <ul class="breadcrumb no-border no-radius b-b b-light pull-in">
                <li><a href="index.html"><i class="fa fa-home"></i> Home </a></li>
                <li class="active"> Policy Administration </li>
              </ul>
             
              <section class="panel panel-default">
                <div class="row m-l-none m-r-none bg-light lter">
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-info"></i>
                      <i class="fa fa-gavel fa-stack-1x text-white"></i>
                    </span>

                    <a class="clear" href="/online-policies/new">
                      <span class="h3 block m-t-xs"><strong>{{ $policies->total() }}</strong></span>
                      <small class="text-muted text-uc">Buy New Policy</small>
                    </a>
                  </div>
                  <div class="col-sm-6 col-md-3 padder-v b-r b-light lt">
                    <span class="fa-stack fa-2x pull-left m-r-sm">
                      <i class="fa fa-circle fa-stack-2x text-warning"></i>
                      <i class="fa fa-pencil fa-stack-1x text-white"></i>
                      </span>
                    </span>
                    <a class="clear" href="#">
                      <span class="h3 block m-t-xs"><strong id="bugs">0</strong></span>
                      <small class="text-muted text-uc">Endorsements</small>
                    </a>
                  </div>
                </div>
              </section>


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
                             @permission('edit-customer')
                            <th width="30"></th>
                            <th width="30"></th>
                            <th width="30"></th>
                            <th width="20"></th>
                            @endpermission 
                            
                          </tr>
                        </thead>
                        <tbody>
                        @foreach( $policies as $key => $policy )
                          <tr>
                           <td>{{ ++$key }}</td>
                           @if($policy->status =='Running')
                            
                              <td><a href="/view-policy/{{ $policy->id }}" class="text-info">{{ $policy->policy_number }} @if($policy->policy_product=='Motor Insurance') ( {{ $policy->vehicle_registration_number }} ) @else  @endif </a></td>
                            @else
                           <td><a href="/view-policy/{{ $policy->id }}" class="text-danger">{{ $policy->policy_number }} @if($policy->policy_product=='Motor Insurance') ( {{ $policy->vehicle_registration_number }} ) @else  @endif </a></td>
                            @endif
                            <td>{{ $policy->policy_insurer }}</td>
                            <td>{{ $policy->insurance_period_from}} to {{ $policy->insurance_period_to}}</td>
                            <td><a href="/customer-profile/{{ $policy->customer_number }}" class="text-default">{{ ucwords(strtolower($policy->fullname)) }}</a></td>
                            <td>{{ $policy->policy_product }}</td>
                             <td>{{ $policy->created_by }}</td> 
                             <td>{{ $policy->created_on }}</td> 

                             @if($policy->insurance_period_to < Carbon\Carbon::now())
                            <td>Expired</td>
                            @else
                             <td>{{ $policy->status }}</td>
                             @endif

                            @permission('edit-customer')
                            <td>
                            <a href="/view-policy/{{ $policy->id }}" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-folder-open"></i></a>
                             </td>
                             <td>
                            <a href="/print-policy/{{ $policy->id }}" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-print"></i></a>
                             </td>
                            <td>
                            <a href="{{ route('edit-policy', $policy->id) }}" class="bootstrap-modal-form-open"   id="edit" name="edit" data-toggle="modal" alt="edit"><i class="fa fa-pencil"></i></a>
                             </td>
                           
                             <td>
                              <a href="#" class="" onclick="removePolicy('{{ $policy->id }}','{{ $policy->ref_number }}','{{ $policy->fullname }}')" data-toggle="class"><i class="fa fa-trash"></i> </a>

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

<script type="text/javascript">
  function removePolicy(id,name,refid)
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
             "ID": id,
             "policynumber": refid  
          },
          function(data)
          { 
            
            $.each(data, function (key, value) 
            {
            if(value == "OK")
            {
              swal("Deleted!", name +" was removed from policy list.", "success"); 
               location.reload(true);
             }
            else
            { 
              swal("Cancelled", name +" failed to be removed from policy list.", "error");
              
            }
           
        });
                                          
          },'json');    
           
             } 
        else {     
          swal("Cancelled", name +" failed to be removed from policy list.", "error");   
        } });

    
   }
</script>

<script type="text/javascript">
$(function () {
  $('#departure_date').daterangepicker({
     "minDate": moment('2010-06-14 0'),
    "maxDate": moment(),
    "singleDatePicker":true,
    "autoApply": true,
    "showDropdowns": true,
    "locale": {
      "format": "DD/MM/YYYY HH:mm:ss",
      "separator": " - ",
    }
  });
});
</script>




