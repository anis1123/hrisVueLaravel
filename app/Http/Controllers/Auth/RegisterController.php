<?php

namespace App\Http\Controllers\Auth;


use Mail;
use App\Mail\verifyEmail;
use Illuminate\Support\Str;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Session;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [

            'name' => ['required', 'string', 'max:255','unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),

            // 'role'=>$data['role']
        ]);

        // $thisUser = User::findOrfail($user->id);
        // $this->sendEmail($thisUser);



    }
    // public function verifyEmailFirst(){
    //     return response()->json('verifyEmailFirst');
    // }

    // public function sendEmail($thisUser){
    //     Mail::to($thisUser['email'])->send(new verifyEmail($thisUser));
    // }

    // public function sendEmailDone($email,$verifyToken){
    //     $user = User::where(['email'=>$email,'verifyToken'=>$verifyToken])->first();

    //    if($user){
    //        user::where(['email'=>$email,'verifyToken'=>$verifyToken])->update(['status'=>'1','verifyToken'=>null]);
    //        return response()->json('Success Go to Login!!');
    //    }else{
    //        return 'user not found';
    //    }
    // }
}
