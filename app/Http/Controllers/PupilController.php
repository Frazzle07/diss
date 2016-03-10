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
	    $path = public_path().'uploads/'.Auth::user()->id;

	    if (!file_exists($path)) {
	    	Storage::MakeDirectory(public_path('uploads/'.Auth::user()->id));
		}

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

			$user->files()->save($dbFile);
    	}
	    return redirect('landing');
    }

    public function downloadFile(Request $request, File $file)
    {
    	$userID = Auth::user()->id;
    	$realFileName = $file->name;
    	$hashFileName = File::where('name', $realFileName)->first();
    	$hashFileName = $hashFileName->hash; 
    	$path = public_path().'/uploads/'.$userID.'/'.$hashFileName;
    	return response()->download($path, $realFileName);

    	return redirect('landing');
    }
}
