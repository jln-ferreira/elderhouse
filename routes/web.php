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
Route::post('/users', 'UsersController@create');
Route::delete('/users/{id}', 'UsersController@destroy');
Route::patch('/users', 'UsersController@update');


Route::get('/getUserAddressRole/{user_id}', 'UsersController@getUserAddressRole');
// END USERS
// ------------------


// ---------------
// CLIENTS
Route::get('/clients', 'ClientController@index');
Route::get('/clients/{clientId}', 'ClientController@show');
Route::get('/addressClient/{clientId}', 'AddressController@showClient');
Route::get('/familyClient/{clientId}', 'FamilyController@showClient');
Route::post('/clients', 'ClientController@create');
Route::post('/clientAddress', 'AddressController@createClient');
Route::post('/photoClient', 'ClientController@photoClient');
Route::patch('/clients', 'ClientController@update');
// END CLIENTS
// ------------------


// ---------------
// ADDRESS
Route::patch('/clientAddress', 'AddressController@createClient');
// END ADDRESS
// ------------------



// ---------------
// PROFILE
Route::get('/settings/user', 'SettingsController@settingsUser');
route::post('/setting/user', 'SettingsController@updateInformation');
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
// END ROLES
// ------------------


// ---------------
// DIAGNOSTIC
Route::get('/diagnostics', 'DiagnosticController@index');
// END DIAGNOSTIC
// ------------------


// ---------------
// DIAGNOSTIC CLIENT
route::post('/diagnosticsClient', 'DiagnosticClientController@store');
Route::patch('/diagnosticsClient', 'DiagnosticClientController@updateClient');
Route::delete('/diagnosticsClient/{id}', 'DiagnosticClientController@deleteClient');
// END DIAGNOSTIC CLIENT
// ------------------


// https://medium.com/@crydetaan/laravel-6-vuejs-adminlte-3-1e264db76809
// https://adminlte.io/themes/AdminLTE/documentation/index.html#download
