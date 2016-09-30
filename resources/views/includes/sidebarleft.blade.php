  @role(['Receptionist','System Admin','Billing','Doctor','Nurse','Medical Assistant','Cashier','Marketing','Purchases','Laboratory','Pharmacist'])
 <aside class="bg-dark lter aside-md hidden-print" id="nav">          
          <section class="vbox">
           <header class="header lter text-center clearfix" style="background-color: #bc65bd">
              {{-- <div class="btn-group">
                <button type="button" class="btn btn-sm btn-dark btn-icon" title="New project"><i class="fa fa-plus"></i></button>
                <div class="btn-group hidden-nav-xs">
                  <button type="button" class="btn btn-sm btn-dark dropdown-toggle" data-toggle="dropdown">
                    Add
                    <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu text-left">
                    <li><a href="/online-policies/new">New Policy</a></li>
                    <li><a href="/online-quotation/new">New Quote</a></li>
                    <li><a href="/active-customer">New Customer</a></li>
                    <li><a href="/active-customer">New Claim</a></li>
                  </ul>
                </div>
              </div> --}}
            </header>
            <section class="w-f scrollable">
              <div class="slim-scroll" data-height="auto" data-disable-fade-out="true" data-distance="0" data-size="5px" data-color="#333333">
                
                <!-- nav -->
                <nav class="nav-primary hidden-xs">
                  <ul class="nav">
                    <li  class="active">
                      <a href="{{ route('dashboard') }}"   class="active">
                        <i class="fa fa-dashboard icon">
                          <b class="bg-danger"></b>
                        </i>
                        <span>Dashboard</span>
                      </a>
                    </li>
                    
                    <li >
                      <a href="#layout"  >
                        <i class="fa fa-user icon">
                           <b class="dker" style="background-color: #bc65bd"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Account Creation</span>
                      </a>
                      <ul class="nav lt">
                        <li >
                          <a href="/active-customer" >  
                          <b class="badge bg-info pull-right"></b>                                                           
                            <i class="fa fa-angle-right"></i>
                            <span>Manage Account</span>
                          </a>
                        </li>
                       
                      </ul>
                    </li>

                    <li >
                      <a href="#layout"  >
                        <i class="fa fa-gavel icon">
                          <b class="dker" style="background-color: #bc65bd"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Policy Manage</span>
                      </a>
                      <ul class="nav lt">
                        <li >
                          <a href="/online-policies" >  
                          <b class="badge bg-gavel pull-right"></b>                                                           
                            <i class="fa fa-angle-right"></i>
                            <span>New Policy</span>
                          </a>
                        </li>
                        <li >
                          <a href="#" >  
                          <b class="badge bg-info pull-right"></b>                                                           
                            <i class="fa fa-angle-right"></i>
                            <span>Renewals</span>
                          </a>
                        </li>

                        <li >
                          <a href="#" >  
                          <b class="badge bg-info pull-right"></b>                                                           
                            <i class="fa fa-angle-right"></i>
                            <span>Endorsements</span>
                          </a>
                        </li>
                        <li >
                          <a href="#" >  
                          <b class="badge bg-info pull-right"></b>                                                           
                            <i class="fa fa-angle-right"></i>
                            <span>Policy History</span>
                          </a>
                        </li>
                       
                      </ul>
                    </li>
                      @role(['Nurse','System Admin'])
                    <li >
                      <a href="/claims"  >
                        
                        <i class="fa fa-wheelchair icon">
                          <b class="dker" style="background-color: #bc65bd"></b>
                        </i>
                        <span>Claims</span>
                      </a>
                    </li>
                    @endrole
                    @role(['Nurse','System Admin'])
                    <li >
                      <a href="/event-calendar"  >
                        
                        <i class="fa fa-calendar icon">
                          <b class="dker" style="background-color: #bc65bd"></b>
                        </i>
                        <span>Calendar</span>
                      </a>
                    </li>
                    @endrole
                       @role(['Nurse','System Admin'])
                        <li >
                      <a href="#pages"  >
                        <i class="fa fa-file-text icon">
                          <b class="bg-danger"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Invoicing</span>
                      </a>
                      <ul class="nav lt">
                        
                        <li >
                          <a href="/invoice" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Invoices</span>
                          </a>
                        </li>

                        <li >
                          <a href="#" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Generate Invoices</span>
                          </a>
                        </li>
                       
                        <li >
                          <a href="/payments" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Payments</span>
                          </a>
                        </li>

                        <li >
                          <a href="/debt-management" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Debt Management</span>
                          </a>
                        </li>
                       
                      </ul>
                    </li>
                    @endrole
                       @role(['Nurse','System Admin'])
                    <li >
                      <a href="/commission"  >
                        
                        <i class="fa fa-sort-numeric-asc icon">
                          <b class="dker" style="background-color: #bc65bd"></b>
                        </i>
                        <span>Commissions</span>
                      </a>
                    </li>
                    @endrole
                       @role(['Nurse','System Admin'])
                    <li >
                      <a href="#"  >
                        
                        <i class="fa fa-exchange icon">
                          <b class="dker" style="background-color: #bc65bd"></b>
                        </i>
                        <span>Credit Control</span>
                      </a>
                    </li>
                    @endrole
                       
                     <li >
                      <a href="#pages"  >
                        <i class="fa fa-file-text icon">
                           <b class="dker" style="background-color: #bc65bd"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Reports</span>
                      </a>
                      <ul class="nav lt">
                        
                        <li >
                          <a href="/report-stats" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Overview & Statistics</span>
                          </a>
                        </li>

                        <li >
                          <a href="/report-list" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Reports</span>
                          </a>
                        </li>

                        <li >
                          <a href="/financial-reports" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Sales Performance Tracking</span>
                          </a>
                        </li>

                       
                      </ul>
                    </li>
                    @role('System Admin')
                  <li >
                      <a href="#pages"  >
                        <i class="fa fa-wrench icon">
                          <b class="bg-danger"></b>
                        </i>
                        <span class="pull-right">
                          <i class="fa fa-angle-down text"></i>
                          <i class="fa fa-angle-up text-active"></i>
                        </span>
                        <span>Setup</span>
                      </a>
                      <ul class="nav lt">
                        
                        <li >
                          <a href="/reporting" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Banking</span>
                          </a>
                        </li>
                         <li >
                          <a href="/reporting" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Communication</span>
                          </a>
                        </li>
                        <li >
                          <a href="/company.index" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>Company</span>
                          </a>
                        </li>
                        <li >
                          <a href="/manage-users" >                                                        
                            <i class="fa fa-angle-right"></i>
                            <span>User Management</span>
                          </a>
                        </li>
                       
                      </ul>
                    </li>
                    @endrole
                    <li >
                  </ul>
                </nav>
                <!-- / nav -->
              </div>
            </section>
            
            <footer class="footer lt hidden-xs b-t b-dark">
              <div id="chat" class="dropup">
                <section class="dropdown-menu on aside-md m-l-n">
                  <section class="panel bg-white">
                    <header class="panel-heading b-b b-light">Active chats</header>
                    <div class="panel-body animated fadeInRight">
                      <p class="text-sm">No active chats.</p>
                      <p><a href="#" class="btn btn-sm btn-default">Start a chat</a></p>
                    </div>
                  </section>
                </section>
              </div>
              <div id="invite" class="dropup">                
                <section class="dropdown-menu on aside-md m-l-n">
                  <section class="panel bg-white">
                    <header class="panel-heading b-b b-light">
                      {{ Auth::user()->getNameOrUsername() }} <i class="fa fa-circle text-success"></i>
                    </header>
                    <div class="panel-body animated fadeInRight">
                      <p class="text-sm">No contacts in your lists.</p>
                      <p><a href="#" class="btn btn-sm btn-facebook"><i class="fa fa-fw fa-facebook"></i> Invite from Facebook</a></p>
                    </div>
                  </section>
                </section>
              </div>
              <a href="#nav" data-toggle="class:nav-xs" class="pull-right btn btn-sm btn-dark btn-icon">
                <i class="fa fa-angle-left text"></i>
                <i class="fa fa-angle-right text-active"></i>
              </a>
              <div class="btn-group hidden-nav-xs">
                <button type="button" title="Chats" class="btn btn-icon btn-sm btn-dark" data-toggle="dropdown" data-target="#chat"><i class="fa fa-comment-o"></i></button>
                <button type="button" title="Contacts" class="btn btn-icon btn-sm btn-dark" data-toggle="dropdown" data-target="#invite"><i class="fa fa-facebook"></i></button>
              </div>
            </footer>
          </section>
        </aside>
@endrole  