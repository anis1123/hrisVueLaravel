<?php

namespace App\Http\Controllers;

use App\Modules\Employee\Entities\Employee;
use App\SalaryHistory;
use Illuminate\Http\Request;

class SalaryHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $history = SalaryHistory::all();

        return response()->json($history);
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::where('emp_id', $id)->first();
        $history = SalaryHistory::where('emp_id', $employee->emp_id)->get();
        return response($history);
    }

}
