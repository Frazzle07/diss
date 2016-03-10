<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'AuthController@test');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/', 'HomeController@index');

    Route::get('logout', function(){
    	Auth::logout(); // logout user
  		return Redirect::to('login'); //redirect back to login
	})->middleware('auth');

    
    Route::get('admin', 'AdminController@index')->middleware('admin');

    Route::get('teacher', 'TeacherController@index')->middleware('teacher');

    Route::get('parent', 'ParentController@index')->middleware('parent');


    Route::get('landing', 'PupilController@showFiles')->middleware('pupil');
    Route::post('/upload/{user}',[
	    'as' => 'pupil.file.upload',
	    'uses' => 'PupilController@uploadFile'
	])->middleware('pupil');    
    Route::get('download/{file}', 'PupilController@downloadFile')->middleware('pupil');
});
