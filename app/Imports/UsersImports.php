<?php

namespace App\Imports;

use App\Modules\Payslip\Entities\Payslip;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use App\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use StartRow;
use Maatwebsite\Excel\Concerns\WithStartRow;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;

class UsersImports implements ToModel,WithBatchInserts,WithCalculatedFormulas,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $result = explode(',');
        // $count = 0;
        // $count += 1;
        // DB::table('nepali_calender')->insert(['year'=>$row[1],'month_num'=>$row[2],'month'=>$row[4],'days'=>$row[5]]);

         Payslip::where([['emp_id','=',$row[1]],['salary_month','=',Session::get('date')]])->update(['attendence'=> $row[13]]);

        // print_r($post);
        // print_r('<br>');
      // DB::table('payslips')->where([['employee_id','=',$row[1]], ['salary_month','=',Session::get('date')]])->update(['attendence'=> $row[13]]);



    }


    public function StartRow(): int
    {
        return 2;
    }

    public function batchSize(): int
    {
        return 200;
    }
}
