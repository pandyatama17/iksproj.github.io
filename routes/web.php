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
  Route::get('/management/transports', 'ManagementController@showTransports')->name('show_transports');
  Route::get('/management/users', 'ManagementController@showUsers')->name('show_users');

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
  Route::post('/tracking/ajaxCall/getDeliveriesJSON', 'AjaxController@getDeliveries')->name('get_deliveries_json');
  Route::get('/management/ajaxCall/drivers&transports={transport}', 'AjaxController@showDriversByTransport')->name('show_drivers_by');


  // post routes
  Route::post('/tracking/delivery/order/submit','OperationalController@storeDeliveryOrder')->name('submit_do');
  Route::post('/tracking/delivery/order/form/submit','OperationalController@storeDeliveryOrder2')->name('submit_do2');
  Route::post('/tracking/delivery/new/submit','OperationalController@storeDelivery')->name('submit_delivery');
  Route::post('/management/driver/new/submit','ManagementController@storeDriver')->name('submit_driver');

  // export routes
  Route::get('/tracking/delivery/export&id={id}', 'OperationalController@ExportDelivery')->name('export_delivery');
  Route::get('/tracking/delivery/finish&id={id}', 'OperationalController@finishDelivery')->name('finish_delivery');


  //tests
  Route::get('/test/delivery_export/{id}', function($id)
  {
    $data = \App\Delivery::where('deliveries.id',$id)
                      ->leftJoin('users as u','deliveries.admin','=','u.id')
                      ->leftJoin('pools as p', 'p.id','=','deliveries.pool_id')
                      ->select('deliveries.*','u.name as admin', 'p.name as pool')
                      ->first();
    $details = \DB::table('delivery_orders as do')
          ->where('do.delivery_id', $id)
          ->leftJoin('drivers as dr', 'do.driver_id' , '=' , 'dr.id')
          ->leftJoin('vehicle_owners as vh', 'dr.id','=','vh.id')
          ->select('do.id as do_id', 'do.*','dr.name as driver', 'vh.name as transport')
          ->get();
    $transports = \App\VehicleOwner::all();
      // dd($data);
      return view('exports.delivery')
              ->with('data', $data)
              ->with('transports', $transports)
              ->with('details', $details);
  });
});
