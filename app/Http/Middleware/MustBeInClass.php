<?php

namespace App\Http\Middleware;

use Closure;
use App\Teacher;
use App\File;
use App\Pupil;

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

        $classroom_id = Teacher::where('user_id', $user->id)->first()->classroom_id;
        $fileOwnerID = $request->route("user")->id;
        $fileOwner = Pupil::where('user_id', $fileOwnerID)->first()->classroom_id;
        
        if ($user && $user->level == 'teacher') {
            if ($classroom_id == $fileOwner){
                return $next($request);
            }
        }

        abort(404, 'You Do Not Have Permission To View This Page.'); 
    }
}
