<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Department;
use App\SubDepartment;

class DepartmentController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('permission:permission-list');
//    }

    public function store(Request $req)
    {
        try {
            $input = $req->all();
            Department::create($input);
            $res['msg'] = 'Department stored successfully';
            $res['success_status'] = '1';
        } catch (\Exception $e) {
            $res['error']=$e->getMessage();
            $res['msg'] = 'Department not stored';
            $res['success_status'] = '0';
            return response()->json($res);
        }
        return response()->json($res);

    }

    public function department()
    {

        $post = DB::table('departments')->get();
        //$post = DB::table('departments')->get();
        return response()->json($post);

    }

    public function get()
    {
        $datas = Department::with('childs', 'subDepartment.subDepDes')->get();
        return response()->json(['datas' => $datas]);

    }

    public function getSubDep()
    {
        return SubDepartment::get();
    }

    public function subDepartment(Request $req)
    {
        try {
            $post = new SubDepartment();
            $post->department_id = $req->departments;
            $post->title = $req->subDepartment;
            $post->save();
            $res['msg'] = 'Sub-Department added successfully';
            $res['success_status'] = '0';
        }
        catch (\Exception $e){
            $res['error']=$e->getMessage();
            $res['msg'] = 'Sub-Department not added';
            $res['success_status'] = '0';
            return response()->json($res);
        }
        return response()->json($res);
    }
}
