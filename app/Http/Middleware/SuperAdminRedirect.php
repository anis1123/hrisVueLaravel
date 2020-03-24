<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperAdminRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        if (auth()->user()->issuper_admin == 1) {
            return $next($request);
        }
        return redirect('admin-login')->with('error', 'You have not admin access');
    }
}
