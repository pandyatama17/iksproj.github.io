<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
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



Auth::routes();


Route::group(['middleware'=>['auth']], function()
{
  Route::get('/', 'OperationalController@index')->name('operator_index');
  Route::get('/master', 'OperationalController@index')->name('master_data');
  Route::get('/delivery/show&id={id}', 'OperationalController@showDeliveryOrders')->name('show_delivery');
  Route::get('/home', 'HomeController@index')->name('home');

  // form routes
  Route::get('/delivery/new', 'OperationalController@newDelivery' )->name('new_delivery');

  //ajax get routes
  Route::get('/ajaxCall/drivers&transport={owner_id}', 'AjaxController@getDriversFromOwner');
  Route::get('/ajaxCall/driverDetails&driverID={driver_id}', 'AjaxController@getDriverDetails');

  // post routes
  Route::post('/delivery/order/submit','OperationalController@storeDeliveryOrder')->name('submit_do');
  Route::post('/delivery/new/submit','OperationalController@storeDelivery')->name('submit_delivery');
});
