<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caregiver extends Model
{
	protected $fillable = [
        'name', 'user_id'
    ];

    public function children(){
    	return $this->belongsToMany(Pupil::class);
    }
}
