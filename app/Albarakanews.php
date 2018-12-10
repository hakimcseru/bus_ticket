<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Albarakanews extends Model
{
    protected $table = 'albarakanews';
    protected $fillable = ['title','description','status'];

    public function getstatus($code)
    {
        if($code==1) return 'Active';
        else return 'Inactive';
    }
    public function user()
    {
        return $this->hasOne('App\User','id','admin_id');
    }
}

