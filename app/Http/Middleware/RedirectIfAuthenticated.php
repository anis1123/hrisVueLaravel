<?php

namespace App\Http\Middleware;

use App\Modules\Superadmin\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'web')
    {


        if (Auth::guard($guard)->check()) {

                return redirect('/admin/dashboard');
            }


                return $next($request);
//        if (Auth::guard($guard)->check('super_admin' == 1)) {
//
//            return redirect('login')->with('error', 'You have not admin access');
//        }
//        return $next($request);
//        if (Auth::guard($guard)->check()) {
//            if ($guard === 'super-admin') {
//                return redirect('super-admin/dashboard');
//            }
//            return redirect()->route('/home');
//        }
//
//        return $next($request);


        }

}

