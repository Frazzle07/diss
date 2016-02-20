<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class PagesController extends Controller
{
    public function homepage(){
    	//$files = DB::table('files')->get();
    	$files = \App\File::latest()->get();

    	return \view('landing', compact("files"));
    }
}
