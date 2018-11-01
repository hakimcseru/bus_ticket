<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Albarakanews extends Model
{
    protected $table = 'albarakanews';
    protected $fillable = ['title','description','status'];
}
