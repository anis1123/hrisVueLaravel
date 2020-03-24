<?php

namespace App\Http\Controllers;

use App\TaxInformation;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaxInformationController extends Controller
{
    public function update(Request $request)
    {
        try {

            foreach ($_POST as $key => $value) {
                if ($key == "_token") {
                    continue;
                }

                $data = array();
                $data['value'] = $value;
                $data['updated_at'] = Carbon::now();
                if (TaxInformation::where('name', $key)->exists()) {
                    TaxInformation::where('name', '=', $key)->update($data);
                } else {
                    $data['name'] = $key;
                    $data['created_at'] = Carbon::now();
                    $tax=TaxInformation::insert($data);
                }
            }

            $res['msg'] = 'Tax information updated successfully';
            $res['success_status'] = '0';
        }
        catch (\Exception $e){
            $res['error']=$e->getMessage();
            $res['msg'] = 'Tax information not updated';
            $res['success_status'] = '0';
            return response()->json($res);
        }
        return response()->json($res);
    }
}
