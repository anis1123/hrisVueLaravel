<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Schedule;

class ScheduleController extends Controller
{
    public function index(){
        return response()->json(Schedule::get());
    }

    public function post(Request $req, $id){
try {
    $post = new Schedule();
    $post->title = $req->title;
    $post->start_date = $req->start_date;
    $post->start_time = $req->start_time;
    $post->end_date = $req->end_date;
    $post->end_time = $req->end_time;
    $post->posted_by = $id;
    $post->save();
    $post['msg'] = 'Schedule added successfully';
    $post['success_status'] = '1';
}catch (\Exception $e){
    $post['error']=$e->getMessage();
    $post['msg'] = 'Schedule not added';
    $post['success_status'] = '0';
    return response()->json($post);
}
        return response()->json($post);
    }
}
