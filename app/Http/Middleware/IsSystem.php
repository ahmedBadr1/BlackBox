<?php

namespace App\Http\Middleware;

use App\Models\System;
use Closure;
use Illuminate\Http\Request;

class IsSystem
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
        if (auth()->user()->hasRole(['seller','delivery'])){
            abort(404);
        }
        if(System::first() === null){
            return redirect()->route('admin.system.index');
        }


        return $next($request);
    }
}
