<?php

namespace App\Modules\Payslip\Entities;

use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{

    protected $fillable = ['salary_month',
        'emp_id',
        'payslip_no',
    ];



}
