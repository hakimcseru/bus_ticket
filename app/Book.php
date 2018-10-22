<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $fillable = ['type','journal_type','title','cover_photo','file','qr_string','qr_string_unique','author','seminar_organizer','seminar_place','seminar_rapporteurs','origin','author_type','edition','publisher','year_of_publication','illustration','volume','series','category','taggles','copy','price','currency','isbn','journal_issn','source','abstraction','journal_article','self','rack','bibliography','date_of_accusation','admin_id'];
}
