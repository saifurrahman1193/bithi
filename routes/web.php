<?php




Route::get('/', function () {
    return view('/auth/login');
})->name('login');


Auth::routes();


//////////////////////////////////////////////////////////////////////////////////
// inventory ================================================================== //
//////////////////////////////////////////////////////////////////////////////////
Route::group( ['prefix' => 'inventory', 'middleware' => 'auth'], function ()
{

		// inventory ===============

		Route::get('/addItems', 'InventoryController@inventory')->name('inventory');
		Route::post('/inventory/inventoryInsert', 'InventoryController@inventoryInsert')->name('inventory.insert');
		Route::get('/inventoryEdit/{inventoryId}', 'InventoryController@inventoryEdit')->name('inventory.edit');
		Route::post('/update/{inventoryId}', 'InventoryController@inventoryUpdate')->name('inventory.update');
		Route::delete('/inventory/{inventoryId}', 'InventoryController@inventoryDelete')->name('inventory.delete');

		// product return=====
		Route::put('/inventoryProductReturn', 'InventoryController@inventoryProductReturn')->name('inventory.product.return');
		Route::get('/inventoryProductReturnList', 'InventoryController@inventoryProductReturnList')->name('inventory.return.product.list');


		// inventory settings
		Route::get('/category', 'InventoryController@category')->name('category');
		Route::get('/inventorySettings', 'InventoryController@inventorySettings')->name('inventory.settings');
		Route::post('/category/', 'InventoryController@categoryInsert')->name('category.insert');

		Route::put('/invsetting/category/categoryUpdate', 'InventoryController@invSettingsCatUpdate')->name('inventory.settings.category.update');

		Route::delete('/category/{categoryId}', 'InventoryController@categoryDelete')->name('category.delete');


		// inventory -> Items
		Route::get('/items', 'InventoryController@items')->name('items');
		Route::post('/items/itemsInsert', 'InventoryController@itemsInsert')->name('items.insert');
		Route::get('/items/{itemId}', 'InventoryController@itemShow')->name('items.show');
		Route::post('/items/{itemId}', 'InventoryController@itemsUpdate')->name('items.update');
		Route::delete('/items/{itemId}', 'InventoryController@itemDelete')->name('items.delete');


		Route::post('/additems/item/insert', 'InventoryController@inventoryItemsInsert')->name('inventory.items.insert');
		Route::post('/additems/supplier/insert', 'InventoryController@inventorySupplierInsert')->name('inventorySupplierInsert');


		// supplier=====================
		Route::get('/suppliers/supplierslist', 'HRMController@supplier')->name('supplier');
		Route::post('/supplier/', 'HRMController@supplierInsert')->name('supplier.insert');
		Route::get('/supplier/{supplierId}', 'HRMController@supplierShow')->name('supplier.show');
		Route::post('/supplier/{supplierId}', 'HRMController@supplierUpdate')->name('supplier.update');
		Route::delete('/supplier/{supplierId}', 'HRMController@supplierDelete')->name('supplier.delete');




});





////////////////////////////////////////////////////////////////////////////////////
// BIlling ====================================================================== //
////////////////////////////////////////////////////////////////////////////////////

Route::group(['prefix' => 'billing', 'middleware' => 'auth'], function ()
{

		// bill creating===============
		Route::get('/bills/billCreate', 'BillingController@bills')->name('bills');
		Route::post('/bills/billInsert', 'BillingController@billInsert')->name('bills.insert');
		Route::post('/bills/billInsertPDF', 'BillingController@billInsertWithPDF')->name('bills.insert.pdf');
		Route::post('/billsCustomerInsert', 'BillingController@billsCustomerInsert')->name('bills.customer.insert');

		Route::get('/bills/billCreate/suppliers/get/{itemId}', 'BillingController@billCreateGetSuppliersAgainstItem');


		// billist======================
		Route::get('/bills/billList', 'BillingController@billList')->name('billList');
		Route::get('/bills/billListReport', 'BillingController@billListReport')->name('billListReport');

		Route::get('/bills/billEdit/{billId}', 'BillingController@billEdit')->name('bills.edit');
		Route::post('/bills/billUpdate/{billId}', 'BillingController@billUpdate')->name('bills.update');
		Route::post('/bills/billUpdatePDF/{billId}', 'BillingController@billUpdateAndPrint')->name('bills.update.pdf');

		Route::group([ 'middleware' => 'SuperAdminMiddleware'], function ()
		{
			Route::delete('/bills/billDelete/{billId}', 'BillingController@billDelete')->name('bills.delete');
		});


		// delivery status update
		Route::post('/bills/billList/billListDeliveryStatusUpdate/{billId}', 'BillingController@billListDeliveryStatusUpdate')->name('billList.deliveryStatus.update');
		// payment status update
		Route::post('/bills/billList/billListPaymentStatusUpdate/{billId}', 'BillingController@billListPaymentStatusUpdate')->name('billList.paymentStatus.update');

		// bill report === pdf generation========
		Route::get('/bills/report/{billId}', 'BillingController@billReport')->name('billReport');



		// customer=============
		Route::get('/customer/customerIndex', 'BillingController@customers')->name('customers');
		Route::post('/customer', 'BillingController@customerInsert')->name('customer.insert');
		Route::get('/customerShow/{customerId}', 'BillingController@customerShow')->name('customer.show');
		Route::post('/customerUpdate/{customerId}', 'BillingController@customerUpdate')->name('customer.update');
		Route::delete('/customer/{customerId}', 'BillingController@customerDelete')->name('customer.delete');



		Route::get('/productSoldToWhomCustomerList', 'BillingController@productSoldToWhomCustomerList')->name('productSoldToWhomCustomerList');
		
	});
	
	Route::get('/productSoldToWhomCustomerListData/{itemId}', 'BillingController@productSoldToWhomCustomerListData')->name('productSoldToWhomCustomerListData');



////////////////////////////////////////////////////////////////////////////////////
// Expense ====================================================================== //
////////////////////////////////////////////////////////////////////////////////////

Route::group(['prefix' => 'expense', 'middleware' => 'auth'], function ()
{
		// expenses=============
		Route::get('/expenses/expenseIndex', 'ExpenseController@expenseIndex')->name('expense.expenses.index');
		Route::post('/expenses/expenseInsert', 'ExpenseController@expenseInsert')->name('expense.expenses.insert');
		Route::put('/expenses/expenseUpdate', 'ExpenseController@expenseUpdate')->name('expense.expenses.update');
		Route::delete('/expenses/expense/{expenseId}', 'ExpenseController@expenseDelete')->name('expense.expenses.delete');

});




////////////////////////////////////////////////////////////////////////////////////
// CRM ====================================================================== //
////////////////////////////////////////////////////////////////////////////////////

Route::group(['prefix' => 'crm', 'middleware' => 'auth'], function ()
{
		// CRM=============
		Route::get('/valuableCustomers', 'CRMController@valuableCustomers')->name('crm.valuableCustomers');

});

////////////////////////////////////////////////////////////////////////////////////
// Reports ====================================================================== //
////////////////////////////////////////////////////////////////////////////////////

Route::group(['prefix' => 'reports', 'middleware' => 'auth'], function ()
{
	Route::get('/stockReport', 'InventoryController@stockReport')->name('report.stockReport');

	Route::get('stockReportFullExcelReportDownload', 'ReportController@stockReportFullExcelReportDownload')->name('report.stockReport.stockReportFullExcelReportDownload');
	

	Route::get('/receivableDue', 'ReportController@receivableDue')->name('report.receivableDue');
	Route::get('receivableDueExcelReportDownload', 'ReportController@receivableDueExcelReportDownload')->name('report.receivableDue.receivableDueExcelReportDownload');

	Route::get('/payableDue', 'ReportController@payableDue')->name('report.payableDue');
	Route::get('payableDueExcelReportDownload', 'ReportController@payableDueExcelReportDownload')->name('report.payableDue.payableDueExcelReportDownload');

	Route::get('profitAnalysis', 'ReportController@profitAnalysis')->name('report.profitAnalysis');
	Route::get('profitAnalysisExcelReportDownload', 'ReportController@profitAnalysisExcelReportDownload')->name('report.profitAnalysis.profitAnalysisExcelReportDownload');

	// expense report
	Route::get('expensesExcelReportDownload', 'ReportController@expensesExcelReportDownload')->name('report.expenses.expensesExcelReportDownload');

});


///////////////////////////////////////////////////////////////////
// Company=======================================================//
///////////////////////////////////////////////////////////////////

Route::group(['prefix'=> 'company', 'middleware' => 'auth'], function ()
{
		
		Route::get('/companyIndex', 'CompanyController@company')->name('company');
		Route::post('/companyUpdate/{companyId}', 'CompanyController@companyUpdate')->name('company.update');

});





////////////////////////////////////////////////////////////////////
// super admin panel============================================= //
////////////////////////////////////////////////////////////////////

Route::group([ 'middleware' => 'SuperAdminMiddleware'], function ()
{
		// User management
		Route::Resource('/user', 'UserController');

		// role=========
		Route::Resource('/role', 'RoleController');
		Route::post('/role/{roleId}', 'RoleController@update')->name('role.updating');

		Route::get('users/userRoles', 'UserController@userRoles')->name('user.userRoles');

		Route::get('/admindashdisplay', 'HomeController@admindashdisplay')->name('admindashdisplay');

});


/////////////////////////////////////////////////////////////////////
// user=========================================================== //
/////////////////////////////////////////////////////////////////////
Route::group([ 'middleware' => 'auth'], function ()
{
		Route::get('/dashboard', 'HomeController@index')->name('dashboard');
		Route::get('/home', 'HomeController@index')->name('home');
});

Route::get('/lowStockReport', 'HomeController@lowStockReport')->name('lowStockReport');





