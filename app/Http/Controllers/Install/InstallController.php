<?php

namespace App\Http\Controllers\Install;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Utilities\Installer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class InstallController extends Controller
{

    public function __construct()
    {
        if(env('APP_INSTALLED',false) == true) {
            Redirect::to('/login')->send();
        }

    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('install.step_1');
    }

    public function database()
    {
        return view('install.step_2');
    }

    /**
     * @param Request $request
     * @return string
     */
    public function process_install(Request $request)
    {
        $host = $request->hostname;
        $database = $request->database;
        $username = $request->username;
        $password = $request->password;



// Create connection
//        $conn = new mysqli($host, $username, $password);
//// Check connection
//        if ($conn->connect_error) {
//            die("Connection failed: " . $conn->connect_error);
//        }
//        // Create database
//        $sql = "CREATE DATABASE ".$database;
//        if ($conn->query($sql) === TRUE) {
//            echo "Database created successfully";
//        } else {
//            return redirect()->back()->with("error","Error!!! Database Name Already Exists!");
//        }
//        $conn->close();

        if(Installer::createDbTables($host, $database, $username, $password) == false){
            return redirect()->back()->with("error","Invalid Database Settings !");
        }

        return redirect('install/system_settings');
    }



    public function system_settings()
    {
        return view('install.step_4');
    }

    public function final_touch(Request $request)
    {
        Installer::updateSettings($request->short_name,$request->all());

        Installer::finalTouches();
        return redirect(route('login'));
    }
}
