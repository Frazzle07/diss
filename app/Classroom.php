<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    
	protected $fillable = [
        'name'
    ];

    public function teachers(){
    	return $this->hasMany(Teacher::class);
    }

    public function pupils(){
    	return $this->hasMany(Pupil::class);
    }

    public function getPupilsPaginated()
	{
	    return $this->pupils()->paginate(10);
	}
}
