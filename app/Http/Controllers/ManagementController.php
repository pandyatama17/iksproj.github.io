<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Delivery;
use App\DeliveryOrder;
use App\Driver;
use App\Pool;
use App\VehicleOwner;
use App\Ref;
use App\ExportedDelivery;
use App\User;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DeliveryExport;

use DB;
use Auth;
use Carbon\Carbon;

class ManagementController extends Controller
{
    public function showTransports()
    {
      $transports = VehicleOwner::all();

      return view('management.transports')
              ->with('transports', $transports);
    }
    public function storeDriver(Request $r)
    {
        $dr = new Driver;
        $dr->name = $r->name;
        $dr->owner_id = $r->owner_id;
        $dr->license_plate_no = $r->license_plate_no;
        $dr->phone = 111111;
        $dr->vehicle_type = 'default';
        $dr->vehicle_brand = 'default';
        $dr->vehicle_name = 'default';

        try {
          $dr->save();
          session()->flash('message-type', 'success');
          session()->flash('message-title', 'Berhasil');
          session()->flash('message', 'Sopir berhasil ditambahkan');
        } catch (\Exception $e) {
          session()->flash('message-type', 'error');
          session()->flash('message-title', 'Gagal');
          session()->flash('message', 'Sopir gagal ditambahkan! trace : '.$e->getMessage());
        }
        return redirect()->route('show_transports');
    }
    public function updateDriver(Request $r)
    {
        $dr = Driver::find($r->driver_id);
        $dr->name = $r->name;
        $dr->license_plate_no = $r->license_plate_no;
        try {
          $dr->save();
          session()->flash('message-type', 'success');
          session()->flash('message-title', 'Berhasil');
          session()->flash('message', 'Sopir berhasil dirubah');
        } catch (\Exception $e) {
          session()->flash('message-type', 'error');
          session()->flash('message-title', 'Gagal');
          session()->flash('message', 'Sopir gagal dirubah! trace : '.$e->getMessage());
        }
        return redirect()->route('show_transports');
    }

    public function storeTransport(Request $r)
    {
        $t = new VehicleOwner;
        $t->name = $r->name;
        $t->email = $r->email;
        $t->phone = $r->phone;
        $t->address = "default";

        try {
          $t->save();
          session()->flash('message-type', 'success');
          session()->flash('message-title', 'Berhasil');
          session()->flash('message', 'Transport berhasil ditambahkan');
        } catch (\Exception $e) {
          session()->flash('message-type', 'error');
          session()->flash('message-title', 'Gagal');
          session()->flash('message', 'Transport gagal ditambahkan! trace : '.$e->getMessage());
        }
        return redirect()->route('show_transports');
    }

    public function showUsers()
    {
      $users = User::all();

      return view('management.users')
              ->with('data', $users);
    }
    public function showPools()
    {
      $pools = Pool::all();
      $users = User::all();

      return view('management.pools')
              ->with('data', $pools)
              ->with('users', $users);
    }
    public function showJournal()
    {
      $pools = Pool::all();
      $deliveries = Delivery::all();
      $startdate = Carbon::parse(Delivery::orderBy('created_at', 'asc')->first()->created_at)->format('d-m-Y');
      $enddate = Carbon::parse(Delivery::orderBy('created_at', 'asc')->first()->created_at)->format('d-m-Y');
      return view('management.journal')
              ->with('pools', $pools)
              ->with('startdate', $startdate)
              ->with('enddate', $enddate)
              ->with('deliveries', $deliveries);
    }
}
