<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{

    public function index($emp_id){

        return User::where('name',$emp_id)->select('role')->first();
    }
}

