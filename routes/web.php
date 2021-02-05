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


Route::get('/address/{user_id}', 'UsersController@showUserAddress');
Route::get('/userRoles/{user_id}', 'UsersController@showUserRoles');

// END USERS
// ------------------

// ---------------
// ROLES

Route::get('/roles', 'RoleController@index');

// END ROLES
// ------------------


// https://medium.com/@crydetaan/laravel-6-vuejs-adminlte-3-1e264db76809
// https://adminlte.io/themes/AdminLTE/documentation/index.html#download
