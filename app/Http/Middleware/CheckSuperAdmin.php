<?php

namespace App\Http\Middleware;
use App\Traits\SuperAdmin;
use Closure;

class CheckSuperAdmin
{
    use SuperAdmin;
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($this->isSuperadmin())
        {
            return back();
        }
        return $next($request);
    }

}
