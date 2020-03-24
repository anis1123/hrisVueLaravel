<?php

namespace App\Modules\Payslip\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Payslip\Entities\Payslip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use Illuminate\Contracts\Support\Jsonable;
use PhpParser\JsonDecoder;
use function GuzzleHttp\json_decode;
use Carbon\Carbon;


class PayslipController extends Controller
{

    public function employee($id){
//        $post=Payslip::all();
//        return $post;
              $post = Payslip::with('employee.department', 'employee.designation')->where('emp_id', $id)->get();
        return response()->json($post);
    }


      public function index(Request $request,$date=null)
       {
        if($date){
            $post = Payslip::with('employee.designation', 'employee.department')->where('salary_month',$date)->get();
            return $post;
        }
        else{
            $a = new Carbon('last month');
            $b =$a->format('Y-m');
            $post = Payslip::with('employee.designation', 'employee.department')->where('salary_month',$b)->get();
            return $post;
        }
    }

    public function checkexistingData($date){
           $data= Payslip::where('salary_month',$date)->get();
           if($data->isEmpty()){
            foreach (Payslip::all() as $key => $data) {
                $data['salary_date']=$date;
                $data['attendance']=null;
               Payslip::create($data->toArray());
            }
       }
    }

    public function get($id)
    {
//        $post=Payslip::where('emp_id',$id)->first();
//        echo $post;
        $post = Payslip::with('employee.department', 'employee.designation')->where('emp_id', $id)->first();
        return response()->json($post);

    }

    public function store(Request $req)
    {
try {
    $input = $req->all();
    $payslip = Payslip::create($input);
    $payslip['msg'] = 'Payslip stored successfully';
    $payslip['success_status'] = '1';
}
catch (\Exception $e){
    $payslip['error']=$e->getMessage();
    $payslip['msg'] = 'Payslip updated';
    $payslip['success_status'] = '0';
    return response()->json($payslip);
}
        return response()->json($payslip);

    }

}
