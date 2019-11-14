<?php

namespace App\Http\Middleware;

use Closure;

class StudentCheck
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

        if (auth()->user()->can('view student panel')) {
            return $next($request);
        } else {
            return redirect('/admin');
        }
    }
}
