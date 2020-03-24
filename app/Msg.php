<?php

namespace App;
use App\Employee;
use Illuminate\Database\Eloquent\Model;

class Msg extends Model
{
    public function emp()
    {
        return $this->belongsTo(Employee::class,'emp_id','user_id');
    }
}
