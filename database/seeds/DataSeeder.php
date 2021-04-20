<?php

use Illuminate\Database\Seeder;
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
      DB::table('deliveries')->insert([
          'code' => 'DOMCS',
          'admin' => '1',
          'sender_name' => 'PT. Mencari Cinta Sejati',
          'sender_address' => 'Jl. apa',
          'sender_phone' => '8182773',
          'recipient_name' => 'PT. Proyek gagal',
          'recipient_address' => 'Jl. terserah',
          'recipient_phone' => '8912831',
          'sender_email' => 'pengirim@gmail.com',
          'recipient_email' => 'penerima@gmail.com',
          'freight_load' => 'Batu Ginjal',
          'customer_name' => 'saya',
          'customer_phone' => '0822771823',
          'customer_address' => 'sokon'
      ]);
      DB::table('delivery_orders')->insert([
          'delivery_id' => 1,
          'do_number' => 'DOMCS001',
          'date' => Carbon::now(),
          'driver_id' => 1,
          'fare' => 100000,
          'status' => 2,
          'tonnage' => 200
      ]);
      DB::table('delivery_orders')->insert([
          'delivery_id' => 1,
          'do_number' => 'DOMCS002',
          'date' => Carbon::now(),
          'driver_id' => 2,
          'fare' => 100000,
          'status' => 2,
          'tonnage' => 200
      ]);
      DB::table('deliveries')->insert([
          'code' => 'DOPCSS',
          'admin' => '1',
          'sender_name' => 'PT. Pencari Cinta Sejati Dan Setia Selamanya',
          'sender_address' => 'Jl. apa',
          'sender_phone' => '8192881',
          'recipient_name' => 'PT. Pembasmi Cheat dan Berdoa',
          'recipient_address' => 'Jl. alay',
          'sender_email' => 'pengirim@gmail.com',
          'recipient_email' => 'penerima@gmail.com',
          'recipient_phone' => '8377212',
          'freight_load' => 'Minyak Firdaus',
          'customer_name' => 'anda',
          'customer_phone' => '093819921',
          'customer_address' => 'jl. adkj askdka RT/RW 10/23 adkasdkj, asljkd,'
      ]);
      DB::table('delivery_orders')->insert([
          'delivery_id' => 2,
          'do_number' => 'DOPCSS001',
          'date' => Carbon::now(),
          'driver_id' => 3,
          'fare' => 100000,
          'status' => 2,
          'tonnage' => 200
      ]);
      DB::table('delivery_orders')->insert([
          'delivery_id' => 2,
          'do_number' => 'DOPCSS002',
          'date' => Carbon::now(),
          'driver_id' => 4,
          'fare' => 100000,
          'status' => 2,
          'tonnage' => 200
      ]);

    }
}
