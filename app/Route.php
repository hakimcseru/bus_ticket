<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $table = 'route';
    protected $fillable = ['name','start_point','start_point_name','end_point','end_point_name','stoppage_points','distance','approximate_time','admin_id','status'];
}
