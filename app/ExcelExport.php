<?php
namespace App;
use App\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
class ExcelExport implements FromCollection
{
    public function collection()
    {
        return Employee::where('email','=',null)->get();
    }
}
