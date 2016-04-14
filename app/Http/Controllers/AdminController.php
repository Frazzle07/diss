<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;

use App\Http\Requests;
use App\Pupil;
use App\Teacher;
use App\Caregiver;
use App\User;

class AdminController extends Controller
{
    public function index()
    {
    	return view('admin');
    }

    public function pupilSearch(Request $request)
	{
	   	// Gets the query string from our form submission 
	    $query = Request::input('search');
	    // Returns an array of articles that have the query string located somewhere within 
	    // our articles titles. Paginates them so we can break up lots of search results.
	  	$pupils = Pupil::where('name', 'LIKE', '%' . $query . '%')->paginate(10);
	        
		// returns a view and passes the view the list of articles and the original query.
	    return view('results', compact('pupils', 'query'));
	 }

	 public function teacherSearch(Request $request)
	{
	   	// Gets the query string from our form submission 
	    $query = Request::input('search');
	    // Returns an array of articles that have the query string located somewhere within 
	    // our articles titles. Paginates them so we can break up lots of search results.
	  	$teachers = Teacher::where('name', 'LIKE', '%' . $query . '%')->paginate(10);
	        
		// returns a view and passes the view the list of articles and the original query.
	    return view('results', compact('teachers', 'query'));
	 }

	 public function parentSearch(Request $request)
	{
	   	// Gets the query string from our form submission 
	    $query = Request::input('search');
	    // Returns an array of articles that have the query string located somewhere within 
	    // our articles titles. Paginates them so we can break up lots of search results.
	  	$parents = Caregiver::where('name', 'LIKE', '%' . $query . '%')->paginate(10);
	        
		// returns a view and passes the view the list of articles and the original query.
	    return view('results', compact('parents', 'query'));
	 }

	 /*public function adminSearch(Request $request)
	{
	   	// Gets the query string from our form submission 
	    $query = Request::input('search');
	    // Returns an array of articles that have the query string located somewhere within 
	    // our articles titles. Paginates them so we can break up lots of search results.
	  	$admins = Admin::where('name', 'LIKE', '%' . $query . '%')->paginate(10);
	        
		// returns a view and passes the view the list of articles and the original query.
	    return view('results', compact('admins', 'query'));
	 }*/

	public function showTeacher(Teacher $teacher)
    {
    	$teacher = Teacher::find($teacher->id)->first();
    	return view('display', compact("teacher"));
    }

    public function showPupil(Pupil $pupil)
    {
    	$pupil = Pupil::find($pupil->id)->first();
    	$user = User::find($pupil->user_id);
    	$files = $user->files()->get();
    	return view('display', compact("pupil", "files"));
    }

    public function showParent(Caregiver $parent)
    {
    	$parent = Caregiver::find($parent->id)->first();
    	$children = $parent->children()->get();
    	return view('display', compact("parent", "children"));
    }

    /*public function showAdmin(Teacher $teacher)
    {
    	$teacher = Teacher::find($teacher->id)->first();
    	return view('display', compact("teacher"));
    }*/
}
