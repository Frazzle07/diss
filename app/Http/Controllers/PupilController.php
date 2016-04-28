<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\File;
use App\Http\Requests;
use Auth;
use Input;
use Storage;

class PupilController extends Controller
{
    public function showFiles(Request $request)
    {
    	$files = User::find($request->user()->id)->files;
    	return view('landing', compact("files"));
    }

    public function uploadFile(Request $request, File $file, User $user){
    	$files = Input::file('files');

		foreach($files as $file) {
        	$name = $file->getClientOriginalName();
			$size = $file->getSize();
			$hash = $file->getFileName();

			$file->move('uploads/'.Auth::user()->id);

			$ranName = Input::get('my_pdf');

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
        }

    	$realFileName = $file->name;
    	$hashFileName = File::where('name', $realFileName)->first();
    	$hashFileName = $hashFileName->hash; 
    	$path = public_path().'/uploads/'.$userID.'/'.$hashFileName;
    	return response()->download($path, $realFileName);

    	return redirect('landing');
    }

    public function deleteFile(Request $request, File $file)
    {
        echo "test";
        $userID = Auth::user()->id;
        $realFileName = $file->name;
        $file = File::where('name', $realFileName)->first();
        $hashFileName = $file->hash; 
        $path = 'public/uploads/'.$userID.'/'.$hashFileName;
        Storage::delete("$path");

        $check = $file->delete();

        if(!$check) {
            flash("There Were Errors When Deleting Your File", "Fail");
        } else {
            flash("The File Was Deleted Successfully", "Success");
        }

        return redirect('landing');
    }

    public function markFile(File $file){

        $mark = File::find($file->id)->name;
       
        return view('markFile', compact("mark"));
    }
}
