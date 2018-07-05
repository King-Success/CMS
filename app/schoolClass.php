<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class schoolClass extends Model
{
    protected $table = 'classes';
    
    public function students() {
        return $this->hasMany('App\student');
    }

    public function staff() {
        return $this->belongsTo('App\staff');
    }

    public function subjects() {
        return $this->hasMany('App\subject');
    }


}
