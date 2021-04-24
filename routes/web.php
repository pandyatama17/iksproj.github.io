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
  Route::get('/tracking', 'OperationalController@index')->name('operator_index');
  Route::get('/', 'OperationalController@index')->name('index');
  Route::get('/tracking/deliveries/master', 'OperationalController@index')->name('master_data');
  Route::get('/tracking/pool&id={pool_id}', 'OperationalController@showDeliveriesByPool')->name('deliveries_data');
  Route::get('/tracking/delivery/show&id={id}', 'OperationalController@showDeliveryOrders')->name('show_delivery');
  Route::get('/tracking/delivery_orders/master', 'OperationalController@showDeliveryOrdersMaster')->name('do_master_data');
  Route::get('/tracking/delivery_orders/pool&id={pool_id}', 'OperationalController@showDeliveryOrderByPool')->name('do_data');

  // form routes
  Route::get('/tracking/delivery/new', 'OperationalController@newDelivery' )->name('new_delivery');
  Route::get('/tracking/delivery_order/new', 'OperationalController@newDeliveryOrder' )->name('new_do');

  //ajax get routes
  Route::get('/tracking/ajaxCall/drivers&transport={owner_id}', 'AjaxController@getDriversFromOwner');
  Route::get('/tracking/ajaxCall/driversJSON&transport={owner_id}', 'AjaxController@getDriversJson');
  Route::get('/tracking/ajaxCall/driverDetails&driverID={driver_id}', 'AjaxController@getDriverDetails');
  Route::get('/tracking/ajaxCall/getReference&header={head}', 'AjaxController@getReference');
  Route::get('/tracking/ajaxCall/getDeliveryDetails&id={id}', 'AjaxController@getDelivery');
  Route::get('/tracking/ajaxCall/newDOLine&id={id}&code={code}&index={index}', 'AjaxController@newDOLine');

  // post routes
  Route::post('/tracking/delivery/order/submit','OperationalController@storeDeliveryOrder')->name('submit_do');
  Route::post('/tracking/delivery/order/form/submit','OperationalController@storeDeliveryOrder2')->name('submit_do2');
  Route::post('/tracking/delivery/new/submit','OperationalController@storeDelivery')->name('submit_delivery');
});
