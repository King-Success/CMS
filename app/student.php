<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $guarded = [];

    public function class() {
        return $this->belongsTo('App\class');
    }

    public function subject() {
        return $this->belongsToMany('App\subject');
    }
}
