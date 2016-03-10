<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()) {
            if (Auth::user()->level == 'admin'){
                return redirect('admin');
            } else if(Auth::user()->level == 'teacher'){
                return redirect('teacher');
            } else if(Auth::user()->level == 'parent'){
                return redirect('parent');
            } else if(Auth::user()->level == 'pupil'){
                return redirect('landing');
            }
        } else {
            return view('home');
        }
    }
}
