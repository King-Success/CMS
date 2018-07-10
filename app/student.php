<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $guarded = [];

    public function class() {
        return $this->belongsTo('App\class');
    }

    public function subjectScores() {
        return $this->hasMany('App\subjectScores');
    }

    public function subjects() {
        return $this->belongsToMany('App\subject', 'student_subject', 'student_id', 'subject_id');
    }
}
