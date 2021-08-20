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
use Auth;
use Session;
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
      // $driver = Driver::find($driver_id);

      $driver = Driver::where('drivers.id',$driver_id)
                ->leftJoin('vehicle_owners as vo','vo.id','=','drivers.owner_id')
                ->select('drivers.*', 'vo.name as transport')
                ->first();

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
    public function getDO($id)
    {
      $do = DeliveryOrder::where('delivery_orders.id',$id)
            ->leftJoin('deliveries','delivery_orders.delivery_id','=','deliveries.id')
            ->select('delivery_orders.*','deliveries.code as code', 'deliveries.customer_name as customer_name')
            ->first();
      // $do = DeliveryOrder::find($id);
      echo json_encode($do);
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

      if (Session::has('pool')) {
        $data->where('pool_id',Session::get('pool'));
      }

      $columns = array(
                            0 =>'code',
                            1 =>'created_at',
                            2=> 'customer_name',
                            3=> 'pool',
                            4=> 'sender_name',
                            5=> 'recipient_name',
                        );
      if (Session::has('pool')) {
        $totalData = Delivery::where('pool_id',Session::get('pool'))->count();
      }
      else {
        $totalData = Delivery::count();
      }
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
            // $nestedData['tonnage'] = array_sum(DeliveryOrder::where('delivery_id',$delivery->id)->pluck('tonnage')->toArray())."Kg.";
            $dels = DeliveryOrder::where('delivery_id',$delivery->id)->get();
            $total_fare = 0;
            foreach ($dels as $dos) {
              $total_fare += $dos->fare;
            }
            $nestedData['tonnage'] = rupiah($total_fare);
            $nestedData['rit'] = '<span class="badge badge-info">'.count(DeliveryOrder::where('delivery_id',$delivery->id)->get()).' Rit</span>';
            // $nestedData['options'] = '<a href="'.route('show_delivery',$delivery->id).'" class="btn btn-sm btn-primary url-redirect">
            //                             <i class="fa fa-search"></i> | Surat Jalan
            //                           </a>
            //                           <div class="clearfix" style="margin:5px;"></div>
            //                           <a href="#" class="btn btn-sm btn-success url-redirect url-unavailable">
            //                             <i class="fa fa-file-excel"></i> | Import Excel
            //                           </a>
            //                           <div class="clearfix" style="margin:5px;"></div>
            //                           <a href="#" class="btn btn-sm btn-danger url-redirect url-unavailable">
            //                             <i class="fa fa-flag-checkered"></i> | Selesaikan Rekap
            //                           </a>';
            $nestedData['options'] ='<a href="'.route('show_delivery',$delivery->id).'" class="text-primary url-redirect">
                                        <i class="fa fa-search"></i> | Surat Jalan
                                      </a>';
            // if ($delivery->exported == false) {
              $nestedData['options'] .='<br>
                                        <a href="'.route('export_delivery',$delivery->id).'" class="text-success url-redirect url-unavailable">
                                          <i class="fa fa-file-excel"></i> | Unduh Excel
                                        </a>';
            if ($delivery->exported) {
              $nestedData['options'] .= '<br>
                                        <small class="text-success"><i>Diunduh tgl :  '.$delivery->updated_at.' </i></small>';
            }
            if (Auth::user()->pool_id == $delivery->pool_id || Auth::user()->role < 2) {
              $nestedData['options'] .= '<br>
                                        <a href="'.route('edit_delivery',$delivery->id).'" class="text-warning url-redirect" >
                                          <i class="fa fa-edit"></i> | Edit Rekap
                                        </a>';
            }
            $nestedData['options'] .= '<br>
                                      <a href="#" class="text-danger url-redirect url-unavailable finish-delivery" data-id="'.$delivery->id.'" data-exported="'.$delivery->exported.'" data-code="'.$delivery->code.'">
                                        <i class="fa fa-flag-checkered"></i> | Selesaikan Rekap
                                      </a>';

          }
          else {
            // $nestedData['tonnage'] = ExportedDelivery::where('delivery_id',$delivery->id)->first()->final_tonnage."Kg.";
            $nestedData['tonnage'] = rupiah(ExportedDelivery::where('delivery_id',$delivery->id)->first()->final_fare);
            $nestedData['rit'] = '<span class="badge badge-secondary">'.ExportedDelivery::where('delivery_id',$delivery->id)->first()->final_rit.' Rit</span>';
            $nestedData['options'] = '<small class="text-success"><i>Rekap telah di import Excel</i></small>
                                      <br>
                                      <small class="text-primary"><i>Rekap Selesai ('.$delivery->created_at.')</i></small>
                                    ';
            $nestedData['options'] = '<small class="text-primary"><i>Rekap Selesai ('.$delivery->created_at.')</i></small>';
            if (Auth::user()->role == 0) {
              $nestedData['options'] .= '<br>
                                          <a href="'.route('activate_delivery',$delivery->id).'" class="text-danger url-redirect url-unavailable activate-delivery" data-id="'.$delivery->id.'" data-code="'.$delivery->code.'">
                                            <i class="fa fa-file-upload"></i> | Aktifkan Rekap
                                          </a>';
            }
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

    public function showDriversByTransport($transport_id)
    {
      $transport = VehicleOwner::find($transport_id);
      $drivers = Driver::where('owner_id',$transport_id)->get();

      return view('includes.driverslist')->with('drivers', $drivers)->with('transport', $transport);
    }
    public function getJournal(Request $r)
    {
      DB::connection()->enableQueryLog();
      // return $r;
      $dates = explode(' -sampai- ',$r->dates);
      setlocale(LC_ALL, 'id_MX', 'id', 'ID');
      $dateDesc = 'Data Rekap Selesai per tanggal '.Carbon::parse($dates[0])->formatLocalized('%d %B %Y').' sampai '.Carbon::parse($dates[1])->formatLocalized('%d %B %Y');

      // $deliveries = DB::table('deliveries')->where('show_available',0);
      $deliveries = Delivery::where('show_available',0);
      foreach (Pool::all() as $index => $pool)
      {
        if ($r->has('pool-'.$pool->id) && $r->input('pool-'.$pool->id) == 'true')
        {
          if ($index == 0) {
            $deliveries->where('pool_id', $pool->id);
          }
          else {
            $deliveries->orWhere('pool_id', $pool->id);
          }
        }
      }

      $deliveries->where('created_at','>=',Carbon::parse($dates[0]))->where('created_at','<=',Carbon::parse($dates[1]));
      $journal = $deliveries->get();
      // return $deliveries->getBindings();
      // return $deliveries->toSQL();
      // dd($deliveries);
      // $deliveries = Delivery::where('show_available',false)->where('created_at','>=',Carbon::parse($dates[0]))->where('created_at','<=',Carbon::parse($dates[1]))->get();
      return view('includes.journals')
              ->with('dateDesc',$dateDesc)
              ->with('journal',$journal);
    }
}
