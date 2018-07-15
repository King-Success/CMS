<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function details() {
        return $this->hasOne('App\Staff');
    }

    public function subject(){
        return $this->hasMany('App\SubjectMapping');
    }
}
