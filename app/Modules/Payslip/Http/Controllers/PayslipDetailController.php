<?php

namespace App\Modules\Payslip\Http\Controllers;

use App\Attendance;
use App\Cal;
use App\Holiday;
use App\Http\Controllers\Controller;
use App\Modules\Employee\Entities\Employee;
use App\Modules\Payslip\Entities\PayslipDetails;
use Carbon\Carbon;
use Fivedots\NepaliCalendar\Calendar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PayslipDetailController extends Controller
{
    public function get()
    {
        $payrolls = PayslipDetails::where('status', 1)->get();
        return response()->json($payrolls);
    }

    public function show($id)
    {
        $payrolls = PayslipDetails::where('status', 1)->where('id', $id)->first();
        $employee=Employee::where('emp_id',$payrolls->emp_id)->first();



        $payrolls['full_name']=ucfirst($employee->first_name).' '.ucfirst($employee->middle_name).' '.ucfirst($employee->last_name);
        $payrolls['basic_salary']=get_basic_salary($employee->emp_id);
        $payrolls['department']=$employee->department->name;
        $payrolls['marital_status']=$employee->marital_status;
        return response()->json($payrolls);
    }

    public function store(Request $request)
    {
        try {
            $input = $request->all();
            $date = Carbon::now();
//        echo $date->format('F'); // July
            $next = $date->startOfMonth()->subMonth()->format('m-Y');

            $working = count(Cal::where('holiday_status', 0)->where('date', '=', $next)->get());
            $attendance = count(Attendance::where('emp_id', $request->emp_id)->where('present_status', 1)->
            where('date', '=', $next)->get());
            $input['attendance'] = $attendance;
            $input['total_working_days'] = $working;
            if ($request->adjustment == null || $request->adjustment == '') {
                $input['adjustment'] = 0;
            } else {
                $input['adjustment'] = $request->adjustment;
            }
            $payslip = PayslipDetails::create($input);
            $payslip['msg'] = 'Payslip Details stored successfully';
            $payslip['success_status'] = '1';

        }
        catch (\Exception $e){
            $payslip['error']=$e->getMessage();
            $payslip['msg'] = 'Payslip Details not stored';
            $payslip['success_status'] = '0';
            return response()->json($payslip);
        }
        return response()->json($payslip);
    }

    public function edit(Request $req, $id)
    {
        try {
            $data = PayslipDetails::where('status', 1)->where('id', $id)->first();
            if ($req->da) {
                $data->da = $req->da;
            }
            if ($req->basic_salary) {
                $data->basic_salary = $req->basic_salary;

            }
            if ($req->cit_no) {
                $data->cit_no = $req->cit_no;

            }
            if ($req->pf_no) {
                $data->pf_no = $req->pf_no;

            }
            if ($req->ssf_no) {
                $data->ssf_no = $req->ssf_no;

            }
            if ($req->emp_id) {
                $data->emp_id = $req->emp_id;

            }
            if ($req->adjustment) {
                $data->adjustment = $req->adjustment;

            }

            //            if($req->attendence){
//            $data->attendence = $req->attendence;
//
//            }


            $data->update();
            $data['msg'] = 'Payslip Details updated successfully';
            $data['success_status'] = '1';
        }
        catch (\Exception $e){
            $data['error']=$e->getMessage();
            $data['msg'] = 'Payslip Details not updated';
            $data['success_status'] = '0';
            return response()->json($data);
        }
        return response()->json($data);


    }

    public function destroy($id)
    {
        $payslip = PayslipDetails::find($id);
        $payslip->status = 0;
        $payslip->save();
        return response()->json('deleted');
    }
}
