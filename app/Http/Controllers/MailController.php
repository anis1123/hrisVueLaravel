<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Input;
use App\Mail\sendMail;
use Illuminate\Support\Facades\DB;
class MailController extends Controller
{
    public function send(Request $request){
        {


            $post = DB::table('employees')
            // ->join('departments','emp_adds.department','=','departments.id')
            // ->join('designations','emp_adds.designation','=','designations.designation_id')
            ->join('payslips','employees.emp_id','=','payslips.emp_id')

            ->get();
            //  dd($post);
            //  die;
           // $company_inf = DB::table('company_infs')->where('id',8)->first();

            // $company_name = $company_inf->company_name;

            // $employee = DB::table('emp_adds')->get();

            // $count = count($employee);



        foreach($post as $posts ){
           $data =  Mail::send('payslip', ['insentive'=>$posts->insentive,'salary_month'=>$posts->salary_month,
               'emp_id'=>$posts->emp_id,'allowance'=>$posts->da,'basic_salary'=>$posts->basic_salary,
               'first_name'=>$posts->first_name,'last_name'=>$posts->last_name,'payable'=>$posts->payable,
               'pf'=>$posts->pf,'gratuity'=>$posts->gratuity,'kpi'=>$posts->kpi,
               'tax'=>$posts->tax,'sst'=>$posts->sst,'total'=>$posts->total], function ($message)
            {
                $message->to('hamalanis1@gmail.com');

            });
         }


        //return view('payslip');

        }

    }
}
