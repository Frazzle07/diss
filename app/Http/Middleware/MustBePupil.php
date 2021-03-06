<?php

namespace App\Http\Middleware;

use Closure;

class MustBePupil
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

        if ($user && ($user->level == 'pupil' || $user->level == 'admin')) {
            return $next($request);
        }

        abort(404, 'You Do Not Have Permission To View This Page.'); 
    }
}
