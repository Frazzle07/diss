<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ParentController extends Controller
{
    public function index()
    {
        return view('teacher');
    }
}
