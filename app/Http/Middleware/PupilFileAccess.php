<?php

namespace App\Http\Middleware;

use Closure;
use App\Teacher;
use App\File;
use App\Pupil;
use App\Caregiver;
use DB;

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
        } else if ($user->level == "parent"){
            $parentID = Caregiver::where('user_id', $user->id)->first()->id;
            $relationship = DB::table('caregiver_pupil')->where('caregiver_id', $parentID)->get();
            foreach ($relationship as $relation) {
                $pupilID = Pupil::where('id', $relation->pupil_id)->first()->user_id;
                if ($pupilID == $request->route("file")->user_id){
                    return $next($request);
                }
            }
        }

        abort(404, 'You Do Not Have Permission To View This Page.'); 
    }
}
