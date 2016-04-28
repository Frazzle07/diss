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
    Route::get('/pupil/{user}', 'TeacherController@showPupilFiles')->middleware('class');

    Route::get('parent', 'ParentController@index')->middleware('parent');


    Route::get('landing', 'PupilController@showFiles')->middleware('pupil');
    Route::post('/upload/{user}',[
	    'as' => 'pupil.file.upload',
	    'uses' => 'PupilController@uploadFile'
	])->middleware('pupil');

    Route::get('mark/{file}', 'PupilController@markFile')->middleware('pupil');

     

    Route::get('download/{file}', 'PupilController@downloadFile')->middleware('public');
    Route::get('delete/{file}', 'PupilController@deleteFile')->middleware('pupil');

    Route::patch('pupil/{pupil}', 'AdminController@updatePupil')->middleware('admin');
    Route::patch('teacher/{teacher}', 'AdminController@updateTeacher')->middleware('admin');
    Route::patch('admin/{admin}', 'AdminController@updateAdmin')->middleware('admin');
    Route::patch('parent/{parent}', 'AdminController@updateParent')->middleware('admin');
    Route::patch('classroom/{classroom}', 'AdminController@updateClassroom')->middleware('admin');
    Route::post('adduser', 'AdminController@addUser')->middleware('admin');
    Route::post('addclassroom', 'AdminController@addClassroom')->middleware('admin');

    Route::any('/search/pupils',[
        'as' => 'pupil.search',
        'uses' => 'AdminController@pupilSearch'
    ])->middleware('admin');  

    Route::any('/search/teachers',[
        'as' => 'teacher.search',
        'uses' => 'AdminController@teacherSearch'
    ])->middleware('admin');  

    Route::any('/search/admins',[
        'as' => 'admin.search',
        'uses' => 'AdminController@adminSearch'
    ])->middleware('admin');

    Route::any('/search/parents',[
        'as' => 'parent.search',
        'uses' => 'AdminController@parentSearch'
    ])->middleware('admin');

    Route::any('/search/classrooms',[
        'as' => 'classroom.search',
        'uses' => 'AdminController@classroomSearch'
    ])->middleware('admin');  

    Route::get('/search/teacher/{teacher}', 'AdminController@showTeacher')->middleware('admin'); 
    Route::get('/search/pupil/{pupil}', 'AdminController@showPupil')->middleware('admin'); 
    Route::get('/search/parent/{parent}', 'AdminController@showParent')->middleware('admin'); 
    Route::get('/search/classroom/{classroom}', 'AdminController@showClassroom')->middleware('admin'); 
    Route::get('/search/admin/{admin}', 'AdminController@showAdmin')->middleware('admin');

    
    Route::delete('/delete/{id}', 'AdminController@deleteUser')->middleware('admin');

    Route::delete('/delete/teacher/{teacher}', 'AdminController@deleteTeacher')->middleware('admin'); 
    Route::delete('/delete/pupil/{pupil}', 'AdminController@deletePupil')->middleware('admin'); 
    Route::delete('/delete/classroom/{classroom}', 'AdminController@deleteClassroom')->middleware('admin'); 
    Route::delete('/delete/parent/{parent}', 'AdminController@deleteParent')->middleware('admin'); 
    Route::delete('/delete/admin/{admin}', 'AdminController@deleteAdmin')->middleware('admin'); 

});
