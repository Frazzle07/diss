<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caregiver extends Model
{
    public function children(){
    	return $this->belongsToMany(Pupil::class);
    }
}
