<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subject extends Model
{
    protected $guarded = [];

    public function teacher() {
         return $this->hasOne('App\staff');
     }

     public function class() {
         return $this->belongsTo('App\class');
     }

     public function student() {
         return $this->belongsToMany('App\student');
     }
}
