<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public function teachers(){
    	return $this->hasMany(Teacher::class);
    }

    public function pupils(){
    	return $this->hasMany(Pupil::class);
    }
}
