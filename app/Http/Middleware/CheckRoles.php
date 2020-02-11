<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (auth()->user()->hasRoles($role)) {
            return $next($request);
        }else{
            $user = Auth::user();
            return redirect()->route('Dashboard')->with('user');
        }
    }
}
