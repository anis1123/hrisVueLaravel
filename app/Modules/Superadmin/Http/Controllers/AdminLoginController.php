<?php

namespace App\Modules\Superadmin\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class AdminLoginController extends Controller

{

    /*

    |--------------------------------------------------------------------------

    | Login Controller

    |--------------------------------------------------------------------------

    |

    | This controller handles authenticating users for the application and

    | redirecting them to your home screen. The controller uses a trait

    | to conveniently provide its functionality to your applications.

    |

    */


    use AuthenticatesUsers;


    protected $guard = 'super-admin';


    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/super-admin/dashboard';


    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()

    {

        $this->middleware('guest')->except('logout');
        $this->middleware('guest:super-admin')->except('logout');
//        $this->middleware('guest:writer')->except('logout');

    }


    public function showLoginForm()

    {

        return view('superadmin::adminLogin');

    }


    public function login(Request $request)

    {

        if (auth()->guard('super-admin')->attempt(['email' => $request->email, 'password' => $request->password,
            'super_admin' => 1])) {
            toastr()->success('Welcome Super Admin!! You have logged in successfully');
            return redirect('super-admin/dashboard');
        }


        return back()->withErrors(['email' => 'Email or password are wrong.']);

    }

}
