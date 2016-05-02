<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'title', 'classroom_id', 'teacher_id', 'due_date'
    ];

}
