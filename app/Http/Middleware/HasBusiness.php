<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasBusiness
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!auth()->user()->business){
            return redirect()->route('setting');
        }
        return $next($request);
    }
}
