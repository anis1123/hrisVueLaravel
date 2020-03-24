<?php

namespace App\Modules\Employee\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Modules\Employee\Entities\Employee;
use App\Modules\Payslip\Entities\Payslip;
use App\SalaryHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\User;
use App\Department;
use App\Designation;
use App\Leave;


class EmployeeController extends Controller
{
    public function information($id = null)
    {

        if ($id) {
            $data['total_emp'] = Employee::get()->count();
            $data['registered_emp'] = User::get()->count();
            $data['designation'] = Designation::get()->count();
            $data['department'] = Department::get()->count();
            $data['married'] = Employee::where('marital_status', 'M')->get()->count();
            $data['unmarried'] = Employee::where('marital_status', 'UM')->get()->count();
            $data['male'] = Employee::where('gender', 'male')->get()->count();
            $data['female'] = Employee::where('gender', 'female')->get()->count();
            $data['leave'] = Leave::where('emp_id', $id)->get()->count();
            $data['payslip'] = Payslip::where('emp_id', $id)->get()->count();
            $data['payslip_r'] = Payslip::where('emp_id', $id)->orderBy('id')->first();

            return $data;
        } else {
            $data['total_emp'] = Employee::get()->count();
            $data['registered_emp'] = User::get()->count();
            $data['designation'] = Designation::get()->count();
            $data['department'] = Department::get()->count();
            $data['married'] = Employee::where('marital_status', 'M')->get()->count();
            $data['unmarried'] = Employee::where('marital_status', 'UM')->get()->count();
            $data['male'] = Employee::where('gender', 'male')->get()->count();
            $data['female'] = Employee::where('gender', 'female')->get()->count();
            return $data;
        }
    }

    public function designation()
    {

        $department = DB::table('departments')->get();
        $designation = DB::table('designations')->get();
        $data = [];
        $a = [];
        foreach ($department as $dep) {
            $desi = [];

            $a[] = $dep;

            foreach ($designation as $des) {

                if ($dep->id == $des->department_id) {


                    $desi[] = [$des->name, $des->id];
                }

            }
            $data[] = array(
                'department' => $dep->name,
                'id' => $dep->id,
                'designation' => $desi,
            );
        }


        return response()->json($data);
    }

    public function department()
    {
        $post = DB::table('departments')->get();
        return response()->json($post);
    }

    public function get()
    {
        $post = Employee::with('payslip', 'department', 'designation')->get();

        return response()->json($post);
    }

    public function edit($id)
    {
        $post = Employee::with('department', 'designation')->where('id', $id)->first();
        return response()->json($post);

    }

    public function delete($id)
    {

        Employee::destroy($id);

        return "deleted!!";
    }

    public function upload(Request $request)
    {
        // return response()->json($product);

        if ($request->hasFile('image')) {
            $imagename = $request->image->getClientOriginalName();
            $request->image->storeAs('public', $imagename);

            return response(null, 202);


        }


    }

    public function usersid_android($id)
    {

        if (DB::table('users')->where('name', $id)->exists()) {
            $user = DB::table('users')->where('name', $id)->first();
            if ($user->role == 0) {

                $response['user'] = $user->name;
                $response['success'] = 1;
                $response['msg'] = 'success';

                return response()->json($response);

            } else {
                $response['user'] = $user;
                $response['success'] = 0;

                return response()->json($response);
            }

        } else {

            $response['success'] = 0;
            $response['msg'] = 'failed';

            return response()->json($response);
        }
    }


    public function checklogin(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            $response['msg'] = 'success';
            $response['status'] = '1';
            return response()->json($response);
        } else {
            $response['msg'] = 'failed';
            $response['status'] = '0';
            return response()->json($response);
        }

    }


    public function formSubmit(Request $request)
    {
        $imageName = time() . '.' . $request->resume->getClientOriginalExtension();
        $request->resume->move(public_path('resume'), $imageName);
        return response()->json(['success' => 'You have successfully uploaded image.']);
    }

    public function offerletter(Request $request)
    {
        $imageName = time() . '.' . $request->offer->getClientOriginalExtension();
        $request->offer->move(public_path('offerletter'), $imageName);

        return response()->json(['success' => 'You have successfully uploaded image.']);
    }

    public function joiningletter(Request $request)
    {
        $imageName = time() . '.' . $request->joining->getClientOriginalExtension();
        $request->joining->move(public_path('joining'), $imageName);

        return response()->json(['success' => 'You have successfully uploaded image.']);
    }

    public function contract(Request $request)
    {
        $imageName = time() . '.' . $request->contract->getClientOriginalExtension();
        $request->contract->move(public_path('contract'), $imageName);

        return response()->json(['success' => 'You have successfully uploaded image.']);
    }

    public function idproof(Request $request)
    {
        $imageName = time() . '.' . $request->id->getClientOriginalExtension();
        $request->id->move(public_path('idproof'), $imageName);

        return response()->json(['success' => 'You have successfully uploaded image.']);
    }

    public function otherdocument(Request $request)
    {
        $imageName = time() . '.' . $request->other->getClientOriginalExtension();
        $request->other->move(public_path('otherdocument'), $imageName);

        return response()->json(['success' => 'You have successfully uploaded image.']);
    }


    public function store(Request $req)
    {
        try {
            $input = $req->all();
            $employee = Employee::create($input);
            $employee['msg'] = 'Employee Details added successfully';
            $employee['success_status'] = '1';
        }
        catch (\Exception $e){
            $employee['error']=$e->getMessage();
            $employee['msg'] = 'Employee Details not added';
            $employee['success_status'] = '0';
            return response()->json($employee);
        }
        return response()->json($employee);
    }

    public function update(Request $req, $id)
    {
        try {
            $employee = Employee::find($id);
            if ($req->level_id != null) {
                if ($employee->level_id != $req->level_id) {
                    $salary = new SalaryHistory();
                    $salary->emp_id = $id;
                    $salary->level_id = $req->level_id;
                    $salary->date = date('m/d/Y');
                    $salary->save();
                }
            }
            $input = $req->all();
            $employee->update($input);
            $employee['msg'] = 'Employee Details updated successfully';
            $employee['success_status'] = '1';
        }
        catch (\Exception $e){
            $employee['error']=$e->getMessage();
            $employee['msg'] = 'Employee Details not updated';
            $employee['success_status'] = '0';
            return response()->json($employee);
        }
        return response()->json($employee);
    }


    public function empget($id)
    {

        $post = DB::table('employees')->select('first_name', 'middle_name', 'last_name', 'emp_id', 'id')->where('designation_id', $id)->get();

        return response()->json($post);

    }


    public function checkID($id)
    {


        $emp_id = strtoupper($id);

        if (DB::table('employees')->where('emp_id', $emp_id)->exists()) {
            return response()->json('200');
        } else {
            return response()->json('404');
        }
    }

    public function users($email)
    {

        if ($post = DB::table('users')->where('email', $email)->exists()) {
            return response()->json(DB::table('users')->where('email', $email)->pluck('status'));
        }


    }

    public function usersid($id)
    {

        if (DB::table('users')->where('name', $id)->exists()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function emailcheck($emp_id)
    {
        $post = Employee::with('payslip', 'designation', 'department')
            ->where('employees.emp_id', $emp_id)->first();
        return response()->json($post);
    }


    public function emp_id($id)
    {

        $post = DB::table('employees')->where('emp_id', $id)->pluck('email');
        return response()->json($post);

    }

    public function newpayslip(Request $request)
    {

        $date = $request->date;
        $data = explode("-", $date);
        $i = $data[1] - 1;
        $num_padded = sprintf("%02d", $i);
        $previous_month = $data[0] . '-' . $num_padded;
        $get_previous_data = Payslip::where('salary_month', $previous_month)->get();
        $dateToTest = new Carbon('last day of ' . $previous_month);;
        $lastday = explode("-", $dateToTest);
        $last = explode(" ", $lastday[2]);

        foreach ($get_previous_data as $key => $get) {
            $insert[$key]['salary_month'] = $date;
            $insert[$key]['emp_id'] = $get->emp_id;
            $insert[$key]['basic_salary'] = $get->basic_salary;
            $insert[$key]['da'] = $get->da;
            $insert[$key]['adjustment'] = $get->adjustment;
            $insert[$key]['cit'] = $get->cit;
            $insert[$key]['total_working_days'] = $last[0];
        }

        DB::table('payslips')->insert($insert);

        return response()->json($insert);
    }


    public function checkpayslip($date)
    {

        $gets = DB::table('payslips')->where('salary_month', $date)->get();

        foreach ($gets as $get) {
            if (isset($get->attendence)) {
                return response()->json(true);
            } else {
                return response()->json(false);
            }
        }


        // $get = Payslip::get();

        // if(Payslip::where('salary_month','=',$date)->exists()){
        //     return response()->json('202');
        // }else{
        //     return response()->json('404');
        // }

    }

    public function check_id($id)
    {

        if (Employee::where('emp_id', $id)->exists()) {
            return response()->json('1');  //employee id exists
        } else {
            return response()->json('0');
        }

    }
}

