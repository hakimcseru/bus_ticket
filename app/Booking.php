<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';
    protected $fillable = ['route_id','route_name','booking_date','user_id','total_seat','seat_number','price','discount','pickup_location','drop_location','admin_id','status'];
}
