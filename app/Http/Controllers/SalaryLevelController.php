<?php

namespace App\Http\Controllers;

use App\SalaryLevel;
use Illuminate\Http\Request;

class SalaryLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $input = $request->all();
             SalaryLevel::create($input);
            $salary['msg'] = 'Salary Level added successfully';
            $salary['success_status'] = '0';
        }
        catch (\Exception $e){
            $salary['error']=$e->getMessage();
            $salary['msg'] = 'Salary Level not added';
            $salary['success_status'] = '0';
            return response()->json($salary);
        }
       return response()->json($salary);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $salarylevel = SalaryLevel::find($id);
            $input = $request->all();
            $salarylevel->update($input);
            $res['msg'] = 'Salary Level updated successfully';
            $res['success_status'] = '1';
        }
        catch (\Exception $e){
            $res['error']=$e->getMessage();
            $res['msg'] = 'Salary Level not updated';
            $res['success_status'] = '0';
            return response()->json($res);
        }
       return response()->json($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $salarylevel=SalaryLevel::find($id);
        $salarylevel->status=0;
        $salarylevel->save();
        return response()->json('success');
    }
}
