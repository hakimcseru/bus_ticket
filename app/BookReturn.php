<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookReturn extends Model
{
    protected $table = 'book_return';
    protected $fillable = ['book_issue_id','user_id','admin_id','return_date','late_count'];
}
