<?php

namespace App\Modules\Employee\Entities;

use Illuminate\Database\Eloquent\Model;


class Employee extends Model
{
    protected $primaryKey = 'id';
    protected $fillable=['emp_id','first_name','middle_name','last_name','p_address','t_address','city','state','country',
        'phone','mobile','email','birth_date','gender','marital_status','department_id','designation_id','joining_date',
        'featured_image','level_id','mode_of_pay','bank_name','bank_account','swift_code','resume','id_proof','other_document',
        'pan_no','citizenship_no','nationality'];

    public function attendance(){
        return $this->hasMany('App\Attendance','emp_id','employee_id');
    }

    public function attendance2(){

        $date = request()->route()->parameter('date');
        if($date){
            return $this->attendance()->where('date',$date);
        }else{
            return $this->attendance()->where('date',date('Y-m'));
        }

    }
    public function department(){
    	return $this->belongsTo('App\Department','department_id');
    }

    public function designation()
    {
    	return $this->belongsTo('App\Designation','designation_id');
    }

    public function payslip()
    {
        return $this->belongsTo('App\Modules\Payslip\Entities\Payslip', 'emp_id', 'emp_id');
    }

    public function payslip2()
    {
       $date = request()->route()->parameter('date');

        return $this->payslip()->where('salary_month','=',$date);
    }

    public function levels(){
        return $this->belongsTo('App\SalaryLevel','level_id');
    }
}
