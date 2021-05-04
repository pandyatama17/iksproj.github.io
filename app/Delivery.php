<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    protected $table = "deliveries";
    protected $guarded = ['id'];
    protected $casts = [
        'is_available' => 'boolean'
    ];
}
