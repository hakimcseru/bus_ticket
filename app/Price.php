<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'price';
    protected $fillable = ['route_id','route_name','vehicle_type','price','groups_per_person','group_members','admin_id','status'];
}
