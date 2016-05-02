<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{

    protected $fillable = [
	    'file_id',
	    'teacher_id',
	    'user_id',
	    'mark',
	    'comments',
	    'filename',
	    'submission_id',
	];	
}
