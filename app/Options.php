<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    protected $table = 'options';
    protected $fillable = ['name','value','details','is_active'];
}
