<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';
    protected $fillable = ['assign_id','route_id','route_name','booking_date','user_id','total_seat','seat_number','price','discount','pickup_location','drop_location','admin_id','status','agent_id','customer_name_gender','customer_primary_email','customer_primary_phone'];
}
