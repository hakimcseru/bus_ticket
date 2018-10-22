<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'country';
    protected $fillable = [
        'code', 'namecap', 'name', 'iso3', 'numcode'
    ];
    public $timestamps = false;
}
