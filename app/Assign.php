<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    protected $table = 'assign';
    protected $fillable = ['fleet_registration_no','route_id','route_name','start_date','end_date','driver_name','assistants','admin_id','status'];
}
