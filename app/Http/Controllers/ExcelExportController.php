<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\ExcelExport;
use Maatwebsite\Excel\Excel;

class ExcelExportController extends Controller
{
    public function export(Request $request)
    {
        return Excel::download(new ExcelExport, 'list.xlsx');
    }

}
