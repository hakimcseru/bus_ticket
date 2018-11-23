<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    protected $table = 'assign';
    protected $fillable = ['fleet_registration_no','route_id','route_name','start_point_name','end_point_name','start_date','end_date','start_time','end_time','driver_name','assistants','admin_id','status'];

    public function fleet()
    {
        return $this->hasOne('App\Bus','registration_no','fleet_registration_no');
    }
    public function booked($date,$assign_id)
    {
        $total_booked=Booking::where('booking_date', $date)
        ->where('assign_id', $assign_id)
        ->where('order_status', 'Pending')
        ->sum('total_seat');
        
        return $total_booked;
    }
    public function sold($date,$assign_id)
    {
        //echo $date.' '.$assign_id;//die();
        $total_booked=Booking::where('booking_date', $date)
        ->where('assign_id', $assign_id)
        ->whereNull('order_status')
        ->sum('total_seat');
        return $total_booked;
    }
}
