<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookIssue extends Model
{
    protected $table = 'book_issue';
    protected $fillable = ['book_issue_code','book_id','book_title','copy_number','user_id','user_name','admin_id','type','start_date','end_date','status','is_returned'];
}
