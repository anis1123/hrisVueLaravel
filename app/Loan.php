<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable=['emp_id','loan_type_id','loan_date','loan_amount','remaining_amount','description'
    ,'repayment_amount','repayment_date'];

    public function loantypes(){
        return $this->belongsTo('App\LoanType','loan_type_id');
    }
}
