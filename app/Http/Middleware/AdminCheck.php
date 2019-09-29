<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Blade;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        dd(auth()->user()->hasRole('school_admin'));
        if (auth()->user()->can('view admin panel')) {
            return $next($request);
        } else {
            return redirect('/home');
        }
    }
}
