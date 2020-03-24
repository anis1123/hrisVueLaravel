<?php


namespace App\Http\Controllers;

use App\Events\NotificationMsg;
use App\Events\LeaveNotif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Leave;
use App\Msg;
use App\notification;

class LeaveController extends Controller
{
    public function index(Request $req, $id)
    {
        try {
            Leave::create($req->all());
            $this->notify($req, $id);
            $res['msg'] = 'Leave submitted successfully';
            $res['success_status'] = '1';
        } catch (\Exception $e) {
            $res['error'] = $e->getMessage();
            $res['msg'] = 'Leave not submitted';
            $res['success_status'] = '0';
            return response()->json($res);
        }
        return response()->json($res);

    }

    public function notify(Request $req, $id)
    {

        $post = new notification();
        $post->notification = 'New Leave Notification';
        $post->to = $req->leave_from;
        $post->from = $id;
        $post->save();
        event(new LeaveNotif($post));
    }

    public function get_leave_notif()
    {
        return response()->json(notification::join('employees', 'notifications.from', '=', 'employees.emp_id')
            ->select('notifications.*', 'employees.first_name', 'employees.middle_name', 'employees.last_name')
            ->where('status', 0)->get());
    }

    public function status($id)
    {
        DB::table('notifications')->where('id', $id)->update(['status' => 1]);
        $data['id'] = $id;
        $data['msg'] = notification::find($id);
        return response()->json($data);
    }

    public function get($id = null)
    {
        if ($id) {
            $data = Leave::where('emp_id', $id)->get();
            return $data;
        } else {
            $data = Leave::join('employees', 'leaves.emp_id', '=', 'employees.emp_id')->select('employees.first_name',
                'employees.middle_name', 'employees.last_name', 'leaves.*')->get();
            return $data;
        }
    }

    public function getleaveId($id)
    {
        $data = Leave::find($id);
        return $data;
    }

    public function edit(Request $res, $id)
    {
        try {
            $leave = Leave::where('id', $id)->first();

            $app_status = $res->app_status;
            $leave->update(['app_status' => $app_status]);
            $res['msg'] = 'Leave submitted successfully';
            $res['success_status'] = '1';
        } catch (\Exception $e) {
            $res['error'] = $e->getMessage();
            $res['msg'] = 'Leave not submitted';
            $res['success_status'] = '0';
            return response()->json($res);
        }
        return response()->json($res);
    }

    public function delete($id)
    {
        Leave::destroy($id);
        return response()->json('Success');
    }

    public function test(Request $req)
    {
        $post = new Msg;
        $post->user_id = $req->user;
        $post->message = $req->msg;
        $post->send_to = $req->send_to;
        $post->save();
        event(new NotificationMsg($post));
    }

    public function get_msg()
    {
        return Msg::join('employees', 'msgs.send_to', 'employees.emp_id')->get();
    }
}




