<?php

namespace App\Exports;
use App\Modules\Payslip\Entities\Payslip;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class UsersExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $datas= Payslip::join('employees','payslips.emp_id','=','employees.emp_id')
        ->join('departments','employees.department_id','departments.id')
        ->join('designations','employees.designation_id','=','designations.id')
        ->select('payslips.salary_month','employees.emp_id','employees.first_name','employees.middle_name','employees.last_name',
            'employees.marital_status','departments.name','designations.name','payslips.basic_salary','payslips.da',
            'payslips.appends.gratutity_value','payslips.adjustment')
        ->get();
         print_r($datas);
         die();
    }
    public function headings(): array
    {
        return [
            'Salary Month',
            'Employee Id',
            'First Name',
            'Middle Name',
            'Last Name',
            'Marital Status',
            'Department',
            'Position',
            'Basic Salary',
        ];
    }
}
