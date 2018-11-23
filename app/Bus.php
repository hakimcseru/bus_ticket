<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    protected $table = 'bus';
    protected $fillable = ['registration_no','fleet_type','engine_no','model_no','admin_id','total_seat','seat_number','bus_photo','status'];


}
