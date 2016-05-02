<?php

namespace App\Http\Middleware;

use Closure;
use App\Teacher;
use App\File;
use App\Pupil;
use App\Caregiver;
use DB;

class MustBeInClass
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

        
        if ($user && $user->level == 'teacher') {
            $classroom_id = Teacher::where('user_id', $user->id)->first()->classroom_id;
            $fileOwnerID = $request->route("user")->id;
            $fileOwner = Pupil::where('user_id', $fileOwnerID)->first()->classroom_id;
            if ($classroom_id == $fileOwner){
                return $next($request);
            }
        } else if($user && $user->level == 'parent'){
            $parentID = Caregiver::where('user_id', $user->id)->first()->id;
            $relationship = DB::table('caregiver_pupil')->where('caregiver_id', $parentID)->get();
            foreach ($relationship as $relation) {
                $pupilID = Pupil::where('id', $relation->pupil_id)->first()->user_id;
                if ($pupilID == $request->route("user")->id){
                    return $next($request);
                }
            }
        }

        abort(404, 'You Do Not Have Permission To View This Page.'); 
    }
}
