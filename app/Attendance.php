<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class Attendance extends Model
{
    protected $table = 'attendances';
protected $fillable=['emp_id','date','present_status','longitude','latitude','checkin_time','checkout_time','checkout_longitude',
    'checkout_latitude','wifi_ssid','ip_address'];
    public function employees(){
       return $this->belongsTo(Payslip::class,'emp_id','employee_id');
    }
}
