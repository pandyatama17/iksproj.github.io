<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VehicleOwner extends Model
{
  protected $table = "vehicle_owners";
  protected $guarded = ['id'];
}
