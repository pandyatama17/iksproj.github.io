<?php

use Illuminate\Database\Seeder;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //user
      DB::table('users')->insert([
          'name' => 'Superadmin',
          'email' => 'owner@iks.com',
          'password' => Hash::make('rahasia'),
          'pool_id' => 0
      ]);
      DB::table('users')->insert([
          'name' => 'Admin Pool 1',
          'email' => 'adminpool1@iks.com',
          'password' => Hash::make('rahasia'),
          'pool_id' => 1
      ]);
      DB::table('users')->insert([
          'name' => 'Admin Pool 2',
          'email' => 'adminpool2@iks.com',
          'password' => Hash::make('rahasia'),
          'pool_id' => 2
      ]);

      // pool
      DB::table('pools')->insert([
        'name' => 'Pool 1',
        'phone' => '81728199',
        'address' => 'Jl. satu'
      ]);
      DB::table('pools')->insert([
        'name' => 'Pool 2',
        'phone' => '8172812',
        'address' => 'Jl. dua'
      ]);

      //vehicle owner
      DB::table('vehicle_owners')->insert([
          'name' => 'Mr. Jajang',
          'email' => 'jajang.nandar@gmail.com',
          'phone' => '081828389919',
          'address' => 'Jl. kenangan 10 RT/RW 09/12, Jakarta Timur'
      ]);
      DB::table('vehicle_owners')->insert([
          'name' => 'Mr. Basuki',
          'email' => 'om.basuki@gmail.com',
          'phone' => '081727366166',
          'address' => 'Jl. jalan ke dufan 10 RT/RW 09/12, Jakarta Pusat'
      ]);

      //drivers
      DB::table('drivers')->insert([
          'name' => 'Dominic Toretto',
          'owner_id' => 1,
          'license_plate_no' => 'B 481 LOE',
          'vehicle_brand' => 'Dodge',
          'vehicle_type' => 'Charger R/T',
          'vehicle_name' => 'gatau',
          'phone' => '083219123821',
      ]);
      DB::table('drivers')->insert([
          'name' => 'Brian O\'Conner',
          'owner_id' => 1,
          'license_plate_no' => 'B 46 SAT',
          'vehicle_brand' => 'Nissan',
          'vehicle_type' => 'Skykline GTR R-34',
          'vehicle_name' => 'gatau',
          'phone' => '082319123821',
      ]);
      DB::table('drivers')->insert([
          'name' => 'Luke Hobbs',
          'owner_id' => 2,
          'license_plate_no' => 'A 71 NK',
          'vehicle_brand' => 'Tank',
          'vehicle_type' => 'Tamiya',
          'vehicle_name' => 'gatau. bentuknya kayak tank. gajelas',
          'phone' => '08377132123',
      ]);
      DB::table('drivers')->insert([
          'name' => 'Roman Pierce',
          'owner_id' => 2,
          'license_plate_no' => 'B 3G0 LOE',
          'vehicle_brand' => 'Mitsubishi',
          'vehicle_type' => 'Eclipse Spyder',
          'vehicle_name' => 'gatau',
            'phone' => '082219123821',
      ]);
    }
}
