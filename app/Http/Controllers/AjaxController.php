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

class AjaxController extends Controller
{
    public function getDriversFromOwner($owner_id)
    {
      $drivers = Driver::where('owner_id',$owner_id)->get();
      return view('includes.drivers')->with('drivers', $drivers);
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
}
