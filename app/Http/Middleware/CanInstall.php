<?php

namespace App\Http\Middleware;

use Closure;

class CanInstall
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
        if(config('app.install',false) == true){
            return $next($request);
        }
        return redirect('/installation');
    }
}