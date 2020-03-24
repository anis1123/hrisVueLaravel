<?php

namespace App\Http\Controllers;
use App\Events\LeaveNotif;
use Illuminate\Http\Request;
use App\Loan;
use App\notification;
class LoanController extends Controller
{
    public function post(Request $req){
try {
    $input = $req->all();
    $input['remaining_amount']=$req->loan_amount;
    Loan::create($input);
    $res['msg'] = 'Loan applied successfully';
    $res['success_status'] = '0';

}
catch (\Exception $e){
    $res['error']=$e->getMessage();
    $res['msg'] = 'Loan not submitted';
    $res['success_status'] = '0';
    return response()->json($res);
}
        return response()->json($res);
    }

    public function notify(Request $req,$id){

        $post = new notification();
        $post->notification = 'New Loan Notification';
        $post->to = $id;
        $post->from = $id;
        $post->save();
        event(new LeaveNotif($post));
    }

    public function get($id=null){
        if($id){
            return Loan::with('loantypes')->where('emp_id',$id)->get();
        }
        else{
            return Loan::with('loantypes')->get();
        }
    }
    public function edit($id){
        return Loan::where('id',$id)->first();
    }
    public  function edit_post(Request $req , $id){
        try {
            $loan = Loan::find($id);
            $input=$req->all();
            $loan->update($input);
            $res['msg'] = 'Loan details updated successfully';
            $res['success_status'] = '1';

        }catch (\Exception $e){
            $res['error']=$e->getMessage();
            $res['msg'] = 'Loan details not updated';
            $res['success_status'] = '0';
            return response()->json($res);
        }
        return response()->json($res);
    }
}
