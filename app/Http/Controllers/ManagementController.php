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
        $dr->phone = 11123333;
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
    public function showUsers()
    {
      // $users = User::leftJoin('pools','pools.id','=','users.pool_id')
      //                 ->select('pools.*', 'pool.name as pool')
      //                 ->get();
      $users = User::all();

      return view('management.users')
              ->with('data', $users);
    }
}
