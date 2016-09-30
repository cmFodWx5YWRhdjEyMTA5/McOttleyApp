<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['XSS']], function () {

Route::get('/',
	['uses' => '\OrionMedical\Http\Controllers\AuthController@getSignin',
	 'as' => 'auth.signin',  
	 ]);

Route::get('/auth/login',
	['uses' => '\OrionMedical\Http\Controllers\AuthController@getSignin',
	 'as' => '/auth/login',  
	 ]);


Route::get('/dashboard',
	['uses' => '\OrionMedical\Http\Controllers\HomeController@index',
	 'as' => 'dashboard',
	  ]);

Route::get('/business.summary',
	['uses' => '\OrionMedical\Http\Controllers\HomeController@getTotals',
	 'as' => 'business.summary',
	  ]);

Route::post('/uploadfiles', 
	['uses' =>'\OrionMedical\Http\Controllers\ImageController@postUpload',
	'as' => 'upload-files',
 ]);

Route::post('/upload-document', 
	['uses' =>'\OrionMedical\Http\Controllers\ImageController@postUploadDocuments',
	'as' => 'upload-document',
 ]);





//Authentication
Route::get('/signup',
	['uses' => '\OrionMedical\Http\Controllers\AuthController@getSignup',
	 'as' => 'auth.signup', ]);

Route::get('/manage-users',
	['uses' => '\OrionMedical\Http\Controllers\AuthController@getUsers',
	 'as' => 'manage-users', ]);

Route::post('/signup',
	['uses' => '\OrionMedical\Http\Controllers\AuthController@postSignup',]);

Route::get('/signin',
	['uses' => '\OrionMedical\Http\Controllers\AuthController@getSignin',
	 'as' => 'auth.signin', ]);

Route::post('/signin',
	['uses' => '\OrionMedical\Http\Controllers\AuthController@postSignin',
	
	 ]);

Route::get('auth/logout', '\OrionMedical\Http\Controllers\AuthController@getSignOut');


Route::get('/signout', function(){
  Auth::logout(); //logout the current user
  Session::flush(); //delete the session
  return Redirect::to('login'); //redirect to login page
});

//Client Registration and Management routes

Route::get('/find-customer', 
	['uses' => '\OrionMedical\Http\Controllers\KYCController@getSearchResults', 
	'as' => 'find-customer', ]);

Route::get('/active-customer',
	['uses' => '\OrionMedical\Http\Controllers\KYCController@activeCustomer',
	 'as' => 'active-customer', ]);

Route::get('/inactive-customer',
	['uses' => '\OrionMedical\Http\Controllers\KYCController@inactiveCustomer',
	 'as' => 'inactive-customer', ]);


Route::get('/customer-profile/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\KYCController@getProfile',
	'as' => 'customer-profile',]);

Route::post('/create-customer',
	['uses' => '\OrionMedical\Http\Controllers\KYCController@postNewCustomer',]);

Route::get('/edit-customer', 
	['uses' => '\OrionMedical\Http\Controllers\KYCController@editCustomer',
	'as' => 'edit-patient',]);


Route::post('/update-customer', 
	['uses' => '\OrionMedical\Http\Controllers\KYCController@updateCustomer',
	'as' => 'update-customer',]);

Route::get('/activate-customer', array(
	'uses' => '\OrionMedical\Http\Controllers\KYCController@activateCustomer',
	'as' => 'activate-customer',
	));

Route::get('/deactivate-customer', array(
	'uses' => '\OrionMedical\Http\Controllers\KYCController@deactivateCustomer',
	'as' => 'deactivate-customer',
	));

Route::get('/delete-customer', 
	['uses' => '\OrionMedical\Http\Controllers\KYCController@deleteCustomer',
	'as' => 'delete-customer',]);


//policy Creation

Route::get('/online-policies',
	['uses' => '\OrionMedical\Http\Controllers\PolicyController@index',
	 'as' => 'online-policies', ]);


Route::get('/online-policies/new',
	['uses' => '\OrionMedical\Http\Controllers\PolicyController@newpolicy',
	 'as' => 'online-policies/new', ]);

Route::get('/find-policy-detail', 
	['uses' => '\OrionMedical\Http\Controllers\PolicyController@getSearchResults', 
	'as' => 'find-policy-detail', ]);


Route::post('/create-policy',
	['uses' => '\OrionMedical\Http\Controllers\PolicyController@createPolicy',]);

Route::get('/compute-motor',
	['uses' => '\OrionMedical\Http\Controllers\PolicyController@computeMotorPremium',
	'as' => 'compute-motor', ]);

Route::get('/view-policy/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\PolicyController@viewPolicy',
	'as' => 'view-policy',]);

Route::get('/edit-policy/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\PolicyController@editPolicy',
	'as' => 'edit-policy',]);

Route::get('/print-policy/{id}',
	['uses' => '\OrionMedical\Http\Controllers\PolicyController@printPolicy',
	 'as' => '/print-policy', ]);

Route::get('/download-schedule/{type}',
	['uses' => '\OrionMedical\Http\Controllers\PolicyController@downloadschedule',
	 'as' => '/download-schedule', ]);

Route::get('/delete-policy', 
	['uses' => '\OrionMedical\Http\Controllers\PolicyController@excludePolicy',
	'as' => 'delete-policy',]);

Route::get('/load-ncd-rate', 
	['uses' => '\OrionMedical\Http\Controllers\PolicyController@loadncd',
	'as' => 'load-ncd-rate',]);

Route::get('/load-risk', 
	['uses' => '\OrionMedical\Http\Controllers\PolicyController@loadrisk',
	'as' => 'load-risk',]);

Route::get('/load-vehicle-model', 
	['uses' => '\OrionMedical\Http\Controllers\PolicyController@loadvehiclemodels',
	'as' => 'load-vehicle-model',]);

Route::get('/load-insurer', 
	['uses' => '\OrionMedical\Http\Controllers\PolicyController@loadinsurer',
	'as' => 'load-insurer',]);

Route::get('/load-product', 
	['uses' => '\OrionMedical\Http\Controllers\PolicyController@loadproduct',
	'as' => 'load-product',]);




//Quotation
Route::get('/online-quotation/new',
	['uses' => '\OrionMedical\Http\Controllers\PolicyController@newquotation',
	 'as' => '/online-quotation/new', ]);

//Motor



//Invoicing
Route::get('/invoice',
	['uses' => '\OrionMedical\Http\Controllers\InvoiceController@getInvoices',
	 'as' => 'invoice', ]);

Route::get('/find-invoice', 
	['uses' => '\OrionMedical\Http\Controllers\InvoiceController@searchInvoice', 
	'as' => 'find-invoice', ]);

Route::get('/get-invoice-info',
	['uses' => '\OrionMedical\Http\Controllers\InvoiceController@fetchInvoiceDetails',
	 'as' => '/get-invoice-info', ]);

Route::post('/do-payment',
	['uses' => '\OrionMedical\Http\Controllers\InvoiceController@doPayment',
	 'as' => '/do-payment', ]);


Route::get('/print-invoice/{id}',
	['uses' => '\OrionMedical\Http\Controllers\InvoiceController@printInvoice',
	 'as' => '/print-invoice', ]);

Route::get('/print-invoice2/{id}',
	['uses' => '\OrionMedical\Http\Controllers\InvoiceController@printtoPDF',
	 'as' => '/print-invoice2', ]);


Route::get('/commission',
	['uses' => '\OrionMedical\Http\Controllers\InvoiceController@getCommissions',
	 'as' => '/commission', ]);


//Invoicing
Route::get('/debt-management',
	['uses' => '\OrionMedical\Http\Controllers\InvoiceController@getdebts',
	 'as' => '/debt-management', ]);

//Invoicing
Route::get('/insurer-reporting',
	['uses' => '\OrionMedical\Http\Controllers\InvoiceController@getinsurerreports',
	 'as' => '/insurer-reporting', ]);

Route::get('/payments',
	['uses' => '\OrionMedical\Http\Controllers\InvoiceController@getpayments',
	 'as' => '/payments', ]);

Route::get('/send-invoice',
	['uses' => '\OrionMedical\Http\Controllers\InvoiceController@dosendInvoices',
	 'as' => '/send-invoice', ]);


//Claims

Route::get('/claims',
	['uses' => '\OrionMedical\Http\Controllers\ClaimsController@index',
	 'as' => 'claims', ]);


Route::get('/add-claims',
	['uses' => '\OrionMedical\Http\Controllers\ClaimsController@createClaim',
	 'as' => 'add-claims', ]);



Route::post('/save-claim',
	['uses' => '\OrionMedical\Http\Controllers\ClaimsController@addClaim',
	 'as' => '/save-claim', ]);

Route::get('/claim-profile/{id}', 
	['uses' => '\OrionMedical\Http\Controllers\ClaimsController@claimprofile',
	'as' => 'claim-profile',]);




//Reports
Route::get('/report-stats',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@statsreports',
	 'as' => '/reports-stats', ]);

Route::get('/report-list',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@reportsmain',
	 'as' => '/report-list', ]);


Route::get('/policy-ending',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@endingPolicy',
	 'as' => '/policy-ending', ]);

Route::get('/policy-cancelled',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@cancelledPolicy',
	 'as' => '/policy-cancelled', ]);

Route::get('/policy-installment',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@installmentPolicy',
	 'as' => '/policy-installment', ]);

Route::get('/policy-renewal',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@renewalPolicy',
	 'as' => '/policy-renewal', ]);

Route::get('/policy-active',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@activePolicy',
	 'as' => '/policy-active', ]);

Route::get('/policy-registered',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@registeredPolicy',
	 'as' => '/policy-registered', ]);

Route::get('/sales-summary',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@salesSummary',
	 'as' => '/sales-summary', ]);


Route::get('/sales-main',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@salesMain',
	 'as' => '/sales-main', ]);


Route::get('/sales-commission',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@salesCommission',
	 'as' => '/sales-commission', ]);


Route::get('/sales-money-flow',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@salesMoneyflow',
	 'as' => '/sales-money-flow', ]);


Route::get('/invoices-generated',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@generatedInvoices',
	 'as' => '/invoices-generated', ]);

Route::get('/unpaid-installments',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@installmentsUnpaid',
	 'as' => '/unpaid-installments', ]);

Route::get('/overpaid-invoices',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@overPaid',
	 'as' => '/overpaid-invoices', ]);

Route::get('/paid-invoices',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@customerPayments',
	 'as' => '/paid-invoices', ]);

Route::get('/receivables-summary',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@receivableSummary',
	 'as' => '/receivables-summary', ]);

Route::get('/receivables-details',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@receivableDetails',
	 'as' => '/receivables-details', ]);

Route::get('/unpaid-invoices',
	['uses' => '\OrionMedical\Http\Controllers\ReportController@customersUnpaid',
	 'as' => '/unpaid-invoices', ]);



//Events

Route::get('/event-list',
	['uses' => '\OrionMedical\Http\Controllers\EventController@index',
	 'as' => 'event-list', ]);

Route::get('/event-calendar',
	['uses' => '\OrionMedical\Http\Controllers\EventController@calendar',
	 'as' => 'event-calendar', ]);

Route::post('/create-event',
	['uses' => '\OrionMedical\Http\Controllers\EventController@store',]);


Route::get('/event/api', function () {
	$events = DB::table('appointments')->select('id', 'name', 'title', 'start_time as start', 'end_time as end')->get();
	foreach($events as $event)
	{
		$event->title = $event->title . ' - ' .$event->name;
		$event->url = url('events/' . $event->id);
	}
	return $events;
});

Route::get('/delete-appointment', 
	['uses' => '\OrionMedical\Http\Controllers\EventController@deleteappointmentfromevent',
	'as' => 'delete-appointment',]);


//Whatsapp routes
Route::get('/do-registration', 
	['uses' => '\OrionMedical\Http\Controllers\WhatsappController@register',
	'as' => 'do-registration',]);

Route::get('/do-confirm', 
	['uses' => '\OrionMedical\Http\Controllers\WhatsappController@confirmation',
	'as' => 'do-confirm',]);

Route::get('/send-message', 
	['uses' => '\OrionMedical\Http\Controllers\WhatsappController@sendMessage',
	'as' => 'send-message',]);
//route group end
});