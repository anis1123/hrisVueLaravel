<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Department extends Model
{
    protected $fillable=['name','parent_id'];
    public function subDepartment(){
        return $this->hasMany('App\SubDepartment','department_id','id');
    }
    public function childs(){
        return $this->hasMany(Designation::class);
    }
}
