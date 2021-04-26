<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Delivery;
use App\DeliveryOrder;
use App\Driver;
use App\Pool;
use App\VehicleOwner;
use App\Ref;
use DB;
use Carbon\Carbon;

class AjaxController extends Controller
{
    public function getDriversFromOwner($owner_id)
    {
      $drivers = Driver::where('owner_id',$owner_id)->get();
      return view('includes.drivers')->with('drivers', $drivers);
    }
    public function getDriversJson($owner_id)
    {
      $drivers = Driver::where('owner_id',$owner_id)->get();
      echo json_encode($drivers);

    }
    public function getDriverDetails($driver_id)
    {
      $driver = Driver::find($driver_id);

      echo json_encode($driver);
    }
    public function GetReference($header)
    {
      $query = $_GET['query'];
      if ($query) {
        $refs = Ref::where('head',$header)
                    ->where('body', 'like', '%'.$query.'%')
                    ->take(10)
                    ->select('body')
                    ->get();

        foreach($refs as $ref)
        {
          $return_array[] =  ["value"=>$ref->body,"data"=>$ref->body];
        }

        if (isset($return_array)) {
          echo json_encode(array("suggestions"=>$return_array));
        }
      }
    }
    public function getDelivery($id)
    {
      $delivery = Delivery::where('deliveries.id',$id)
                  ->leftJoin('users as u','deliveries.admin','=','u.id')
                  ->leftJoin('pools as p', 'p.id','=','deliveries.pool_id')
                  ->select('deliveries.*','u.name as admin', 'p.name as pool')
                  ->first();
      $delivery->date = Carbon::parse($delivery->date)->format('d-m-Y');
      echo json_encode($delivery);
    }
    public function newDOLine($id, $code, $index)
    {
        $transports = VehicleOwner::all();
        $dos = DeliveryOrder::where('delivery_id',$id)->get();
        $lastIndex = count(DeliveryOrder::where('delivery_id',$id)->get());
        $rowIndex = $index + $lastIndex;
        $rowIndex = str_pad((string)$rowIndex, 3, "0", STR_PAD_LEFT);
        return view('includes.doform')
              ->with('code', $code)
              ->with('delivery_orders', $dos)
              ->with('rowIndex', $rowIndex)
              ->with('index', $index)
              ->with('transports', $transports);
    }
    public function getDeliveryOrders($id)
    {
      $do = DeliveryOrder::where('delivery_id',$id)->get();

      echo json_encode($do);
    }
}
