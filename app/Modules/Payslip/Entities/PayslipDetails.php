<?php

namespace App\Modules\Payslip\Entities;

use Illuminate\Database\Eloquent\Model;

class PayslipDetails extends Model
{
    protected $appends = ['gratuity_value', 'provident_fund', 'net_payable', 'before_sst', 'bill_amount',
        'yearly_average', 'total_value', 'gross_ctc', 'sst_value', 'income_tax', 'net_payment'];
   protected $fillable=['emp_id','basic_salary','adjustment','da','cit_no','pf_no','ssf_no','attendance','total_working_days'];

    public function employee()
    {
        return $this->belongsTo('App\Modules\Employee\Entities\Employee', 'emp_id', 'emp_id');
    }

    public function getGratuityValueAttribute()
    {
        return (float)(get_basic_salary($this->emp_id) * get_tax_info('gratuity')) / 100;
    }


    public function getProvidentFundAttribute()
    {
        return (float)(get_basic_salary($this->emp_id) * get_tax_info('provident_fund')) / 100;
    }


    public function getNetPayableAttribute()
    {
        $working_days = $this->total_working_days;
        return (float)(get_basic_salary($this->emp_id) + $this->da) / $working_days * $this->attendance + $this->adjustment;

    }


    public function getBeforeSstAttribute()
    {
        return (float)($this->getGratuityValueAttribute() + $this->getNetPayableAttribute()) - $this->getProvidentFundAttribute();

    }

    public function getBillAmountAttribute()
    {
        return (float)($this->getProvidentFundAttribute() + $this->getGratuityValueAttribute() + $this->getNetPayableAttribute());
    }

    public function getYearlyAverageAttribute()
    {
        return (float)($this->getBeforeSstAttribute() - $this->cit_no) * 12;
    }

    public function getTotalValueAttribute()
    {
        return (float)($this->getBeforeSstAttribute() - $this->cit_no) / 12;
    }

    public function getGrossCtcAttribute()
    {
        return (float)(get_basic_salary($this->emp_id) + $this->getProvidentFundAttribute() + $this->da + $this->getGratuityValueAttribute() + $this->adjustment);
    }


    public function getSstValueAttribute()
    {

        $data = $this->employee()->first();
        if ($data && strtoupper($data->marital_status) == 'M') {
            if ($this->getYearlyAverageAttribute() > get_tax_info('m_sst_yearly')) {
                return (float)(get_tax_info('m_sst_yearly')/100)/12;
            } else {
                return (float)(($this->getYearlyAverageAttribute() * 1) / 100) / 12;
            }
        } elseif ($this->getYearlyAverageAttribute() > get_tax_info('um_sst_yearly')) {
            return (float)(get_tax_info('um_sst_yearly')/100)/12;
        } else {
            return (float)(($this->getYearlyAverageAttribute() * 1) / 100) / 12;
        }
    }

    public function getIncomeTaxAttribute()
    {

        $data = $this->employee()->first();
        if ($data && strtoupper($data->marital_status == 'UM')) {
            if ($this->getYearlyAverageAttribute() <= get_tax_info('um_first_max_income')) {
                return 0 ;
            } elseif ($this->getYearlyAverageAttribute() <= get_tax_info('um_second_max_income')) {
                return ((($this->getYearlyAverageAttribute() - get_tax_info('um_first_max_income')) * get_tax_info('um_first_level_tax')) / 100) / 12 ;
            } elseif ($this->getYearlyAverageAttribute() <= get_tax_info('um_third_max_income')) {
                return (((($this->getYearlyAverageAttribute() - get_tax_info('um_second_max_income')) * get_tax_info('um_second_level_tax')) / 100) + get_tax_info('um_second_level_extra')) / 12;
            } elseif ($this->getYearlyAverageAttribute() <= get_tax_info('um_fourth_max_income')) {
                return (((($this->getYearlyAverageAttribute() - get_tax_info('um_third_max_income')) * get_tax_info('um_third_level_tax')) / 100) + get_tax_info('um_third_level_extra')) /12;
            } else {
                return (((($this->getYearlyAverageAttribute() - get_tax_info('um_fourth_max_income')) * get_tax_info('um_fourth_level_tax')) / 100) + get_tax_info('um_fourth_level_extra')) /12;
            }
        } else {
            if ($this->getYearlyAverageAttribute() <= get_tax_info('m_first_max_income')) {
                return 0;
            } elseif ($this->getYearlyAverageAttribute() <= get_tax_info('m_second_max_income')) {
                return ((($this->getYearlyAverageAttribute() - get_tax_info('m_first_max_income')) * get_tax_info('m_first_level_tax')) / 100) /12;
            } elseif ($this->getYearlyAverageAttribute() <= get_tax_info('m_third_max_income')) {
                return (((($this->getYearlyAverageAttribute() - get_tax_info('m_second_max_income')) * get_tax_info('m_second_level_tax')) / 100) + get_tax_info('m_second_level_extra')) / 12;
            } elseif ($this->getYearlyAverageAttribute() <= get_tax_info('m_fourth_max_income')) {
                return (((($this->getYearlyAverageAttribute() - get_tax_info('m_third_max_income')) * get_tax_info('m_third_level_tax')) / 100) + get_tax_info('m_third_level_extra')) / 12;
            } else {
                return (((($this->getYearlyAverageAttribute() - get_tax_info('m_fourth_max_income')) * get_tax_info('m_fourth_level_tax')) / 100) + get_tax_info('m_fourth_level_extra')) / 12;
            }
        }
    }

    public function getNetPaymentAttribute()
    {
        return (float)($this->getBeforeSstAttribute() - $this->cit_no - $this->getIncomeTaxAttribute() - $this->getSstValueAttribute());
    }
}
