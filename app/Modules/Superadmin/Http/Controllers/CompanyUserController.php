<?php

namespace App\Modules\Superadmin\Http\Controllers;

use App\Modules\Superadmin\Models\CompanyUser;
use App\Modules\Superadmin\Models\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class CompanyUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::where('status',1)->get();
        $company_users=CompanyUser::where('status',1)->get();
        return view('superadmin::company_user.index',compact('company_users','users'));
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
        $this->validate($request,[
            'user_id'=>'required|unique:company_users,user_id',
            'company_id'=>'required']);
    $input=$request->all();
    CompanyUser::create($input);
    return redirect()->route('super.company_users.index');
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
        $users=User::where('status',1)->get();
        $company_users=CompanyUser::where('status',1)->get();
        $user=CompanyUser::where('id',$id)->where('status',1)->first();
        return view('superadmin::company_user.edit',compact('user','users','company_users'));
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
        $user=CompanyUser::where('id',$id)->where('status',1)->first();
        $this->validate($request,[
            'user_id'=>'required|unique:company_users,user_id,'.$user->id,
            'company_id'=>'required']);
        $input=$request->all();
        $user->update($input);
        return redirect()->route('super.company_users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=CompanyUser::where('id',$id)->where('status',1)->first();
        $user->status=0;
        $user->save();
        return redirect()->back();
    }
}
