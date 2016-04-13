<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Caregiver;
use App\Http\Requests;

class ParentController extends Controller
{
    public function index(Request $request)
    {
        $children = Caregiver::where('user_id', $request->user()->id)->first();
        $children = $children->children()->get();
        return view('parent', compact("children"));
    }
}
