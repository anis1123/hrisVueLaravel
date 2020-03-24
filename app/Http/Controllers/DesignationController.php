<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Designation;
use App\SubDepartmentDes;

class DesignationController extends Controller
{
    public function store(Request $req){
        try {
            $input=$req->all();
            Designation::create($input);
            $res['msg'] = 'Designation stored successfully';
            $res['success_status'] = '1';
        }
        catch (\Exception $e){
            $res['error'] =$e->getMessage();
            $res['msg'] = 'Designation not stored';
            $res['success_status'] = '0';
            return response()->json($res);
        }
        return response()->json($res);

    }


    public function only($id = null){
        if($id){
        $post = DB::table('designations')->select('designation_title','designation_id')->where('department_id',$id)->get();
        return response()->json($post);
        }
        else{
            $post = DB::table('designations')->get();
            return $post;
        }
    }

    public function get(){
       $designations=Designation::with('department')->get();
        return response()->json($designations);
    }

    public function subDepartmentDes(Request $req){
        $post = new SubDepartmentDes();
        $post->subdep_id = $req->subdepartment_id;
        $post->title = $req->title;
        $post->save();
    }
}
