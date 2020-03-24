<?php

namespace App;

use App\Modules\Employee\Entities\Employee;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable=['emp_id','leave_type','from','to','time_from','time_to',
        'app_status','remarks','leave_reason','half_day'];
    public function employees(){
       return $this->belongsTo(Employee::class,'emp_id','emp_id');
    }
}
