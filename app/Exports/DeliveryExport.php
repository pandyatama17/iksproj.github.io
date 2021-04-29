<?php

namespace App\Exports;

use App\Delivery;
use App\DeliveryOrder;
use App\VehicleOwner;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;

class DeliveryExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    protected $id;

    function __construct($id) {
          $this->delivery_id = $id;
    }
    public function view(): View
    {
        return view('exports.delivery', [
          'data' => Delivery::where('deliveries.id',$this->delivery_id)
                            ->leftJoin('users as u','deliveries.admin','=','u.id')
                            ->leftJoin('pools as p', 'p.id','=','deliveries.pool_id')
                            ->select('deliveries.*','u.name as admin', 'p.name as pool')
                            ->first(),
          'details' => DB::table('delivery_orders as do')
                ->where('do.delivery_id', $this->delivery_id)
                ->leftJoin('drivers as dr', 'do.driver_id' , '=' , 'dr.id')
                ->leftJoin('vehicle_owners as vh', 'dr.id','=','vh.id')
                ->select('do.id as do_id', 'do.*','dr.name as driver', 'vh.name as transport')
                ->get()
        ]);
    }
    // INI BUAT COLLECTION
    // public function collection()
    // {
    //       // return DeliveryOrder::where('lifeskill_id',$this->id)->get()([
    //       //     'first_name', 'email'
    //       // ]);
    //       // return DeliveryOrder::where('delivery_orders.delivery_id', $this->delivery_id)
    //       //       ->leftJoin('drivers as dr', 'delivery_orders.driver_id' , '=' , 'dr.id')
    //       //       ->leftJoin('vehicle_owners as vh', 'dr.id','=','vh.id')
    //       //       // ->select('delivery_orders.id as do_id', 'delivery_orders.*','dr.name as driver','dr.name as driver', 'vh.name as transport')
    //       //       ->get(['delivery_orders.do_number', 'dr.name','delivery_orders.license_plate_no','delivery_orders.tonnage','vh.name']);
    //       return DB::table('delivery_orders')
    //             ->where('delivery_orders.delivery_id', $this->delivery_id)
    //             ->leftJoin('drivers as dr', 'delivery_orders.driver_id' , '=' , 'dr.id')
    //             ->leftJoin('vehicle_owners as vh', 'dr.id','=','vh.id')
    //             // ->select('delivery_orders.id as do_id', 'delivery_orders.*','dr.name as driver','dr.name as driver', 'vh.name as transport')
    //             ->get(['delivery_orders.do_number', 'dr.name','delivery_orders.license_plate_no','delivery_orders.tonnage','vh.name']);
    //       // return DeliveryOrder::where('delivery_id',$this->delivery_id)->get();
    // }
    // INI BUAT QUERY
    // public function forDelivery(int $id)
    // {
    //     $this->delivery_id = $id;
    //     return $this;
    // }
    // public function query()
    // {
    //   return DB::table('delivery_orders as do')
    //               ->where('do.delivery_id', $this->delivery_id)
    //               // ->leftJoin('drivers as dr', 'do.driver_id' , '=' , 'dr.id')
    //               ->join('drivers as dr', function($join)
    //                 {
    //                     $join->on('do.driver_id', '=', 'dr.id');
    //                 })
    //               ->leftJoin('vehicle_owners as vh', 'dr.owner_id','=','vh.id')
    //               ->select(
    //                   DB::raw('DATE_FORMAT(do.created_at, "%d-%b-%Y")'),
    //                   'do.do_number',
    //                   'dr.name as driver',
    //                   'do.license_plate_no',
    //                   DB::raw('CONCAT(do.tonnage, " kg.")'),
    //                   'vh.name as transport'
    //                   // DB::raw('')
    //               )
    //               ->orderBy('do.id');
    //               // ->get(['delivery_orders.do_number', 'dr.name','delivery_orders.license_plate_no','delivery_orders.tonnage','vh.name']);
    // }
    // public function headings(): array
    // {
    //     return [
    //         'Tanggal',
    //         'No. Surat Jalan',
    //         'Sopir',
    //         'No. Plat',
    //         'Tonase',
    //         'Angkutan'
    //     ];
    // }
}
