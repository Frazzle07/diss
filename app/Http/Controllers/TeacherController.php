<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;
use App\Classroom;
use App\User;
use App\Mark;
use App\File;
use App\Submission;
use App\Http\Requests;
use Auth;
use Carbon\Carbon;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
    	$teacher = Teacher::where('user_id', $request->user()->id)->first();
    	$classroomID = $teacher->classroom_id;
    	$pupils = Classroom::find($classroomID)->pupils;
        $toBeMarked = Mark::where('teacher_id', Auth::user()->id)->where('marked', '0')->get();
        $submissions = Submission::where("due_date", ">", Carbon::now())->paginate(10);
        return view('teacher', compact("pupils", "toBeMarked", "submissions"));
    }

    public function showPupilFiles(Request $request, User $user)
    {
    	$files = User::find($user->id)->files;
        $pupil = User::find($user->id)->name;
    	return view('pupilFilestore', compact("files", "pupil"));
    }

    public function showSubmission(Submission $submission)
    {
        $toBeMarked = Mark::where('submission_id', $submission->id)->where('marked', 0)->paginate(10);
        $marked = Mark::where('submission_id', $submission->id)->where('marked', 1)->paginate(10);
        return view('submission', compact("submission", "toBeMarked", "marked"));
    }

    public function showPastSubmissions(User $user)
    {
        $teacher = Teacher::where("user_id", $user->id)->first();
        $submissions = Submission::where("teacher_id", $teacher->id)->where("due_date", "<", Carbon::now())->paginate(10);
        dd($submissions);
        return view('pastSubmissions', compact("submissions"));
    }

    public function updateMark(Request $request, File $file)
    {
        $this->validate($request, [
            'mark' => 'required'
        ]);

        $markedFile = File::where('id', $file->id)->first();
        $file->mark = $request->mark;
        $file->save();

        $markedFile = Mark::where('file_id', $file->id)->first();
        $markedFile->mark = $request->mark;
        $markedFile->marked = 1;
        $markedFile->save(); 

        flash("The File Was Given A Mark", "Success");

        return back();
    }
}
