<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
   
    protected $fillable = ['IP_visiteur', 'book_id', 'vote'];

    public function book(){
    	return $this->belongsTo(Book::class);
    }

}
