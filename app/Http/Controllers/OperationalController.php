<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Delivery;
use App\DeliveryOrder;
use App\Driver;
use App\Pool;
use App\VehicleOwner;
use DB;
use Carbon\Carbon;

class OperationalController extends Controller
{
    public function index()
    {
      $data = Delivery::all();
      return view('delivery.master')
              ->with('data', $data);
    }

    public function showDeliveryOrders($delivery_id)
    {
      $data = Delivery::where('deliveries.id',$delivery_id)
                        ->leftJoin('users as u','deliveries.admin','=','u.id')
                        ->select('deliveries.*','u.name as admin')
                        ->first();
      $details = DB::table('delivery_orders as do')
                  ->where('do.delivery_id', $delivery_id)
                  ->leftJoin('drivers as dr', 'do.driver_id' , '=' , 'dr.id')
                  ->leftJoin('vehicle_owners as vh', 'dr.id','=','vh.id')
                  ->select('do.id as do_id', 'do.*','dr.name as driver','dr.license_plate_no as plate', 'vh.name as transport')
                  ->get();
      $transports = VehicleOwner::all();
        // dd($data);
        return view('delivery.list')
                ->with('data', $data)
                ->with('transports', $transports)
                ->with('details', $details);
    }
    public function storeDeliveryOrder(Request $r)
    {
        $do = new DeliveryOrder;

        $do->delivery_id = $r->delivery_id;
        $do->do_number = $r->do_number;
        $do->driver_id = $r->driver;
        $do->date = Carbon::parse($r->date);
        $do->tonnage = $r->tonnage;
        $do->fare = $r->fare;
        $do->status = 2;

        try {
          $do->save();
          session()->flash('message-type', 'success');
          session()->flash('message-title', 'Berhasil');
          session()->flash('message', 'Surat Jalan berhasil ditambahkan');
        } catch (\Exception $e) {
          session()->flash('message-type', 'error');
          session()->flash('message-title', 'Gagal');
          session()->flash('message', 'Surat Jalan gagal ditambahkan! trace : '.$e->getMessage());
        }
        return redirect()->route('show_delivery',$r->delivery_id);
    }
}
