<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     *  @param  string  $usr_role
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $usr_role)
    {
        
        // if(auth()->user()->usr_role == $usr_role){
        //     return $next($request);
        // }
        // return redirect('');

        if(auth()->user() && auth()->user()->usr_role == $usr_role){
            return $next($request);
        }
        
        return redirect('');
    }
}
