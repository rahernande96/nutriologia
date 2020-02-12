<?php

namespace App\Http\Middleware;

use Closure;

class Subscribed
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
        if ($request->user()->role_id == 2) {

            if ($request->user() && ! $request->user()->subscribed('main')) {
                // This user is not a paying customer...
                return redirect()->route('config');
            }
            
        }

        return $next($request);
    }
}
