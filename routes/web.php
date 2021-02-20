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
Route::post('/clients', 'ClientController@create');
Route::post('/clientAddress', 'AddressController@createClient');
// END CLIENTS
// ------------------


// ---------------
// PROFILE
Route::get('/settings/user', 'SettingsController@settingsUser');
route::post('/setting/user', 'SettingsController@updateInformation');
// END PROFILE
// ------------------


// ---------------
// FAMILY
route::post('/family', 'FamilyController@create');
Route::patch('/family', 'FamilyController@updateClient');
Route::delete('/family', 'FamilyController@deleteClient');
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


// https://medium.com/@crydetaan/laravel-6-vuejs-adminlte-3-1e264db76809
// https://adminlte.io/themes/AdminLTE/documentation/index.html#download
