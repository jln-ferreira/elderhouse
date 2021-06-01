<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();






// ----------------------------------------------
// ADMIN WEB
// ----------------------------------------------
Route::get('/home/', function () {
    if (Auth::check()) {
        return view('admin');
    }
    return redirect('/login');
});


// ---------------
// USERS
Route::get('/users', 'UsersController@index');
Route::get('/users/{id}', 'UsersController@show');
Route::post('/users', 'UsersController@create');
Route::patch('/users', 'UsersController@update');
Route::delete('/users/{id}', 'UsersController@destroy');


Route::get('/getUserAddressRole/{user_id}', 'UsersController@getUserAddressRole');
// END USERS
// ------------------


// ---------------
// CLIENTS
Route::get('/clients', 'ClientController@index');
Route::get('/clients/{clientId}', 'ClientController@show');
Route::get('/addressClient/{clientId}', 'AddressController@showClient');
Route::get('/familyClient/{clientId}', 'FamilyController@showClient');
Route::get('/diagnosticsClient/{clientId}', 'DiagnosticClientController@showClient');
Route::get('/bankAccountClient/{clientId}', 'BankaccountController@showClient');
Route::post('/clients', 'ClientController@create');
Route::post('/clientAddress', 'AddressController@createClient');
Route::post('/photoClient', 'ClientController@photoClient');
Route::patch('/clients', 'ClientController@update');
Route::delete('/clients/{id}', 'ClientController@destroy');
// END CLIENTS
// ------------------


// ---------------
// ADDRESS
Route::patch('/clientAddress', 'AddressController@createClient');
// END ADDRESS
// ------------------



// ---------------
// PROFILE
Route::get('/profile/user', 'ProfileController@profileUser');
route::post('/profile/user', 'ProfileController@updateInformation');
// END PROFILE
// ------------------


// ---------------
// FAMILY
route::post('/family', 'FamilyController@store');
Route::patch('/family', 'FamilyController@updateClient');
Route::post('/deleteFamily', 'FamilyController@deleteClient');
// END FAMILY
// ------------------


// ---------------
// ROLES
Route::get('/roles', 'RoleController@index');
Route::delete('/roles/{role_id}', 'RoleController@destroy');
// END ROLES
// ------------------


// ---------------
// MENUS
Route::get('/menus', 'MenuController@index');
// END MENUS
// ------------------


// ---------------
// MENU ROLES
Route::post('/menuroles', 'MenuRoleController@store');
Route::patch('/menuroles', 'MenuRoleController@update');
// END MENU ROLES
// ------------------


// ---------------
// DIAGNOSTIC
Route::get('/diagnostics', 'DiagnosticController@index');
route::post('/diagnostics', 'DiagnosticController@store');
Route::patch('/diagnostics', 'DiagnosticController@update');
Route::delete('/diagnostics/{diagnosticId}', 'DiagnosticController@destroy');
// END DIAGNOSTIC
// ------------------


// ---------------
// DIAGNOSTIC CLIENT
route::post('/diagnosticsClient', 'DiagnosticClientController@store');
Route::patch('/diagnosticsClient', 'DiagnosticClientController@updateClient');
Route::delete('/diagnosticsClient/{id}', 'DiagnosticClientController@deleteClient');
// END DIAGNOSTIC CLIENT
// ------------------


// ---------------
// BANK ACCOUNT
Route::patch('/clientCreditCard', 'BankaccountController@createClient');
// END BANK ACCOUNT
// ------------------


// ---------------
//CONTRACT
Route::get('/fullContract/{clientId}', 'ContractController@fullShow');
Route::post('/contractSave', 'ContractController@storeContract');
Route::post('/contracts', 'ContractController@create');
Route::delete('/contracts/{contractId}', 'ContractController@destroy');
// END CONTRACT
// ---------------


// ---------------
// SETTINGS
Route::get('/menuRoleSettings', 'SettingsController@menuRole');
// END SETTINGS
// ------------------


// ---------------
// MEASUREMENT
Route::get('/measurements', 'MeasurementController@index');
route::post('/measurements', 'MeasurementController@store');
Route::patch('/measurements', 'MeasurementController@update');
Route::delete('/measurements/{id}', 'MeasurementController@destroy');
// END MEASUREMENT
// ------------------


// ---------------
// PRODUCTS
Route::get('/products', 'ProductController@index');
route::post('/products', 'ProductController@store');
Route::patch('/products', 'ProductController@update');
Route::delete('/products/{productsId}', 'ProductController@destroy');
// END PRODUCTS
// ------------------


// ---------------
// CATEGORIES
Route::get('/categories', 'CategoryController@index');
// END CATEGORIES
// ------------------


// ---------------
// INVENTORIES
Route::get('/inventories', 'InventoryController@index');
Route::patch('/inventories/{productsId}', 'InventoryController@store');
// END INVENTORIES
// ------------------


// ---------------
// PRECIFICATIONS
Route::get('/precifications', 'PrecificationController@index');
route::post('/precifications', 'PrecificationController@store');
Route::patch('/precifications', 'PrecificationController@update');
Route::delete('/precifications/{id}', 'PrecificationController@destroy');
// END PRECIFICATIONS
// ------------------


// ---------------
// PAYMENTS
Route::get('/payments', 'PaymentController@index');
route::post('/payments', 'PaymentController@store');
Route::patch('/payments', 'PaymentController@update');
Route::delete('/payments/{id}', 'PaymentController@destroy');
// END PAYMENTS
// ------------------


// ---------------
// INVOICES
Route::get('/invoices', 'InvoiceController@index');
Route::post('/invoices', 'InvoiceController@store');
Route::get('/invoice/{id}', 'InvoiceController@show');
Route::delete('/invoices/{id}', 'InvoiceController@destroy');
Route::get('/paymentDates/{clientId}', 'InvoiceController@getPaymentDates');
Route::post('/createInvoice', 'InvoiceController@createInvoice');
// END INVOICES
// ------------------


// ---------------
// CLIENT PRODUCT
Route::get('/clientProducts', 'ClientProductController@index');
Route::post('/clientProducts', 'ClientProductController@store');
Route::patch('/clientProducts', 'ClientProductController@update');
Route::delete('/clientProducts/{id}', 'ClientProductController@destroy');
Route::post('/clientProductsBulkDelete', 'ClientProductController@destroyBulk');
Route::get('/productMedic', 'ClientProductController@getProducts');
// END  CLIENT PRODUCT
// ------------------


// ---------------
// CLIENT MEDICATES
Route::post('/medicates', 'MedicateController@store');
Route::get('/scheduleMedicates', 'MedicateController@index');
// END  MEDICATES
// ------------------



// https://medium.com/@crydetaan/laravel-6-vuejs-adminlte-3-1e264db76809
// https://adminlte.io/themes/AdminLTE/documentation/index.html#download
