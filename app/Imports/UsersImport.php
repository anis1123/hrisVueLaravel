<?php
namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
class UsersImport implements ToModel, WithBatchInserts, WithCalculatedFormulas
{
    public function model(array $row)
    {

       //echo $row[2];
       if ($row[2]=='Name') {
        return null;
    }



          $pieces = explode(" ", $row[2]);
              $pieces[0]; // piece1
             if(!empty($pieces[1])){
                 $pieces[1];
             }else{
                $pieces[1]='';
             }


            //print_r($pieces);
            $dep_id = '';

        $dep = DB::table('departments')->where('name',$row[4])->first();
        $dep_id = @$dep->id;
        if(empty($dep)){

            $dep_id = DB::table('departments')->insertGetId(['name'=>$row[4],'created_at'=>date("Y-m-d H:i:s", time())]);


        }

        $deg = DB::table('designations')->where('name',$row[5])->first();
        $deg_id = @$deg->id;
        if(empty($deg)){
            $deg_id = DB::table('designations')->insertGetId(['name'=>$row[5],'department_id'=>$dep_id,
                'created_at'=>date("Y-m-d H:i:s", time())]);
        }
       DB::table('employees')->insert(['marital_status'=>$row[3],'department_id'=>$dep_id,'designation_id'=>$deg_id,
           'emp_id'=>$row[1],'first_name'=>$pieces[0],'last_name'=>$pieces[1]]);
             $days = $d=cal_days_in_month(CAL_GREGORIAN,6,219);
        DB::table('payslips')->insert(['basic_salary'=>$row[6],'salary_month'=>date("Y-m"),'da'=>$row[7],
            'adjustment'=>$row[8],'attendence'=>$row[13],'cit'=>$row[17],'emp_id'=>$row[1],'total_working_days'=>date('t'),
        'kpi'=>$row[22],
        'payable'=>$row[14],
        'pf'=>$row[10],
        'gratuity'=>$row[9],
        'tax'=>$row[19],
        'net_recived'=>$row[21],
        'sst'=>$row[20],
        'insentive'=>$row[23],
        'total'=>$row[24],







        'created_at'=>date("Y-m-d H:i:s", time())]);
    }

    public function headingRow(): int
    {
        return 2;
    }

    public function batchSize(): int
    {
        return 100;
    }
}


