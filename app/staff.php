<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class staff extends Model
{
     protected $guarded = [];

     public function class() {
        return $this->hasOne('App\schoolClass');
     }

     public function subject() {
         return $this->belongsTo('App\subject');
     }

     public function staffType() {
         return $this->belongsTo('App\staffType');
     }
}
