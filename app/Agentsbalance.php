<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agentsbalance extends Model
{
    protected $table = 'agents_balance';
    protected $fillable = ['agent_id','route_id','name','contact_number','per_ticket_discount','ticket_amount','amount','date_of_bill'];
}
