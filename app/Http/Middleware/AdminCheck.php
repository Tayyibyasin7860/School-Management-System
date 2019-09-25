<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Spatie\Permission\Models\Role;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        die;
            if(auth()->user()->hasRole('school_admin')){
                dd('school admin');
                return redirect('/admin');
            }

        else{
            dd('student');
            return $next($request);

        }
    }
}
