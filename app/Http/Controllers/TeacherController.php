<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\Classroom;
use App\User;
use App\Http\Requests;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
    	$teacher = Teacher::where('user_id', $request->user()->id)->first();
    	$classroomID = $teacher->classroom_id;
    	$pupils = Classroom::find($classroomID)->pupils;
        return view('teacher', compact("pupils"));
    }

    public function showPupilFiles(Request $request, User $user)
    {
    	$files = User::find($user->id)->files;
        $pupil = User::find($user->id)->name;
    	return view('pupilFilestore', compact("files", "pupil"));
    }
}
