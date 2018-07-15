<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
     protected $guarded = [];

     public function staffType() {
         return $this->belongsTo('App\staffType');
     }
}
