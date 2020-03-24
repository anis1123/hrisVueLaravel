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
class EmployeeImports implements ToModel, WithBatchInserts, WithCalculatedFormulas
{
    public function model(array $row)
    {



       //echo $row[2];
       if ($row[2]=='Name') {
        return null;
    }


        DB::table('employees')->where('emp_id',$row[1])
            ->update(['email'=>$row[6],'bank_name'=>$row[4],'bank_account'=>$row[3]]);
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


