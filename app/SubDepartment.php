<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubDepartment extends Model
{
    public function subDepDes(){
        return $this->hasMany('App\SubDepartmentDes','subdep_id','id');
    }
}
