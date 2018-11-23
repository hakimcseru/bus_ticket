<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenttopsheet extends Model
{
    protected $table = 'agent_top_sheet';
    protected $fillable = ['agent_id','total_amount','ticket_amount','current_balance','total_purchased_amount','total_commission'];


}
