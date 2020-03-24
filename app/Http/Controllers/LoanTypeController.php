<?php

namespace App\Http\Controllers;
use App\LoanType;
use Illuminate\Support\Facades\Request;

class LoanTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loantypes=LoanType::where('status',1)->get();
        return response()->json($loantypes);
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
           LoanType::create($input);

            $loantype['msg'] = 'Loan Type added successfully';
            $loantype['success_status'] = '1';
        }
        catch (\Exception $e){
            $loantype['error']=$e->getMessage();
            $loantype['msg'] = 'Loan Type not added';
            $loantype['success_status'] = '0';
            return response()->json($loantype);
        }
        return response()->json($loantype);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loantype=LoanType::where('id',$id)->where('status',1)->first();
        return response()->json($loantype);
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
            $loantype = LoanType::find($id);
            $input = $request->all();
            $loantype->update($input);
            $res['msg'] = 'Loan Type updated successfully';
            $res['success_status'] = '1';
        }
        catch (\Exception $e){
            $res['error']=$e->getMessage();
            $res['msg'] = 'Loan Type not updated';
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
        $loantype=LoanType::find($id);
        $loantype->status=0;
        $loantype->save();
        return response()->json('success');
    }
}
