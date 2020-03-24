<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryHistory extends Model
{
   protected $fillable=['emp_id','level_id','date'];
}
