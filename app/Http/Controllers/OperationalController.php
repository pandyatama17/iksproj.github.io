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
use Auth;
use Carbon\Carbon;

class OperationalController extends Controller
{
    public function index()
    {
      $data = Delivery::leftJoin('pools as p', 'p.id','=','deliveries.pool_id')->select('deliveries.*','p.name as pool')->get();

      $pool = "Master";
      return view('delivery.master')
              ->with('pool', $pool)
              ->with('data', $data);
    }
    public function showDeliveriesByPool($id)
    {
      $data = Delivery::where('deliveries.pool_id',$id)
                        ->leftJoin('pools as p', 'p.id','=','deliveries.pool_id')
                        ->select('deliveries.*','p.name as pool')
                        ->get();
      $pool = "Pool ".Pool::find($id)->name;
      return view('delivery.master')
              ->with('pool', $pool)
              ->with('data', $data);
    }
    public function showDeliveryOrders($delivery_id)
    {
      $data = Delivery::where('deliveries.id',$delivery_id)
                        ->leftJoin('users as u','deliveries.admin','=','u.id')
                        ->leftJoin('pools as p', 'p.id','=','deliveries.pool_id')
                        ->select('deliveries.*','u.name as admin', 'p.name as pool')
                        ->first();
      $details = DB::table('delivery_orders as do')
            ->where('do.delivery_id', $delivery_id)
            ->leftJoin('drivers as dr', 'do.driver_id' , '=' , 'dr.id')
            ->leftJoin('vehicle_owners as vh', 'dr.id','=','vh.id')
            ->select('do.id as do_id', 'do.*','dr.name as driver', 'vh.name as transport')
            ->get();
      $transports = VehicleOwner::all();
        // dd($data);
        return view('delivery.list')
                ->with('data', $data)
                ->with('transports', $transports)
                ->with('details', $details);
    }
    public function showDeliveryOrdersMaster()
    {
      $data = DB::table('delivery_orders as do')
            ->leftJoin('deliveries as d', 'do.delivery_id' , '=' , 'd.id')
            ->leftJoin('drivers as dr', 'do.driver_id' , '=' , 'dr.id')
            ->leftJoin('vehicle_owners as vh', 'dr.id','=','vh.id')
            ->select('do.id as do_id', 'do.*','dr.name as driver', 'vh.name as transport', 'd.code as code')
            ->get();
      $pool = "Master Surat Jalan";
      return view('deliveryorder.master')
            ->with('pool', $pool)
            ->with('data', $data);
    }
    public function showDeliveryOrderByPool($id)
    {
      $data = DB::table('delivery_orders as do')
                ->leftJoin('deliveries as d', 'do.delivery_id' , '=' , 'd.id')
                ->where('d.pool_id', $id)
                ->leftJoin('drivers as dr', 'do.driver_id' , '=' , 'dr.id')
                ->leftJoin('vehicle_owners as vh', 'dr.id','=','vh.id')
                ->select('do.id as do_id', 'do.*','dr.name as driver', 'vh.name as transport', 'd.code as code')
                ->get();
      $pool = "Surat Jalan ".Pool::find($id)->name;
      return view('deliveryorder.master')
            ->with('pool', $pool)
            ->with('data', $data);
    }
    public function storeDeliveryOrder(Request $r)
    {
        $do = new DeliveryOrder;

        $do->delivery_id = $r->delivery_id;
        $do->do_number = $r->do_number;
        $do->driver_id = $r->driver;
        $do->license_plate_no = $r->license_plate_no;
        // $do->date = Carbon::parse($r->date);
        if ($r->blending_ref_id)
        {
          $do->blend_ref_id = $r->blending_ref_id;
        }
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
    public function newDelivery()
    {
      return view('delivery.form')->with('method', 'new');
    }
    public function storeDelivery(Request $r)
    {
      $d = new Delivery;
      $d->code = $r->code;
      $d->admin = Auth::user()->id;
      $d->customer_name = $r->customer_name;
      $d->freight_load = $r->freight_load;
      $d->sender_name = $r->sender_name;
      $d->recipient_name = $r->recipient_name;
      $d->pool_id = $r->pool_id;
      $d->date = Carbon::parse($r->date);

      // references
      $refs = [
                'code'=>['head'=>1,'body'=>$r->code],
                'customer'=>['head'=>3,'body'=>$r->customer_name],
                'sender'=>['head'=>3,'body'=>$r->sender_name],
                'recipient'=>['head'=>3,'body'=>$r->recipient_name],
                'freight_load'=>['head'=>2,'body'=>$r->freight_load],
              ];
      $test = "";
      $returnMsg = "";
      foreach ($refs as $key => $value) {
          // $test .= $key."->".$value['body']." ";
          $checkRef = Ref::where('head', $value['head'])->where('body',$value['body'])->first();

          if (!$checkRef) {
            $ref = new Ref;
            $ref->head = $value['head'];
            $ref->body = $value['body'];
            try {
              $ref->save();
            }
            catch (\Exception $e) {
                $returnMsg .= 'ref_'.$key.' fail';
            }
          }
      }
      // return $returnMsg;
      try {
        $d->save();
        session()->flash('message-type', 'success');
        session()->flash('message-title', 'Berhasil');
        session()->flash('message', 'Rekap Tongkang berhasil ditambahkan');
        return redirect()->route('show_delivery',$d->id);
      } catch (\Exception $e) {
        session()->flash('message-type', 'error');
        session()->flash('message-title', 'Gagal');
        session()->flash('message', 'Rekap Tongkang gagal ditambahkan! trace : '.$e->getMessage());
        return redirect()->route('new_delivery');
      }
    }
    public function newDeliveryOrder()
    {
      $deliveries = Delivery::where('show_available',true)->get();
      return view('deliveryorder.form')
      ->with('method', 'new')
      ->with('deliveries', $deliveries);
    }
    public function storeDeliveryOrder2(Request $r)
    {

        // return $r;
        $rows = $r->rows - 1;
        for ($i=0; $i < $rows; $i++)
        {
          $do = new DeliveryOrder;

          $do->delivery_id = $r->delivery_id;
          $do->do_number = $r->do_number[$i];
          $do->driver_id = $r->driver_id[$i];
          $do->license_plate_no = $r->license_plate_no[$i];
          // $do->date = Carbon::parse($r->date);
          if ($r->input('blending_ref_id-'.$i))
          {
            $do->blend_ref_id = $r->input('blending_ref_id-'.$i);
          }
          $do->tonnage = $r->tonnage[$i];
          $do->fare = $r->fare[$i];
          $do->status = 2;

          try {
            $do->save();
            session()->flash('message-type', 'success');
            session()->flash('message-title', 'Berhasil');
            session()->flash('message', '['.$rows.'] Surat Jalan berhasil ditambahkan');
          } catch (\Exception $e) {
            session()->flash('message-type', 'error');
            session()->flash('message-title', 'Gagal');
            session()->flash('message', 'Surat Jalan gagal ditambahkan! trace : '.$e->getMessage());
          }
        }
        // return $values;
        return redirect()->route('show_delivery',$r->delivery_id);
    }
}
