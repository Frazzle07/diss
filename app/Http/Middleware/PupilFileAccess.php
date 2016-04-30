<?php

namespace App\Http\Middleware;

use Closure;
use App\Teacher;
use App\File;
use App\Pupil;

class PupilFileAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        if ($user->level == 'teacher'){
            $classroom_id = Teacher::where('user_id', $user->id)->first()->classroom_id;
            $fileOwnerID = $request->route("file")->user_id;
            $fileOwnerUser = File::where('id', $fileOwnerID)->first()->user()->first();
            dd($fileOwnerUser);
            $fileOwner = Pupil::where('user_id', $fileOwnerUser->id)->first()->classroom_id;
        }
        
        if ($user && ($user->level == 'pupil' || $user->level == 'admin' || ($user->level == 'teacher' && $classroom_id == $fileOwner))) {
            return $next($request);
        }

        abort(404, 'You Do Not Have Permission To View This Page.'); 
    }
}
