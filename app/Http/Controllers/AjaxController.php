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

    public function getDeliveries(Request $request)
    {
      $data = Delivery::leftJoin('pools as p', 'p.id','=','deliveries.pool_id')->select('deliveries.*','p.name as pool');

      $columns = array(
                            0 =>'code',
                            1 =>'created_at',
                            2=> 'customer_name',
                            3=> 'pool',
                            4=> 'sender_name',
                            5=> 'recipient_name',
                        );
      $totalData = Delivery::count();
      $totalFiltered = $totalData;
      $limit = $request->input('length');
      $start = $request->input('start');
      $order = $columns[$request->input('order.0.column')];
      $dir = $request->input('order.0.dir');
      if(empty($request->input('search.value')))
      {
        $deliveries = $data->offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
      }
      else
      {
        $search = $request->input('search.value');

        $deliveries =  $data->where('deliveries.id','LIKE',"%{$search}%")
                        ->orWhere('deliveries.code', 'LIKE',"%{$search}%")
                        ->orWhere('deliveries.customer_name', 'LIKE',"%{$search}%")
                        ->orWhere('deliveries.sender_name', 'LIKE',"%{$search}%")
                        ->orWhere('deliveries.recipient_name', 'LIKE',"%{$search}%")
                        ->orWhere('deliveries.freight_load', 'LIKE',"%{$search}%")
                        ->offset($start)
                        ->limit($limit)
                        ->orderBy($order,$dir)
                        ->get();

        $totalFiltered = $data->where('deliveries.id','LIKE',"%{$search}%")
                             ->orWhere('deliveries.code', 'LIKE',"%{$search}%")
                             ->orWhere('deliveries.customer_name', 'LIKE',"%{$search}%")
                             ->orWhere('deliveries.sender_name', 'LIKE',"%{$search}%")
                             ->orWhere('deliveries.recipient_name', 'LIKE',"%{$search}%")
                             ->orWhere('deliveries.freight_load', 'LIKE',"%{$search}%")
                             ->count();
      }
      $data = array();
      if(!empty($deliveries))
      {
        foreach ($deliveries as $delivery)
        {
          $nestedData['code'] = "<b>".$delivery->code."</b>";
          $nestedData['date'] = Carbon::parse($delivery->created_at)->format('d-m-Y');
          $nestedData['customer'] = $delivery->customer_name;
          $nestedData['sender'] = $delivery->sender_name;
          $nestedData['recipient'] = $delivery->recipient_name;
          $nestedData['pool'] = $delivery->pool;
          $nestedData['freight_load'] = $delivery->freight_load;
          if ($delivery->show_available)
          {
            $nestedData['tonnage'] = array_sum(DeliveryOrder::where('delivery_id',$delivery->id)->pluck('tonnage')->toArray())."Kg.";
            $nestedData['rit'] = '<span class="badge badge-info">'.count(DeliveryOrder::where('delivery_id',$delivery->id)->get()).' Rit</span>';
            $nestedData['options'] = '<a href="'.route('show_delivery',$delivery->id).'" class="btn btn-sm btn-primary url-redirect">
                                        <i class="fa fa-search"></i> | Surat Jalan
                                      </a>
                                      <div class="clearfix" style="margin:5px;"></div>
                                      <a href="#" class="btn btn-sm btn-success url-redirect url-unavailable">
                                        <i class="fa fa-file-excel"></i> | Buat Excel
                                      </a>
                                      <div class="clearfix" style="margin:5px;"></div>
                                      <a href="#" class="btn btn-sm btn-danger url-redirect url-unavailable">
                                        <i class="fa fa-flag-checkered"></i> | Selesaikan Rekap
                                      </a>';

          }
          else {
            $nestedData['tonnage'] = ExportedDelivery::where('delivery_id',$delivery->id)->first()->final_tonnage."Kg.";
            $nestedData['rit'] = '<span class="badge badge-secondary">'.ExportedDelivery::where('delivery_id',$delivery->id)->first()->final_rit.' Rit</span>';
            $nestedData['options'] = '<small><i> no action available </i></small>
                                      <br>
                                      <small class="text-success"><i>data ini sudah dibuat excel</i></small>
                                      <br>
                                      <small class="text-primary"><i>rekap ini telah selesai</i></small>
                                    ';
          }
          $data[] = $nestedData;

        }
      }
      $json_data = array(
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                    );

      // dd($json_data);
      echo json_encode($json_data);
      // echo json_encode($data);
    }
}
