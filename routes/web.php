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


//CONTRACT
Route::get('/fullContract/{clientId}', 'ContractController@fullShow');
Route::post('/contractSave', 'ContractController@storeContract');
Route::post('/contracts', 'ContractController@store');
// END CONTRACT

// ---------------
// SETTINGS
Route::get('/menuRoleSettings', 'SettingsController@menuRole');
// END SETTINGS
// ------------------




// https://medium.com/@crydetaan/laravel-6-vuejs-adminlte-3-1e264db76809
// https://adminlte.io/themes/AdminLTE/documentation/index.html#download
