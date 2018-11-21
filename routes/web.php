<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PagesController@landing');

Auth::routes();

Route::prefix('admin')->group(function(){
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login');
    Route::get('/', 'AdminDashboardController@index');

});

Route::resource('members', 'AdminMembersController');
Route::resource('carpools', 'AdminCarpoolController');

Route::get('/dashboard', 'DashboardController@index');
Route::post('/dashboard', 'RoutesController@searchMatches');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
Route::post('/displayroute', 'RoutesController@matching');




//Route::resource('profile', 'ProfileController');
Route::get('/profile', 'ProfileController@index')->middleware('auth');
Route::get('/profile/edit', 'ProfileController@edit')->middleware('auth');
Route::put('/profile/edit', 'ProfileController@update')->middleware('auth');

Route::get('/vehicle', 'VehicleController@index')->middleware('auth');
Route::POST('/vehicle/add', 'VehicleController@add')->middleware('auth');
Route::get('/vehicle/edit', 'VehicleController@edit')->middleware('auth');
Route::post('/vehicle/edit', 'VehicleController@editVehicle')->middleware('auth');

Route::get('user/{id}', 'PagesController@dashboard');

Route::resource('Routes','RoutesController');
