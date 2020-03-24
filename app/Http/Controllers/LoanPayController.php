<?php

namespace App\Http\Controllers;

use App\Loan;
use App\LoanPay;
use App\LoanType;
use Illuminate\Http\Request;

class LoanPayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loanpays = LoanPay::where('status', 1)->get();
        return response()->json($loanpays);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $input = $request->all();
            $loan = Loan::where('id', $request->loan_id)->first();
            $input['emp_id'] = $loan->emp_id;
            $loantype = LoanType::where('id', $loan->loan_type_id)->first();
            if ($request->discount_perc) {
                $discount = $request->discount_perc;
            } else {
                $discount = 0;
            }

            $res['amount_to_pay'] = (($loantype->interest - $discount) * $loan->loan_amount) / 100;
            $res['remaining_amount'] = $res['amount_to_pay'] - $request->paid_amount;
            $rem=$res['remaining_amount'];
            $loan->update(['remaining_amount'=>$rem]);
//            return $loan;
//            $s = $loan->remaining_amount = $res['remaining_amount'];
//            $s->save();
            $res['loanpay'] = LoanPay::create($input);
            $res['msg'] = 'Loan Pay added successfully';
            $res['success_status'] = '1';
        } catch (\Exception $e) {
            $res['error'] = $e->getMessage();
            $res['msg'] = 'Loan Pay not added';
            $res['success_status'] = '0';
            return response()->json($res);
        }
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $loanpay = LoanPay::where('status', 1)->where('id', $id)->first();
        return response()->json($loanpay);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $loanpay = LoanPay::find($id);
            $input = $request->all();
            $loan = Loan::where('id', $loanpay->loan_id)->first();
            $loantype = LoanType::where('id', $loan->loan_type_id)->first();

            if ($request->discount_perc) {
                $discount = $request->discount_perc;

            } else {
                $discount = 0;
            }
            $res['amount_to_pay'] = (($loantype->interest - $discount) * $loan->loan_amount) / 100;
            $res['remaining_amount'] = $res['amount_to_pay'] - $request->paid_amount;
            $rem=$res['remaining_amount'];
            $loan->update(['remaining_amount'=>$rem]);
            $res['loanpay'] = $loanpay;
            $loanpay->update($input);
            $res['msg'] = 'Loan Pay updated successfully';
            $res['success_status'] = '1';
        } catch (\Exception $e) {
            $res['error'] = $e->getMessage();
            $res['msg'] = 'Loan Pay not updated';
            $res['success_status'] = '0';
            return response()->json($res);
        }
        return response()->json($res);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loanpay = LoanPay::find($id);
        $loanpay->status = 0;
        $loanpay->save();
        return response()->json('success');
    }
}
