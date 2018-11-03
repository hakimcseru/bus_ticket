<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agentsbalance extends Model
{
    protected $table = 'agents_balance';
    protected $fillable = ['agent_id','name','contact_number','how_many_ticket','amount','date_of_bill'];
}
