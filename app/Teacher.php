<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
	protected $fillable = [
        'user_id', 'name', 'classroom_id'
    ];

    public function classes(){
    	return $this->belongsTo(Classroom::class);
    }
}
