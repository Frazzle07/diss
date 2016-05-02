<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Request;

use App\Http\Requests;
use App\Pupil;
use App\Teacher;
use App\Caregiver;
use App\User;
use App\Classroom;
use App\Admin;
use App\Level;
use Input;
use DB;

class AdminController extends Controller
{
    public function index()
    {
    	$items = Level::all('name');
    	$classrooms = Classroom::all('id', 'name');
    	$parents = Caregiver::all('id', 'name');
    	$pupils = Pupil::all('id', 'name');
    	return view('admin', compact("items", "classrooms", "parents", "pupils"));
    }

    public function pupilSearch(Request $request)
	{
	   	// Gets the query string from our form submission 
	    $query = Input::get('search');
	    // Returns an array of articles that have the query string located somewhere within 
	    // our articles titles. Paginates them so we can break up lots of search results.
	  	$pupils = Pupil::where('name', 'LIKE', '%' . $query . '%')->paginate(10);
	        
		// returns a view and passes the view the list of articles and the original query.
	    return view('results', compact('pupils', 'query'));
	 }

	 public function teacherSearch(Request $request)
	{
	   	// Gets the query string from our form submission 
	    $query = Input::get('search');
	    // Returns an array of articles that have the query string located somewhere within 
	    // our articles titles. Paginates them so we can break up lots of search results.
	  	$teachers = Teacher::where('name', 'LIKE', '%' . $query . '%')->paginate(10);
	        
		// returns a view and passes the view the list of articles and the original query.
	    return view('results', compact('teachers', 'query'));
	 }

	 public function parentSearch(Request $request)
	{
	   	// Gets the query string from our form submission 
	    $query = Input::get('search');
	    // Returns an array of articles that have the query string located somewhere within 
	    // our articles titles. Paginates them so we can break up lots of search results.
	  	$parents = Caregiver::where('name', 'LIKE', '%' . $query . '%')->paginate(10);
	        
		// returns a view and passes the view the list of articles and the original query.
	    return view('results', compact('parents', 'query'));
	 }

	 public function adminSearch(Request $request)
	{
	   	// Gets the query string from our form submission 
	    $query = Input::get('search');
	    // Returns an array of articles that have the query string located somewhere within 
	    // our articles titles. Paginates them so we can break up lots of search results.
	  	$admins = Admin::where('name', 'LIKE', '%' . $query . '%')->paginate(10);
	        
		// returns a view and passes the view the list of articles and the original query.
	    return view('results', compact('admins', 'query'));
	 }

	 public function classroomSearch(Request $request)
	{
	   	// Gets the query string from our form submission 
	    $query = Input::get('search');
	    // Returns an array of articles that have the query string located somewhere within 
	    // our articles titles. Paginates them so we can break up lots of search results.
	  	$classrooms = Classroom::where('name', 'LIKE', '%' . $query . '%')->paginate(10);
	        
		// returns a view and passes the view the list of articles and the original query.
	    return view('results', compact('classrooms', 'query'));
	 }

	public function showTeacher(Teacher $teacher)
    {
    	$teacher = Teacher::find($teacher->id);
    	$classrooms = Classroom::where("id", $teacher->classroom_id)->get();
    	return view('display', compact("teacher", "classrooms"));
    }

    public function showPupil(Pupil $pupil)
    {
    	$pupil = Pupil::find($pupil->id);
    	$user = User::find($pupil->user_id);
    	$classrooms = Classroom::where("id", $pupil->classroom_id)->get();
    	$files = $user->files()->get();
    	$parents = $pupil->caregivers()->get();
    	return view('display', compact("pupil", "files", "parents", "classrooms"));
    }

    public function showParent(Caregiver $parent)
    {
    	$parent = Caregiver::find($parent->id);
    	$children = $parent->children()->get();
    	return view('display', compact("parent", "children"));
    }

    public function showClassroom(Classroom $classroom)
    {
    	$classroom = Classroom::find($classroom->id);
    	$pupils = $classroom->pupils()->get();
    	$teachers = $classroom->teachers()->get();
    	return view('display', compact("classroom", "pupils", "teachers"));
    }

    public function showAdmin(Admin $admin)
    {
    	$admin = Admin::find($admin->id);
    	return view('display', compact("admin"));
    }

    public function updatePupil(Request $request, Pupil $pupil)
    {
    	$pupil->update($request->all());

    	flash("The Pupil Was Edited Successfully", "Success");

    	return back();
    }

     public function updateTeacher(Request $request, Teacher $teacher)
    {
    	$teacher->update($request->all());

    	flash("The Teacher Was Edited Successfully", "Success");

    	return back();
    }

     public function updateAdmin(Request $request, Admin $admin)
    {
    	$admin->update($request->all());

    	flash("The Admin Was Edited Successfully", "Success");

    	return back();
    }

     public function updateParent(Request $request, Caregiver $parent)
    {
    	$parent->update($request->all());

    	flash("The Parent Was Edited Successfully", "Success");

    	return back();
    }

    public function updateClassroom(Request $request, Classroom $classroom)
    {
    	$classroom->update($request->all());

    	flash("The Classroom Was Edited Successfully", "Success");

    	return back();
    }

    public function addClassroom(Request $request) 
    {
    	$this->validate($request, [
	    	'classroom' => 'required'
	    ]); 

	    $class = Classroom::create([
            'name' => $request->classroom,
        ]);

        if(!$class) {
        	flash("There Were Errors When Creating The New Classroom", "Fail");
        } else {
        	flash("The Classroom Was Created Successfully", "Success");
        }

        return back();
    }

    public function addRelationship(Request $request)
    {
    	
    	$this->validate($request, [
	    	'parent' => 'required',
	    	'pupil' => 'required'
	    ]); 

    	$relationship = DB::table('caregiver_pupil')->insert(
		    array('caregiver_id' => $request->parent,
		          'pupil_id' => $request->pupil)
		);

		if(!$relationship) {
        	flash("There Were Errors When Creating The New Relationship", "Fail");
        } else {
        	flash("The Relationship Was Created Successfully", "Success");
        }

        return back();
    }

    public function addUser(Request $request)
	{   
	    
	    $tagStringFirst = substr($request->name, 0, 2);
	    $tagString = strtoupper($tagStringFirst . substr($request->name, strpos($request->name, " ") + 1, 1));
	    
	    $dupilcateTag = Pupil::where("tag", 'LIKE', $tagString.'%')->orderBy('tag', 'desc')->first();

	    if ($dupilcateTag->count()) { 
	    	$tagNumbers = preg_replace("/[^0-9]/","",$dupilcateTag->tag);
	    	$tagNumbers++;
	    	$tag = $tagString . $tagNumbers;
	    }

	    $this->validate($request, [
	    	'name' => 'required',
	    	'email' => 'required|unique:users',
	    	'password' => 'required|min:6|same:password_confirmation',
	    	'password_confirmation' => 'required|min:6',
	    	'level' => 'required|exists:levels,name'

	    ]); 

	    $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
	    
	    $lastID = DB::getPdo()->lastInsertId();

	    

        if ($request->level == 'parent') {
        	Caregiver::create([
	            'user_id' => $lastID,
	            'name' => $request->name,
    		]);
        } elseif ($request->level == 'teacher') {
        	Teacher::create([
	            'user_id' => $lastID,
	            'name' => $request->name,
	            'classroom_id' =>$request->classroom,
    		]);
        } elseif ($request->level == 'admin') {
        	Admin::create([
	            'user_id' => $lastID,
	            'name' => $request->name,
    		]);
        } elseif ($request->level == 'pupil') {
        	Pupil::create([
	            'user_id' => $lastID,
	            'name' => $request->name,
	            'classroom_id' =>$request->classroom,
	            'tag' => $tag,
    		]);
        }

        if(!$newUser) {
        	flash("There Were Errors When Creating The New Account", "Fail");
        } else {
        	flash("The Account Was Created Successfully", "Success");
        }

        return back();
	}

	public function deleteTeacher(Teacher $teacher) {
		$teacher = Teacher::find($teacher->id);
		$teacher->delete();

		return back();
	}

	public function deleteClassroom(Classroom $classroom) {
		$classroom = Classroom::find($classroom->id);
		$classroom->delete();

		return back();
	}

	public function deleteAdmin(Admin $admin) {
		$admin = Admin::find($admin->id);
		$admin->delete();

		return back();
	}

	public function deleteParent(Parent $parent) {
		$parent = Parent::find($parent->id);
		$parent->delete();

		return back();
	}

	public function deletePupil(Pupil $pupil) {
		$pupil = Pupil::find($pupil->id);
		$pupil->delete();

		return back();
	}
}
