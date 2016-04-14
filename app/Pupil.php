<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pupil extends Model
{
    public function classes(){
    	return $this->belongsTo(Classroom::class);
    }

    public function caregivers(){
    	return $this->belongsToMany(Caregiver::class);
    }

    public function files(){
        return $this->hasMany(File::class);
    }
}
