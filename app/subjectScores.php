<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subjectScores extends Model
{
    protected $guarded = [];

    public function student() {
        return $this->belongsTo('App\User');
    }

    public function teacher() {
        return $this->belongsTo('App\Teacher');
    }

    public function subject() {
        return $this->belongsTo('App\Subject');
    }

}
