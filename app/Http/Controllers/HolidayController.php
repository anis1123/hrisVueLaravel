<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Holiday;

class HolidayController extends Controller
{
    public function index(){
       $data = Holiday::get();
        return $data;
    }

    public function post(Request $req , $id){
        try {
           Holiday::create($req->all());
           $holiday['msg']='Holiday added successfully';
           $holiday['status']='1';
        }
        catch (\Exception $e){
            $holiday['error']=$e->getMessage();
            $holiday['msg'] = 'Holiday not added';
            $holiday['status'] = '0';
            return response()->json($holiday);
        }
        return response()->json($holiday);
    }
}
