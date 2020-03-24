<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoanPay extends Model
{
    protected $fillable=['emp_id','loan_id','date','discount_perc','paid_amount'];

    public function loans(){
        return $this->belongsTo('App\Loan','loan_id');
}
}
