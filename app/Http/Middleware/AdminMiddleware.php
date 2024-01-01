<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check())
        {
            //admin roll==1
            //user roll==0
               if(Auth::user()->role=='1')
               {
                return $next($request);

               }
               else{
                  return redirect('/')->with('message', 'Access denied as you are not Admin!');
               }
        }
        else{
            return redirect('login')->with('message', 'Access denied as you are not Admin!');

        }
        return $next($request);

    }
}
