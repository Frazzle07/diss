<?php

namespace App\Http\Middleware;

use Closure;

class MustBeParent
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

        if ($user && ($user->level == 'parent' || $user->level =='admin')) {
            return $next($request);
        }

        abort(404, 'You Do Not Have Permission To View This Page.');  
    }
}
