<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryLevel extends Model
{
    protected $fillable=['name','basic_salary','designation_id','session_year'];

    public function designations(){
        return $this->belongsTo('App\Designation','designation_id');
    }
}
