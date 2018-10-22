<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $fillable = ['type','title','cover_photo','file', 'qr_string','aus','aum','auf','aus_one','aum_one','auf_one','aus_two','aum_two','auf_two','aus_three','aum_three','auf_three','author_type','edition','co_author','place_of_publication','publisher','year_of_publication','page_number','illustration','physical_description','volume','series','subject','copy','price','currency','isbn','Journal_issn','source','from_source','location','abstraction','self','rack','bibliography','date_of_procurement','admin_id','author_marks'];
}
