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
  Route::get('/home', 'OperationalController@index')->name('home');
  Route::get('/', 'OperationalController@index')->name('index');
  Route::get('/deliveries/master', 'OperationalController@index')->name('master_data');
  Route::get('/pool&id={pool_id}', 'OperationalController@showDeliveriesByPool')->name('deliveries_data');
  Route::get('/status&id={status}', 'OperationalController@showDeliveriesByStatus')->name('deliveries_wstat');
  Route::get('/delivery/show&id={id}', 'OperationalController@showDeliveryOrders')->name('show_delivery');
  Route::get('/delivery_orders/master', 'OperationalController@showDeliveryOrdersMaster')->name('do_master_data');
  Route::get('/delivery_orders/pool&id={pool_id}', 'OperationalController@showDeliveryOrderByPool')->name('do_data');
  Route::get('/management/transports', 'ManagementController@showTransports')->name('show_transports');
  Route::get('/management/users', 'ManagementController@showUsers')->name('show_users');
  Route::get('/management/pools', 'ManagementController@showPools')->name('show_pools');
  Route::get('/management/journaling', 'ManagementController@showJournal')->name('show_journal');

  // form routes
  Route::get('/delivery/new', 'OperationalController@newDelivery' )->name('new_delivery');
  Route::get('/delivery_order/new', 'OperationalController@newDeliveryOrder' )->name('new_do');

  //ajax get routes
  Route::get('/ajaxCall/drivers&transport={owner_id}', 'AjaxController@getDriversFromOwner')->name('ajax_get_drivers');
  Route::get('/ajaxCall/driversJSON&transport={owner_id}', 'AjaxController@getDriversJson')->name('ajax_get_drivers_json');
  Route::get('/ajaxCall/driverDetails&driverID={driver_id}', 'AjaxController@getDriverDetails')->name('ajax_get_driver_details');
  Route::get('/ajaxCall/getReference&header={head}', 'AjaxController@getReference')->name('ajax_get_reference');
  Route::get('/ajaxCall/getDeliveryDetails&id={id}', 'AjaxController@getDelivery')->name('ajax_get_deliveries');
  Route::get('/ajaxCall/newDOLine&id={id}&code={code}&index={index}', 'AjaxController@newDOLine')->name('ajax_new_do');
  // Route::post('/ajaxCall/getDeliveriesJSON&type={type}&action={action}', 'AjaxController@getDeliveriesWithParams')->name('get_deliveries_json_wparams');
  Route::post('/ajaxCall/getDeliveriesJSON', 'AjaxController@getDeliveries')->name('get_deliveries_json');
  Route::get('/management/ajaxCall/drivers&transports={transport}', 'AjaxController@showDriversByTransport')->name('show_drivers_by');
  Route::post('/management/ajaxCall/getJournal', 'AjaxController@getJournal')->name('get_journal');


  // post routes
  Route::post('/delivery/order/submit','OperationalController@storeDeliveryOrder')->name('submit_do');
  Route::post('/delivery/order/form/submit','OperationalController@storeDeliveryOrder2')->name('submit_do2');
  Route::post('/delivery/new/submit','OperationalController@storeDelivery')->name('submit_delivery');
  Route::post('/management/driver/new/submit','ManagementController@storeDriver')->name('submit_driver');
  Route::post('/management/driver/update','ManagementController@updateDriver')->name('update_driver');

  // export routes
  Route::get('/delivery/export&id={id}', 'OperationalController@ExportDelivery')->name('export_delivery');
  Route::get('/delivery/finish&id={id}', 'OperationalController@finishDelivery')->name('finish_delivery');


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
