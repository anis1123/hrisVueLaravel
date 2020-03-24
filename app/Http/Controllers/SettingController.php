<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EmployeeSetting;
use App\WorkType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function getEmpSetting(){
        $statement = DB::select("show table status like 'Employees'");
        $ids = $statement[0]->Auto_increment;
        $data['setting'] = EmployeeSetting::first();
        $setting = EmployeeSetting::first();
        $data['id'] =  $setting->prefix_alphabet . str_pad($ids,$setting->prefix_number, '0', STR_PAD_LEFT);
        return $data;
    }
    public function empSetting(Request $req){
        $data = EmployeeSetting::get();
        if($data->count() == 0){
            $post = new EmployeeSetting();
            $post->prefix_alphabet = $req->prefix_alphabet;
            $post->prefix_number = $req->prefix_number;
            $post->generate = $req->generate;
            $post->save();
        }else{
            $post = EmployeeSetting::first();
            $post->prefix_alphabet = $req->prefix_alphabet;
            $post->prefix_number = $req->prefix_number;
            $post->generate = $req->generate;
            $post->update();
            return response()->json('success');
        }
    }
    public function workType(Request $req){
        try {
            $post = new WorkType();
            $post->work_type = $req->work_type;
            $post->condition = $req->condition;
            $post->save();
            $res['msg'] = 'Work Type added successfully';
            $res['success_status'] = '1';
        }
        catch (\Exception $e){
            $res['error']=$e->getMessage();
            $res['msg'] = 'Work Type not added';
            $res['success_status'] = '0';
            return response()->json($res);
        }
        return response()->json($res);
    }
    public function getWorkType($id=null){
        if($id){
            $post =  WorkType::find($id);
            return $post;
        }else{
            return WorkType::get();
        }

    }
    public function editWorkType(Request $req,$id){
        try {
            $post = WorkType::find($id);
            $post->work_type = $req->work_type;
            $post->condition = $req->condition;
            $post->update();
            $res['msg'] = 'Work Type updated successfully';
            $res['success_status'] = '1';
        }catch (\Exception $e){
            $res['error']=$e->getMessage();
            $res['msg'] = 'Work Type not updated';
            $res['success_status'] = '0';
            return response()->json($res);
        }
        return response()->json($res);
    }
    public function deleteWorkType($id){
        workType::destroy($id);
        return response()->json('success');
    }
}
