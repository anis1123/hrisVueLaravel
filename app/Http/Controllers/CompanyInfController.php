<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company_inf;

class CompanyInfController extends Controller
{

    public function get(){
        $post = Company_inf::first();

        return response()->json($post);
    }



    public function store(Request $req){
try {
    $post = Company_inf::find(8);

    $post->company_logo = $req->get('company_logo');

    $post->company_name = $req->get('company_name');
    $post->company_address = $req->get('company_address');
    $post->country = $req->get('country');
    $post->phone = $req->get('phone');
    $post->email = $req->get('email');
    $post->contact_person = $req->get('contact_person');
    $post->currency = $req->get('currency');
    $post->date_format = $req->get('date_format');
    $post->save();
    $res['msg'] = 'Company Info updated successfully';
    $res['success_status'] = '1';
}
catch (\Exception $e){
    $res['error']=$e->getMessage();
    $res['msg'] = 'Company Info not updated';
    $res['success_status'] = '0';
    return response()->json($res);
}
        return response()->json($res);
    }
    public function upload(Request $request){
        // return response()->json($product);

        if($request->hasFile('logo')){
            $imagename = $request->logo->getClientOriginalName();
            $request->logo->storeAs('public/company-logo',$imagename);

            return response(null,202);



        }




    }
}
