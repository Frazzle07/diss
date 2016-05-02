<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pupil;
use App\File;
use App\Http\Requests;
use Auth;
use Input;
use Storage;
use App\Teacher;
use App\Mark;
use App\Submission;
use Carbon\Carbon;

class PupilController extends Controller
{
    public function showFiles(Request $request)
    {
    	$files = User::find($request->user()->id)->files()->where('deleted', 0)->get();
        $toBeMarked = Mark::where('user_id', Auth::user()->id)->where('marked', '0')->paginate(10);
    	return view('landing', compact("files", "toBeMarked"));
    }

    public function uploadFile(Request $request, File $file, User $user){
    	$files = Input::file('files');

		foreach($files as $file) {

        	$name = $file->getClientOriginalName();
            $duplicate = File::where('deleted', 0)->where('user_id', Auth::user()->id)->where('name', $name)->first();
            if (count($duplicate)) { 
                flash("Please Rename Your File To Something Unique", "Fail");
                return redirect('landing');
            }
			$size = $file->getSize();
			$hash = $file->getFileName();

			$file->move('uploads/'.Auth::user()->id);

			$dbFile = new File;
			$dbFile->name = $name;
			$dbFile->size = $size;
			$dbFile->hash = $hash;

			$check = $user->files()->save($dbFile);
    	}

        if(!$check) {
            flash("There Were Errors When Uploading Your Files", "Fail");
        } else {
            flash("The File Was Uploaded Successfully", "Success");
        }

	    return redirect('landing');
    }

    public function downloadFile(Request $request, File $file)
    {
    	if ($request->user()->level == "admin"){
            $userID = $file->user_id;
        } elseif ($request->user()->level == "teacher") {
            $userID = $file->user_id;
        } elseif ($request->user()->level == "pupil"){
            $userID = Auth::user()->id;
        } elseif ($request->user()->level == "parent"){
            $userID = $file->user_id;
        }

    	$realFileName = $file->name;
    	$hashFileName = $file->hash;
    	$path = public_path().'/uploads/'.$userID.'/'.$hashFileName;
    	return response()->download($path, $realFileName);

    	return redirect('landing');
    }

    public function deleteFile(Request $request, File $file)
    {
        $userID = Auth::user()->id;
        $realFileName = $file->name;
        $file = File::where('name', $realFileName)->where('deleted', 0)->where('user_id', Auth::user()->id)->first();
        $hashFileName = $file->hash; 
        $path = 'public/uploads/'.$userID.'/'.$hashFileName;
        Storage::delete("$path");

        $file->deleted = 1;
        $check = $file->save();

        if(!$check) {
            flash("There Were Errors When Deleting Your File", "Fail");
        } else {
            flash("The File Was Deleted Successfully", "Success");
        }

        return redirect('landing');
    }

    public function markFile(File $file)
    {
        $mark = File::find($file->id);
        $teachers = Teacher::all();
        $pupilClass = Pupil::where('user_id', Auth::user()->id)->first()->classroom_id;
        $submissions = Submission::where('classroom_id', $pupilClass)->orderBy('due_date', 'desc')->get();
  
        return view('markFile', compact("mark", "teachers", "submissions"));
    }


    public function addMarkFile(Request $request, File $file)
    {
        $submission = Submission::where('id', $request->submission)->first();
        if($submission->due_date < Carbon::now()->toDateString()){
            $late = 1;
        } else {
            $late = 0;
        }

        $newMarkFile = Mark::create([
            'file_id' => $file->id,
            'user_id' => Auth::user()->id,
            'teacher_id' => $request->teacher,
            'mark' => 0,
            'comments' => $request->comments,
            'filename' => $file->name,
            'submission_id' => $request->submission,
            'late' => $late,
        ]);

        if(!$newMarkFile) {
            flash("There Were Errors When Sending the File to be Marked", "Fail");
        } else {
            flash("The File was Sent to be Marked", "Success");
        }

        return redirect('landing');
    }
}
