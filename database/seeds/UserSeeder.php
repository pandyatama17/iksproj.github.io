<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
      'name' => 'Superadmin',
      'email' => 'owner@iks.com',
      'password' => Hash::make('rahasia'),
      'pool_id' => 0
  ]);
    }
}
