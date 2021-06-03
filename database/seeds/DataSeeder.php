<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($i=3; $i <=100 ; $i++) {
      //   DB::table('deliveries')->insert([
      //     'id' => $i,
      //      'code' => 'Banyak-'.sprintf("%03d", $i),
      //      'admin' => '1',
      //      'sender_name' => 'Snd Test Banyak-'.sprintf("%03d", $i),
      //      'recipient_name' => 'Rec Test Banyak-'.sprintf("%03d", $i),
      //      'freight_load' => 'Test Purposes Only',
      //      'customer_name' => 'Cust Test Banyak-'.sprintf("%03d", $i),
      //      'pool_id' => rand(1,2),
      //      'exported' => true,
      //      'show_available' => false,
      //  ]);
      //    DB::table('exported_deliveries')->insert([
      //       'delivery_id' => $i,
      //       'final_rit' => rand(1,10),
      //       'final_tonnage' => substr(str_shuffle("0123456789"), 0, 4)
      //   ]);
      //       DB::table('vehicle_owners')->insert([
      //           'name' =>strtoupper(Str::random(3)),
      //           'email' => Str::random(10).'@gmail.com',
      //           'phone' => rand(1,12),
      //           'address' => Str::random(100)
      //       ]);
      // }

      // DB::table('deliveries')->insert([
      //     'code' => 'DOMCS',
      //     'admin' => '1',
      //     'sender_name' => 'PT. Mencari Cinta Sejati',
      //     'recipient_name' => 'PT. Proyek gagal',
      //     'sender_email' => 'pengirim@gmail.com',
      //     'recipient_email' => 'penerima@gmail.com',
      //     'freight_load' => 'Batu Ginjal',
      //     'customer_name' => 'saya',
      // ]);
      // DB::table('delivery_orders')->insert([
      //     'delivery_id' => 1,
      //     'do_number' => 'DOMCS001',
      //     'date' => Carbon::now(),
      //     'driver_id' => 1,
      //     'fare' => 100000,
      //     'status' => 2,
      //     'tonnage' => 200
      // ]);
      $rand = rand(1,10);
      DB::table('delivery_orders')->insert([
          'delivery_id' => 28,
          'do_number' => 'DOSP/001'.sprintf('%03d', $i),
          'driver_id' => $rand,
          'license_plate_no' => \App\Driver::find($rand)->license_plate_no,
          'driver_name' => \App\Driver::find($rand)->name,
          'fare' => 500000,
          'status' => 2,
          'tonnage' => 1000,
          'created_at' => Carbon::now(),
          'updated_at' => Carbon::now()
      ]);
      // DB::table('deliveries')->insert([
      //     'code' => 'DOPCSS',
      //     'admin' => '1',
      //     'sender_name' => 'PT. Pencari Cinta Sejati Dan Setia Selamanya',
      //     'recipient_name' => 'PT. Pembasmi Cheat dan Berdoa',
      //     'recipient_address' => 'Jl. alay',
      //     'sender_email' => 'pengirim@gmail.com',
      //     'freight_load' => 'Minyak Firdaus',
      //     'customer_name' => 'anda',
      // ]);
      // DB::table('delivery_orders')->insert([
      //     'delivery_id' => 2,
      //     'do_number' => 'DOPCSS001',
      //     'date' => Carbon::now(),
      //     'driver_id' => 3,
      //     'fare' => 100000,
      //     'status' => 2,
      //     'tonnage' => 200
      // ]);
      // DB::table('delivery_orders')->insert([
      //     'delivery_id' => 2,
      //     'do_number' => 'DOPCSS002',
      //     'date' => Carbon::now(),
      //     'driver_id' => 4,
      //     'fare' => 100000,
      //     'status' => 2,
      //     'tonnage' => 200
      // ]);

      }
    }
}
