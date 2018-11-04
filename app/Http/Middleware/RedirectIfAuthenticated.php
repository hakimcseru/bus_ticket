<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        
        //$user->hasRole('owner'); 
        //dd(Auth::guard($guard)->check());

       // exit();
      if (Auth::guard($guard)->check()) {

           // $user_other_info = User::where('id',Auth::user()->id)->first();

           // dd(Auth::user()->id);
           // exit();
           // $this->auth->guest();
            return redirect('/dashboard');
        }

        // dd($request);


       // dd(Auth::user()->id);

        return $next($request);
    }
}
