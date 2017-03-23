<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotAuthorized
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
        if(Auth::guest() || 
            (!\Auth::user()->hasRole('admin') && !\Auth::user()->hasRole('supervisor'))
        ){
            return redirect('/home')->with('msg', 'You are not authorized!');
        }
        
        return $next($request);
    }
}
