<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginCheck;

use App\Http\Controllers\Dashboard;
use App\Http\Controllers\PlaceOrder;
use App\Http\Controllers\SearchOrder;
use App\Http\Controllers\PincodeManage;
use App\Http\Controllers\AdminRiders;
use App\Http\Controllers\AdminClients;
use App\Http\Controllers\SuperAdminClients;
use App\Http\Controllers\AdminExcels;
use App\Http\Controllers\AdminHubs;
use App\Http\Controllers\AdminManifest;
use App\Http\Controllers\AdminMIS;
use App\Http\Controllers\AwbUploads;
use App\Http\Controllers\AdminDailyReport;
use App\Http\Controllers\AdminPODReport;

use App\Http\Controllers\OrderTracking;

use App\Http\Controllers\UserDashboard;
use App\Http\Controllers\UserPlaceOrder;
use App\Http\Controllers\UserSearchOrder;
use App\Http\Controllers\UserPincodeManage;
use App\Http\Controllers\UserOrderManage;
use App\Http\Controllers\UserHubs;
use App\Http\Controllers\UserExcels;


use App\Http\Controllers\RiderDashboard;
use App\Http\Controllers\RiderPlaceOrder;
use App\Http\Controllers\RiderSearchOrder;
use App\Http\Controllers\RiderPincodeManage;

use App\Http\Controllers\LabelsPrintOut;


use App\Http\Controllers\CustomerDashboard;
use App\Http\Controllers\TestControl;
use App\Http\Controllers\UserBarcode;
use App\Http\Controllers\APIXpressBee;
use App\Http\Controllers\APIBigShip;
use App\Http\Controllers\APITest;
use App\Http\Controllers\V1\ConsignmentController;
use Illuminate\Support\Facades\DB;

Route::group([
	'prefix' => 'v1'
], function () {
	Route::get('/track', [ConsignmentController::class, 'getTrackConsignments']);
	Route::post('/track', [ConsignmentController::class, 'postTrackConsignments']);
	Route::get('/upload', [ConsignmentController::class, 'getUploadConsignments']);
	Route::post('/upload', [ConsignmentController::class, 'postUploadConsignments']);
});
Route::group([
	'prefix' => 'api/v1'
], function () {
	Route::get('/track', [ConsignmentController::class, 'openApiTrackConsignments']);
});



// Check for server DATE and time
Route::get('/server-stats', function () {
	$data = [
		'now' => now(),
		'date_default_timezone_get' => date_default_timezone_get(),
		'DB_TimeZone' => DB::select('select NOW() as the_time'),
		'space' => shell_exec('df -h'),
		// 'git' => shell_exec('git status'),
	];

	return response()->json($data);
});


// Awb Uplaods
Route::get('/awb-details', [AwbUploads::class, 'Home']);
Route::post('/awb-details-upload', [AwbUploads::class, 'Add']);
// Awb Uplaods



// PDF Testing
Route::get('/pdfchecking', [UserDashboard::class, 'pdfchecking']);
// PDF Testing

// XpressBee
Route::get('/API1', [APIXpressBee::class, 'Check']);
Route::post('/API1', [APIXpressBee::class, 'Check']);
Route::get('/API11', [APIXpressBee::class, 'test']);
Route::get('/API3', [APITest::class, 'test']);

Route::get('/XpressBeeToken', [APIXpressBee::class, 'TokenGenerate']);

// XpressBee

// Barcode
Route::get('/barcode', [UserBarcode::class, 'index']);
// Barcode


// Test
Route::get('/test', [TestControl::class, 'index']);
Route::get('/test1', [TestControl::class, 'upload']);
// Test

Route::get('/Order_API_details', [APIBigShip::class, 'OrderdetailsCourier']);
// API Cron Jobs
// smartshiptoken
Route::get('/smartshiptokenadd', [AdminDailyReport::class, 'smartshiptoken']);
Route::get('/shiprockettokenadd', [AdminDailyReport::class, 'shiprockettoken']);

// AWB API
Route::get('/UPBulk_Order_API', [APIBigShip::class, 'OrderPlaceToCourier']);

Route::get('/Addshiproket_hubs_API', [APIBigShip::class, 'addhubinshiprocket']);

Route::get('/UPBulk_Order_API1', [APIBigShip::class, 'OrderPlaceToCourier000122']);
Route::get('/UPBulk_Order_API2', [APIBigShip::class, 'OrderPlaceToCourier2']);
Route::get('/UPBulk_Order_API3', [APIBigShip::class, 'OrderPlaceToCourier3']);
Route::get('/UPBulk_Order_API4', [APIBigShip::class, 'OrderPlaceToCourier4']);
Route::get('/UPBulk_Order_API5', [APIBigShip::class, 'OrderPlaceToCourier5']);
Route::get('/UPBulk_Order_API6', [APIBigShip::class, 'OrderPlaceToCourier6']);
Route::get('/UPBulk_Order_API7', [APIBigShip::class, 'OrderPlaceToCourier7']);
Route::get('/UPBulk_Order_API8', [APIBigShip::class, 'OrderPlaceToCourier8']);
Route::get('/UPBulk_Order_API9', [APIBigShip::class, 'OrderPlaceToCourier9']);
Route::get('/UPBulk_Order_API10', [APIBigShip::class, 'OrderPlaceToCourier10']);
Route::get('/UPBulk_Order_API121', [APIBigShip::class, 'OrderPlaceToCourier121']);
Route::get('/UPBulk_cancel_Order_API', [APIBigShip::class, 'OrdercancelToCourier']);



Route::get('/UPBulk_Order_APItwo', [APIBigShip::class, 'OrderPlaceToCouriersecond']);
Route::get('/UPBulk_Order_APIthree', [APIBigShip::class, 'OrderPlaceToCourierthird']);
Route::get('/UPBulk_Order_APIfour', [APIBigShip::class, 'OrderPlaceToCourierfourth']);
Route::get('/UPBulk_Order_APIfive', [APIBigShip::class, 'OrderPlaceToCourierfifth']);
Route::get('/UPBulk_Order_APIsix', [APIBigShip::class, 'OrderPlaceToCouriersixth']);
Route::get('/UPBulk_Order_APIseven', [APIBigShip::class, 'OrderPlaceToCourierseventh']);
Route::get('/UPBulk_Order_APIeight', [APIBigShip::class, 'OrderPlaceToCouriereight']);
Route::get('/UPBulk_Order_APInine', [APIBigShip::class, 'OrderPlaceToCourierninth']);
Route::get('/UPBulk_Order_APIten', [APIBigShip::class, 'OrderPlaceToCouriertenth']);
// AWB API
// Hub API
Route::get('/hub-created', [AdminHubs::class, 'IntargosWarehouse']);
// Hub API
// API Cron Jobs


// Website Pages
// Route::get('/',[Dashboard::class,'Home']);
Route::get('/', function () {
	/*
    if(!empty(session('UserLogin'))){
		return redirect('/AdminPanel');
	}
	if(!empty(session('UserLogin2'))){
		return redirect('/AdminPanel');
	}
	if(!empty(session('UserLogin3'))){
		return redirect('/AdminPanel');
	}
	return redirect('/AdminLogin');
	*/
	return view('index');
});
Route::get('/about', function () {
	return view('about');
});
Route::get('/contact', function () {
	return view('contact');
});
Route::get('/why-us', function () {
	return view('why-us');
});
Route::get('/cookie-policy', function () {
	return view('cookie-policy');
});
Route::get('/careers', function () {
	return view('careers');
});

Route::get('/privacy', function () {
	return view('privacy');
});
Route::get('/terms-and-conditions', function () {
	return view('terms-and-conditions');
});

Route::get('/pricing', function () {
	return view('pricing');
});


// Route::get('/about', function () {
// 	return view('about');
// });
Route::get('/service', function () {
	return view('service');
});
// Route::get('/contact', function () {
// 	return view('contact');
// });
Route::get('/login', function () {
	return view('login');
});
Route::get('/registration', function () {
	return view('registration');
});
Route::get('/forgot-password', function () {
	return view('forgot-password');
});
// Website Pages










Route::get('/Transit-orders', [UserPlaceOrder::class, 'Transit_orders']);
Route::post('/Transit-orders', [UserPlaceOrder::class, 'Transit_ordersFilter']);


Route::get('/update-zones', [UserPlaceOrder::class, 'updateZone']);
Route::get('/wallter-transtion', [UserPlaceOrder::class, 'wallterTranstion']);


// Super Admin
Route::get('/superlogin', [LoginCheck::class, 'SuperLoginCheck']);
Route::post('/superlogin', [LoginCheck::class, 'SuperLoginCheckIt']);

Route::post('/request-quote', [LoginCheck::class, 'requestQuote']);


Route::get('/superpanel', [Dashboard::class, 'SuperHome']);
Route::get('/superpanel-courier-summary', [Dashboard::class, 'superPanel_courier_summary']);


Route::get('/super-new-admin', [SuperAdminClients::class, 'NewClient']);
Route::post('/super-new-admin', [SuperAdminClients::class, 'NewClientAdd']);
Route::get('/super-all-admin', [SuperAdminClients::class, 'AllClient']);


Route::get('/super-all-admin-new', [SuperAdminClients::class, 'allAdmin']);
Route::get('/admin-user-list/{id}', [SuperAdminClients::class, 'allAdminUser']);

// add wallet blance limit if incress than stop order punch 
Route::get('/user-wallet-limit/{id}', [SuperAdminClients::class, 'userWalletLimit']);
Route::post('/user-wallet-limit-add/{id}', [SuperAdminClients::class, 'userAddWalletLimit']);

// add super admin to user new balance like com remittence 
Route::get('user-wallet-blance/{id}', [SuperAdminClients::class, 'addUserBlance']);
Route::post('user-wallet-blance-add/{id}', [SuperAdminClients::class, 'addNewUserBlance']);


// Route::get('/client-courier-assign',[SuperAdminClients::class,'CourierAssign']);
Route::get('/super-courier-assign/{id}', [SuperAdminClients::class, 'api_assing']);
Route::get('/super-courier-rate/{id}', [SuperAdminClients::class, 'rate_assing']);
Route::get('/super-courier-assign-updated', [SuperAdminClients::class, 'api_assing_update']);


Route::get('/add-rate/{id}', [SuperAdminClients::class, 'add_rate_list']);

Route::get('/super-rate-list', [SuperAdminClients::class, 'superRateList']);
Route::post('/super-admin-rate-add', [SuperAdminClients::class, 'super_admin_rate_add']);


Route::get('/super-admin-pincode', [SuperAdminClients::class, 'superAdminPincode']);
Route::post('/super-picode-add', [SuperAdminClients::class, 'superPicodeAdd']);
Route::get('/pincode-bulk-delete/{id}', [SuperAdminClients::class, 'superAdminPincodeDelete']);


Route::get('/edit-rate/{id}', [SuperAdminClients::class, 'editRate']);
Route::post('/update-edit-rate', [SuperAdminClients::class, 'updateEditRate']);
Route::get('/rate-delete/{id}', [SuperAdminClients::class, 'RateDelete']);

Route::get('/super-new-admin-edit/{id}', [SuperAdminClients::class, 'ClientEdit']);
Route::post('/super-new-admin-edit-update', [SuperAdminClients::class, 'ClientUpdate']);

Route::get('/super-new-admin-delete/{id}', [SuperAdminClients::class, 'ClientDelete']);

// Coureir Manage
Route::get('/super-courier', [SuperAdminClients::class, 'Couriers']);
Route::get('model_new_data/{name}', [SuperAdminClients::class, 'model']);
Route::get('/super-courier-new', [SuperAdminClients::class, 'CouriersAdd']);
Route::post('/courier-new', [SuperAdminClients::class, 'CouriersAddupt']);
// 		Route::get('/super-courier-assign',[SuperAdminClients::class,'api_assing']);
// Coureir Manage

// Awb Uplaods
Route::get('/super-awb-details', [AwbUploads::class, 'SuperHome']);
Route::post('/super-awb-details-upload', [AwbUploads::class, 'SuperAdd']);
// Awb Uplaods

// Order Tracking
Route::get('/super-order-tracking-no', [OrderTracking::class, 'TrackPageSuperAdmin']);
Route::post('/super-order-tracking-no', [OrderTracking::class, 'TrackOrderSuperAdmin']);
// Order Tracking

// Super Admin

Route::get('/ofd-orders', [UserOrderManage::class, 'ofd_orders']);
Route::post('/ofd-orders', [UserOrderManage::class, 'ofd_ordersfilter']);














// Login
// Route::get('/AdminLogin',[LoginCheck::class,'Home']);
Route::get('/AdminLogin', function () {
	if (!empty(session('UserLogin'))) {
		// return view('Admin.Dashboard');
		return redirect('/AdminPanel');
	}
	if (!empty(session('UserLogin2'))) {
		// return view('UserPanel.Dashboard');
		return redirect('/AdminPanel');
	}
	if (!empty(session('UserLogin3'))) {
		// return view('CustomerPanel.Dashboard');
		return redirect('/AdminPanel');
	}
	return view('Login.Login');
});
Route::post('/AdminLogin', [LoginCheck::class, 'LoginCheckIt']);

Route::get('/AdminPanel', [Dashboard::class, 'Home']);
// Route::get('/AdminPanel', function () {
// 	return view('login');
// });

Route::get('/admin-dashboard', [Dashboard::class, 'NewDashboard']);

Route::get('/AdminCurrentMonthOrdersDash', [Dashboard::class, 'CurrentOrdersDash']);
Route::get('/AdminLastMonthOrdersDash', [Dashboard::class, 'LastOrdersDash']);
Route::get('/AdminTodayOrdersDash', [Dashboard::class, 'TodayOrdersDash']);
Route::get('/AdminTodayBookingDash', [Dashboard::class, 'TodayBookingDash']);
Route::get('/AdminWeeklyPerformanceDash', [Dashboard::class, 'OrderPerformanceDash']);

Route::get('/AdminTodayOrders', [Dashboard::class, 'TodayOrders']);
Route::get('/AdminYesterdayOrders', [Dashboard::class, 'YesterdayOrders']);
Route::get('/AdminCurrentMonthOrders', [Dashboard::class, 'CurrentOrders']);

Route::get('/admin-data-filter', [Dashboard::class, 'adminDataFilter']);
Route::get('/admin-courierwise-performance', [Dashboard::class, 'courierWisePerformance']);
Route::get('/admin-zonewise-performance', [Dashboard::class, 'zoneWisePerformance']);

Route::get('/AdminLastMonthOrders', [Dashboard::class, 'LastOrders']);
Route::get('/Admin7DaysOrders', [Dashboard::class, 'Day7Orders']);
Route::get('/Admin30DaysOrders', [Dashboard::class, 'Day30Orders']);
Route::get('/Admin90DaysOrders', [Dashboard::class, 'Day90Orders']);

Route::get('/AdminTodayOrdersGraph', [Dashboard::class, 'TodayOrdersGraph']);
Route::get('/AdminYesterdayOrdersGraph', [Dashboard::class, 'YesterdayOrdersGraph']);
Route::get('/AdminCurrentMonthOrdersGraph', [Dashboard::class, 'CurrentOrdersGraph']);
Route::get('/AdminLastMonthOrdersGraph', [Dashboard::class, 'LastOrdersGraph']);
Route::get('/Admin7DaysOrdersGraph', [Dashboard::class, 'Day7OrdersGraph']);
Route::get('/Admin30DaysOrdersGraph', [Dashboard::class, 'Day30OrdersGraph']);
Route::get('/Admin90DaysOrdersGraph', [Dashboard::class, 'Day90OrdersGraph']);


Route::get('/Admin90DaysCourierOrders', [Dashboard::class, 'CourierDay90Orders']);
Route::get('/Admin90DaysCourierPerformance', [Dashboard::class, 'CourierDay90Performance']);
Route::get('/Admin90DaysOrderPerformance', [Dashboard::class, 'CourierOrder90Performance']);


Route::get('/AdminPanelRegistration', [LoginCheck::class, 'Registration']);
Route::post('/NewClientRegistrationAdd', [LoginCheck::class, 'RegistrationAdd']);
Route::post('/new-client-registration-added', [LoginCheck::class, 'RegistrationAddNew']);
// Login

Route::get('/Logout', function () {
	auth()->logout();
	session()->flush();
	return redirect('/login');
});
Route::post('/webhook', [UserSearchOrder::class, 'xpressWebhook']);

Route::get('/order-update-status', [UserSearchOrder::class, 'orderstatus']);
Route::get('/order-update-status3', [UserSearchOrder::class, 'orderstatus3']);
Route::get('/order-update-status31', [UserSearchOrder::class, 'orderstatus311']);
Route::get('/order-update-status311', [UserSearchOrder::class, 'orderstatus31']);
Route::get('/order-update-shiprocket', [UserSearchOrder::class, 'shiproketstatusupdate']);

Route::get('/order-update-pickup-ecom', [UserSearchOrder::class, 'orderStatuspickup']);
Route::get('/order-update-ecom', [UserSearchOrder::class, 'orderStatusecompickup']);
Route::get('/order-update-intransit-ecom', [UserSearchOrder::class, 'orderStatusecomintranit']);
Route::get('/order-update-ofd-ecom', [UserSearchOrder::class, 'orderStatusofd']);

Route::get('/order-update-pickup-xpress', [UserSearchOrder::class, 'orderStatuspickupxpres']);
Route::get('/order-update-ofd-xpress', [UserSearchOrder::class, 'orderStatusxpressofd']);
Route::get('/order-update-intransit-xpress', [UserSearchOrder::class, 'orderStatusxpresstransit']);
Route::get('/order-update-xpress', [UserSearchOrder::class, 'orderStatusxpresspickup']);

Route::get('/order-update-bluedart', [UserSearchOrder::class, 'orderStatusBluedart']);

// 	Admin-Panel		Admin-Panel		Admin-Panel Start

Route::get('/All_Orders', [PlaceOrder::class, 'AllOrders']);
Route::post('/All_Orders', [PlaceOrder::class, 'AllOrdersFilter']);

Route::get('/All_Orders_Manage', [PlaceOrder::class, 'AllOrderManage']);
Route::post('/All_Orders_Manage', [PlaceOrder::class, 'AllOrderManageAction']);

Route::get('/All_Orders_Pending', [PlaceOrder::class, 'AllOrdersPending']);
Route::post('/All_Orders_Pending', [PlaceOrder::class, 'AllOrdersPendingFilter']);

Route::get('/All_Orders_Status_Change', [PlaceOrder::class, 'AllOrdersStatus']);

Route::get('/All_Orders_Complete', [PlaceOrder::class, 'AllOrdersComplete']);
Route::post('/All_Orders_Complete', [PlaceOrder::class, 'AllOrdersCompleteFilter']);

Route::get('/All_Orders_Cancel', [PlaceOrder::class, 'AllOrdersCancel']);
Route::post('/All_Orders_Cancel', [PlaceOrder::class, 'AllOrdersCancelFilter']);

Route::get('/All_Orders_Uploaded', [PlaceOrder::class, 'AllOrdersUploaded']);
Route::post('/All_Orders_Uploaded', [PlaceOrder::class, 'AllOrdersUploadedFilter']);

Route::get('/All_Orders_Canceled', [PlaceOrder::class, 'AllOrdersCanceled']);
Route::post('/All_Orders_Canceled', [PlaceOrder::class, 'AllOrdersCanceledFilter']);

Route::get('/afailed-orders', [PlaceOrder::class, 'FailedOrders']);
Route::post('/afailed-orders', [PlaceOrder::class, 'FailedOrdersFilter']);

// Route::get('/Single_Product',[PlaceOrder::class,'SingleOrder']);
// Route::post('/Single_Product_Add',[PlaceOrder::class,'SingleOrderAdd']);

// Route::get('/Bulk_Order',[PlaceOrder::class,'BulkOrder']);
// Route::post('/Bulk_Order_Add',[PlaceOrder::class,'BulkOrderAdd']);

Route::get('/Reverse_Order', [PlaceOrder::class, 'SingleReverse']);

Route::get('/Bulk_Reverse_Order', [PlaceOrder::class, 'BulkReverse']);


// Tracking Order
Route::get('/order-tracking', [OrderTracking::class, 'TrackPage']);
Route::post('/order-tracking', [OrderTracking::class, 'TrackOrder']);
// Route::get('/TrackOrder1/{id}',[OrderTracking::class,'TrackOrder1']);
Route::get('/order-tracking-no', [OrderTracking::class, 'TrackPageAdmin']);
Route::post('/order-tracking-no', [OrderTracking::class, 'TrackOrderAdmin']);


Route::get('/order-autoupdate-awbs', [OrderTracking::class, 'OrderAutoUpdateawbs']);
Route::get('/order-autoupdate-status', [OrderTracking::class, 'OrderAutoUpdateStatus']);
// Tracking Order


// Riders
Route::get('/New_Rider', [AdminRiders::class, 'NewRider']);
Route::post('/New_Rider', [AdminRiders::class, 'NewRiderAdd']);
Route::get('/All_Rider', [AdminRiders::class, 'AllRider']);
Route::get('/New_Rider_Edit/{id}', [AdminRiders::class, 'RiderEdit']);
Route::post('/New_Rider_Edit_Update', [AdminRiders::class, 'RiderUpdate']);
// Riders




// Client
Route::get('/merchant-summary', [AdminClients::class, 'MerchantSummary']);
Route::post('/merchant-summary', [AdminClients::class, 'MerchantSummarySearch']);
Route::get('/merchant-courier-update/{id}', [AdminClients::class, 'CourierEdit']);
Route::get('/merchant-courier-update', [AdminClients::class, 'CourierEditupt']);

Route::get('/New_Client', [AdminClients::class, 'NewClient']);
Route::post('/New_Client', [AdminClients::class, 'NewClientAdd']);
Route::get('/All_Client', [AdminClients::class, 'AllClient']);
Route::get('/new-request-api', [AdminClients::class, 'Newrequest']);
Route::get('/client-courier-assign', [AdminClients::class, 'CourierAssign']);
Route::get('/New_Client_Edit/{id}', [AdminClients::class, 'ClientEdit']);
Route::post('/New_Client_Edit_Update', [AdminClients::class, 'ClientUpdate']);

Route::get('/client-dashboard/{id}', [AdminClients::class, 'ClientDashboard']);

Route::get('/client-setting/{id}', [AdminClients::class, 'ClientSetting']);
Route::get('/client-financial-details/{id}', [AdminClients::class, 'ClientFinancial']);
Route::get('/client-billing-information/{id}', [AdminClients::class, 'ClientBilling']);
Route::get('/client-courier-permissions/{id}', [AdminClients::class, 'ClientCouriers']);
Route::get('/client-change-password/{id}', [AdminClients::class, 'ClientPassword']);

Route::get('/rate-list-permissions/{id}', [AdminClients::class, 'RateListPermissions']);
Route::get('/admin-rate-manage', [AdminClients::class, 'RateManage']);
Route::get('/rate-list-edit/{id}', [AdminClients::class, 'rateListEdit']);
Route::post('/rate-list-update', [AdminClients::class, 'rateListUpdate']);

Route::get('/add-user-list/{id}', [AdminClients::class, 'AdminUserList']);
Route::post('/add-rate-list', [AdminClients::class, 'AddUserList']);

Route::get('/client-courier-permissions', [AdminClients::class, 'ClientCourierPermissions']);
// Client

// Coureir Manage
Route::get('/courier', [AdminClients::class, 'Couriers']);
Route::get('/courier-new', [AdminClients::class, 'CouriersAdd']);
Route::get('/courier-edit/{id}', [AdminClients::class, 'CouriersEdit']);
Route::post('/courier-edit', [AdminClients::class, 'CouriersEditupt']);
Route::post('/courier-new', [AdminClients::class, 'CouriersAddupt']);
Route::get('/courier-priceing/{id}', [AdminClients::class, 'CourierPrice']);
Route::post('/courier-priceing', [AdminClients::class, 'CourierPriceupt']);
// Coureir Manage

// Excel
Route::get('/All_Orders_Excel', [AdminExcels::class, 'AllOrders']);
Route::get('/All_New_Order_Excel', [AdminExcels::class, 'AllNewOrders']);
Route::get('/All_Pending_Order_Excel', [AdminExcels::class, 'AllPendingOrder']);
Route::get('/All_Complete_Order_Excel', [AdminExcels::class, 'AllCompleteOrder']);
Route::get('/All_Cancel_Order_Excel', [AdminExcels::class, 'AllCancelOrder']);
Route::get('/All_MIS_Report_Excel', [AdminExcels::class, 'MISReport']);
// Excel
Route::get('/remittance-new', [AdminMIS::class, 'remittance_9']);
// MIS
Route::get('/AMIS_Report', [AdminMIS::class, 'Home']);
Route::post('/AMIS_ReportAdd', [AdminMIS::class, 'Add']);
Route::get('/ADaily_Report', [AdminDailyReport::class, 'Home']);
Route::get('/ADailyReport_Export', [AdminDailyReport::class, 'DailyReport']);

Route::get('/AMISReport_Export/{id}/{no}', [AdminMIS::class, 'Manifest_Report']);
// Route::get('/AMISReport_Export1',[AdminMIS::class,'Manifest_Report1']);
// Route::get('/AMISReport_Export2',[AdminMIS::class,'Manifest_Report2']);
// Route::get('/AMISReport_Export3',[AdminMIS::class,'Manifest_Report3']);
// Route::get('/AMISReport_Export4',[AdminMIS::class,'Manifest_Report4']);



Route::get('/AReturn_POD_Report', [AdminPODReport::class, 'PODReturn']);
Route::post('/AReturn_POD_ReportAdd', [AdminPODReport::class, 'Add']);
Route::get('/AReturn_POD_Report_Export', [AdminPODReport::class, 'PODReturnReport']);

Route::get('/AMISReport_ExportN/{id}/{no}', [AdminPODReport::class, 'Manifest_ReportN']);
// Route::get('/AMISReport_ExportN1',[AdminPODReport::class,'Manifest_ReportN1']);
// Route::get('/AMISReport_ExportN2',[AdminPODReport::class,'Manifest_ReportN2']);
// Route::get('/AMISReport_ExportN3',[AdminPODReport::class,'Manifest_ReportN3']);
// Route::get('/AMISReport_ExportN4',[AdminPODReport::class,'Manifest_ReportN4']);

Route::get('/page-error-503', [APIBigShip::class, 'page_error']);


Route::get('/AComplete_POD_Report', [AdminPODReport::class, 'PODComplete']);
Route::get('/AComplete_POD_Report_Export', [AdminPODReport::class, 'PODCompleteReport']);


Route::get('/AMISReport_ExportD', [AdminPODReport::class, 'Manifest_Report']);
Route::get('/AMISReport_ExportD1', [AdminPODReport::class, 'Manifest_Report1']);
Route::get('/AMISReport_ExportD2', [AdminPODReport::class, 'Manifest_Report2']);
Route::get('/AMISReport_ExportD3', [AdminPODReport::class, 'Manifest_Report3']);
Route::get('/AMISReport_ExportD4', [AdminPODReport::class, 'Manifest_Report4']);
// MIS

// Search Order
Route::get('/Search_Order', [SearchOrder::class, 'Home']);
// Search Order

// Pincode
Route::get('/PincodeCheck', [PincodeManage::class, 'Home']);
Route::post('/PincodeCheck', [PincodeManage::class, 'Check']);
// Pincode

// Manifest
Route::get('/All_Manifest', [AdminManifest::class, 'AllManifest']);
Route::get('/New_Manifest', [AdminManifest::class, 'NewManifest']);
Route::post('/New_Manifest', [AdminManifest::class, 'NewManifestAdd']);
Route::get('/Manifest_Edit/{id}', [AdminManifest::class, 'ManifestEdit']);
Route::post('/Manifest_Edit_Update', [AdminManifest::class, 'ManifestUpdate']);
// Manifest


// 	Admin-Panel		Admin-Panel		Admin-Panel	End


















// 	User-Panel		User-Panel		User-Panel	Start

Route::get('/UserPanel', [UserDashboard::class, 'Home']);
Route::get('/user-Home', [UserDashboard::class, 'UserHome']);
Route::get('/user-dashboard', [UserDashboard::class, 'NewDashboard']);

Route::get('/user-today-bookingdash', [UserDashboard::class, 'TodayBookingDash']);
Route::get('/user-today-OrdersDash', [UserDashboard::class, 'TodayOrdersDash']);
Route::get('/user-current-MonthOrdersDash', [UserDashboard::class, 'CurrentOrdersDash']);
Route::get('/user-last-MonthOrdersDash', [UserDashboard::class, 'LastOrdersDash']);

Route::get('/showordercounts', [UserDashboard::class, 'showOrderCounts']);

Route::get('/user-data-filter', [UserDashboard::class, 'adminDataFilter']);
Route::get('/user-courierwise-performance', [UserDashboard::class, 'courierWisePerformance']);
Route::get('/user-zonewise-performance', [UserDashboard::class, 'zoneWisePerformance']);




Route::get('/UserTodayOrders', [UserDashboard::class, 'TodayOrders']);
Route::get('/UserYesterdayOrders', [UserDashboard::class, 'YesterdayOrders']);
Route::get('/UserCurrentMonthOrders', [UserDashboard::class, 'CurrentOrders']);
Route::get('/UserLastMonthOrders', [UserDashboard::class, 'LastOrders']);
Route::get('/User7DaysOrders', [UserDashboard::class, 'Day7Orders']);
Route::get('/User30DaysOrders', [UserDashboard::class, 'Day30Orders']);
Route::get('/User90DaysOrders', [UserDashboard::class, 'Day90Orders']);

Route::get('/UserTodayOrdersGraph', [UserDashboard::class, 'TodayOrdersGraph']);
Route::get('/UserYesterdayOrdersGraph', [UserDashboard::class, 'YesterdayOrdersGraph']);
Route::get('/UserCurrentMonthOrdersGraph', [UserDashboard::class, 'CurrentOrdersGraph']);
Route::get('/UserLastMonthOrdersGraph', [UserDashboard::class, 'LastOrdersGraph']);
Route::get('/User7DaysOrdersGraph', [UserDashboard::class, 'Day7OrdersGraph']);
Route::get('/User30DaysOrdersGraph', [UserDashboard::class, 'Day30OrdersGraph']);
Route::get('/User90DaysOrdersGraph', [UserDashboard::class, 'Day90OrdersGraph']);

Route::get('/UPSingle_Product', [UserPlaceOrder::class, 'SingleOrder']);
Route::post('/UPSingle_Product', [UserPlaceOrder::class, 'SingleOrderFilter']);
Route::get('/UPSingle_Productbook', [UserPlaceOrder::class, 'SingleOrderBook']);
Route::post('/UPSingle_Product_Add', [UserPlaceOrder::class, 'SingleOrderAdd']);
Route::post('/UPSingle_Product_Add_ShipOrder', [UserPlaceOrder::class, 'SingleOrderUpdate']);
Route::get('/SingleOrderDeletesmannual/{id}', [UserPlaceOrder::class, 'SingleOrderDelete1']);
Route::get('/hub-details', [UserPlaceOrder::class, 'Hubdetails']);


// Route::get('/UPBulk_Order1',[UserPlaceOrder::class,'BulkOrder1']);
// Route::post('/UPBulk_Order_Add1',[UserPlaceOrder::class,'BulkOrderAdd1']);

Route::get('/UPReverse_Order', [UserPlaceOrder::class, 'SingleReverse']);
Route::get('/UPBulk_Reverse_Order', [UserPlaceOrder::class, 'BulkReverse']);

// Route::get('/UPProduct_Receipt/{id}',[UserPlaceOrder::class,'ReceiptOrder']);
// Route::get('/UPProduct_Receipt_Bulk',[UserPlaceOrder::class,'ReceiptOrderBulk']);

Route::get('/get-state-city', [LoginCheck::class, 'getStateCity'])->name('getStateCity');

Route::get('/setting', [LoginCheck::class, 'setting']);
Route::post('/setting', [LoginCheck::class, 'settingupt']);
Route::get('/financial-details', [LoginCheck::class, 'financialDetails']);
Route::post('/financial-details', [LoginCheck::class, 'financialDetailsadd']);
Route::get('/billing-information', [LoginCheck::class, 'billingInformation']);
Route::post('/billing-information', [LoginCheck::class, 'billingInformationadd']);
Route::get('/kyc-details', [LoginCheck::class, 'kycdetails']);
Route::get('/courier-permissions', [LoginCheck::class, 'CourierPermissions']);
Route::get('/change-password', [LoginCheck::class, 'changePassword']);
Route::post('/change-password', [LoginCheck::class, 'changePasswordupt']);

Route::get('/courier-permissions-update', [LoginCheck::class, 'CourierPermissionsUpdate']);
Route::get('/courier-priority-update', [LoginCheck::class, 'CourierPriorityUpdate']);

// New
Route::get('/UPBulk_Order', [UserPlaceOrder::class, 'BulkOrder1']);
Route::post('/UPBulk_Order', [UserPlaceOrder::class, 'BulkOrder1Filter']);
Route::get('/UPBulk_OrderAjax', [UserPlaceOrder::class, 'BulkOrderAjax1']);
Route::post('/UPBulk_Order_Add', [UserPlaceOrder::class, 'BulkOrderAdd1']);
Route::get('/BulkOrderUpload', [UserPlaceOrder::class, 'BulkOrderUpload']);



Route::post('/UPBulk_Order_Internatonal', [UserPlaceOrder::class, 'BulkOrderInternational']);

Route::get('/BulkOrderDelete', [UserPlaceOrder::class, 'BulkOrderDelete1']);
Route::get('/BulkOrderDeletesmannual/{id}', [UserPlaceOrder::class, 'BulkOrderDelete1']);
Route::post('/filter-selected-order', [UserPlaceOrder::class, 'MultipleOrderDelete']);



Route::get('/UPProduct_Receipt/{id}', [UserPlaceOrder::class, 'ReceiptOrder1']);
Route::get('/UPProduct_Receipt_Bulk', [UserPlaceOrder::class, 'ReceiptOrderBulk1']);

Route::get('/order-receipt/{id}', [UserPlaceOrder::class, 'ReceiptOrderNew']);

Route::get('/Order_Live_Status', [UserPlaceOrder::class, 'OrderLiveStatus']);
// New



// Labels
Route::get('/Label_Print', [LabelsPrintOut::class, 'LabelPrint']);
Route::post('/Labels_Print', [LabelsPrintOut::class, 'LabelsPrint']);
Route::get('/today-labels', [LabelsPrintOut::class, 'todayLabels']);
Route::get('/today-thermal-labels', [LabelsPrintOut::class, 'todayThermalLabels']);
Route::post('/shipping-label-setting', [LabelsPrintOut::class, 'shipping_label_setting']);
Route::post('/shipping-label-select', [LabelsPrintOut::class, 'shipping_label_select']);
// Labels



// 	Order Manage
Route::post('/failed-orders-new', [UserOrderManage::class, 'Orders_new_date']);
// 	Route::get('UPAll_All_Orders', 'UserOrderManage@AllAllOrders')->name('UPAll_All_Orders');
Route::get('/UPAll_All_Orders', [UserOrderManage::class, 'AllAllOrders']);
Route::post('/UPAll_All_Orders', [UserOrderManage::class, 'AllAllOrdersFilter']);
Route::get('/UPAll_Orders', [UserOrderManage::class, 'AllOrders']);
Route::post('/UPAll_Orders', [UserOrderManage::class, 'AllOrdersfilter']);
Route::get('/UPAll_Complete_Orders', [UserOrderManage::class, 'CompleteOrders']);
Route::post('/UPAll_Complete_Orders', [UserOrderManage::class, 'CompleteOrdersFilter']);
Route::get('/UPAll_Pending_Orders', [UserOrderManage::class, 'PeindigOrders']);
Route::post('/UPAll_Pending_Orders', [UserOrderManage::class, 'PeindigOrdersFilter']);
Route::get('/UPAll_Cancel_Orders', [UserOrderManage::class, 'CancelOrders']);
Route::post('/UPAll_Cancel_Orders', [UserOrderManage::class, 'CancelOrdersFilter']);
Route::get('/UPAll_Uploaded_Orders', [UserOrderManage::class, 'UploadedOrders']);
Route::post('/UPAll_Uploaded_Orders', [UserOrderManage::class, 'UploadedOrdersFilter']);
Route::get('/UPAll_Canceled_Orders', [UserOrderManage::class, 'CanceledOrders']);
Route::post('/UPAll_Canceled_Orders', [UserOrderManage::class, 'CanceledOrdersFilter']);
Route::get('/failed-orders', [UserOrderManage::class, 'FaildedOrders']);
Route::post('/failed-orders', [UserOrderManage::class, 'FaildedOrdersFilter']);

// new seprater 
Route::get('/booked-order', [UserOrderManage::class, 'Booked']);
Route::get('/pickup-pending', [UserOrderManage::class, 'Pickup_pending']);
Route::get('/intransit', [UserOrderManage::class, 'Intransit']);
Route::get('/ofd', [UserOrderManage::class, 'Ofd']);
Route::get('/deliverd', [UserOrderManage::class, 'Deliverd']);
Route::post('/ofd', [UserOrderManage::class, 'Ofd']);
Route::get('/rto', [UserOrderManage::class, 'Rto']);
Route::get('/cancelled', [UserOrderManage::class, 'Canceled']);
Route::get('/failled', [UserOrderManage::class, 'Failled']);

// Route::post('/filter-selected-order',[UserOrderManage::class,'CheckActionSelectedOrders']);

Route::get('/UPAll_Delete_Orders/{id}', [UserOrderManage::class, 'DeleteOrders']);
Route::get('/UPAll_Cancel_Orders_Now/{id}', [UserOrderManage::class, 'CancelOrdersNow']);
Route::post('/UPAll_Cancel_Orders_Now_API', [UserOrderManage::class, 'CancelOrdersNowAPI']);
// 	Order Manage

// Search Order
Route::get('/UPSearch_Order', [UserSearchOrder::class, 'Home']);
// Search Order

// Pincode
Route::get('/UPPincodeCheck', [UserPincodeManage::class, 'Home']);
Route::post('/UPPincodeCheck', [UserPincodeManage::class, 'Check']);
// Pincode

// UserHubs
Route::get('/UPAll_Hubs', [UserHubs::class, 'AllHub']);
Route::get('/UPNew_Hub', [UserHubs::class, 'NewHub']);
Route::post('/UPNew_Hub', [UserHubs::class, 'NewHubAdd']);
Route::get('/UPHub_Edit/{id}', [UserHubs::class, 'HubEdit']);
Route::post('/UPHub_Edit_Update', [UserHubs::class, 'HubUpdate']);
Route::get('/UPHub_Delete/{id}', [UserHubs::class, 'HubDelete']);
// UserHubs


// Reports
Route::get('/UPPOD_Report', [UserExcels::class, 'POD']);
Route::get('/UPDaily_Report', [UserExcels::class, 'Daliy']);
Route::get('/UPNDR_Report', [UserExcels::class, 'NDR']);
Route::get('/UPManifest_Report', [UserExcels::class, 'Manifest']);
Route::get('/UPMIS_Report', [UserExcels::class, 'MIS']);
// Route::get('/UPMIS_Report_ExcelN/{id}/{no}',[UserExcels::class,'MIS_ReportN']);
Route::get('/UPMIS_Report_ExcelN', [UserExcels::class, 'MIS_ReportN']);

Route::get('/sku_summary', [UserExcels::class, 'skuSummary']);
Route::get('/skunew', [UserExcels::class, 'skuNew']);

// Reports


// Invoice / COD Remittance / Wallet
Route::get('/Invoice', [UserHubs::class, 'AllInvoice']);
Route::get('/Remittance', [UserHubs::class, 'AllRemittance']);
Route::get('/Wallet', [UserHubs::class, 'WalletDetails']);
// phone pay 
Route::post('/make-order', [UserSearchOrder::class, 'paymentPhonepe']);
Route::post('/succes/{id}', [UserSearchOrder::class, 'paymentSucces']);

// Route::post('/payment',[UserSearchOrder::class,'add_payment']);
// Invoice / COD Remittance / Wallet	/-


// Excel Reports
// Route::get('/UPPOD_Report_Excel',[UserExcels::class,'POD_Report']);
Route::get('/UPDaily_Report_Excel', [UserExcels::class, 'Daliy_Report']);
// Route::get('/UPNDR_Report_Excel',[UserExcels::class,'NDR_Report']);
Route::get('/UPManifest_Report_PDF', [UserExcels::class, 'Manifest_Report_PDF']);
Route::get('/UPManifest_Report_ExcelD', [UserExcels::class, 'Manifest_ReportD']);
Route::get('/UPManifest_Report_ExcelN/{id}/{no}', [UserExcels::class, 'Manifest_ReportN']);
Route::get('/UPManifest_Report_Excel/{id}/{no}', [UserExcels::class, 'Manifest_Report']);

Route::get('/UPMIS_Report_PDF', [UserExcels::class, 'MIS_Report_PDF']);
Route::get('/UPMIS_Report_ExcelD', [UserExcels::class, 'MIS_ReportD']);

Route::get('/UPMIS_Report_Excel/{id}/{no}', [UserExcels::class, 'MIS_Report']);

Route::get('/today-failed-orders', [UserExcels::class, 'Failed_Orders_Report']);
Route::get('/today-placed-orders', [UserExcels::class, 'Placed_Orders_Report']);

Route::get('/today-pickup-orders', [UserExcels::class, 'Pickup_Orders_Report']);
Route::get('/today-intransit-orders', [UserExcels::class, 'intransit_Orders_Report']);
Route::get('/today-ofd-orders', [UserExcels::class, 'ofd_Orders_Report']);
Route::get('/today-rto-orders', [UserExcels::class, 'rto_Orders_Report']);
Route::get('/today-delivered-orders', [UserExcels::class, 'delivered_Orders_Report']);
Route::get('/today-cancel-orders', [UserExcels::class, 'cancel_Orders_Report']);


Route::get('/not-picked-excel-orders', [UserExcels::class, 'Not_Picked_Excel_Orders']);

// Excel Reports


// 	User-Panel			User-Panel			User-Panel		End



// 	Rider-Panel			Rider-Panel			Rider-Panel		Start

Route::get('/RiderPanel', [RiderDashboard::class, 'Home']);

Route::get('/RPAll_Order', [RiderPlaceOrder::class, 'AllOrders']);
Route::get('/RPAll_Order', [RiderPlaceOrder::class, 'AllOrders']);
Route::get('/RPPending_Order', [RiderPlaceOrder::class, 'AllPending']);
Route::post('/RPPending_Order_Change', [RiderPlaceOrder::class, 'Status_Change']);
Route::post('/RPPending_Order_Update', [RiderPlaceOrder::class, 'Status_Update']);
Route::get('/RPComplete_Order', [RiderPlaceOrder::class, 'AllComplete']);
Route::get('/RPCancel_Order', [RiderPlaceOrder::class, 'AllCancel']);

// Search Order
Route::get('/RPSearch_Order', [RiderSearchOrder::class, 'Home']);
// Search Order

// Pincode
Route::get('/RPPincodeCheck', [RiderPincodeManage::class, 'Home']);
Route::post('/RPPincodeCheck', [RiderPincodeManage::class, 'Check']);
// Pincode

// 	Rider-Panel			Rider-Panel			Rider-Panel		End
// 	Customer-Panel		Customer-Panel		Customer-Panel	Start
Route::get('/CustomerPanel', [CustomerDashboard::class, 'Home']);
// 	Customer-Panel		Customer-Panel		Customer-Panel	End
