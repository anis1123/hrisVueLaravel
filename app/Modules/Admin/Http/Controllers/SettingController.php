<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Modules\Superadmin\Models\CompanyList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function __construct()
    {

        $this->middleware('permission:setting-list');
        $this->middleware('permission:setting-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:setting-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:setting-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $setting = Setting::first();
//        dd($setting);

        $company_id = auth()->user()->company_id;
        return view('admin::setting.create', compact('company_id'));
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
        DB::beginTransaction();
        $company = CompanyList::where('status', 1)->where('id', $id)->first();

        $this->validate($request, [
            'company_name' => 'required|unique:company_lists,company_name,' . $company->id,
            'phone' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'contact_person' => 'required',
            'currency' => 'required',
            'country' => 'required',
        ]);
        try {
            $input = $request->all();
            if ($request->hasFile('logo')) {
                $input['logo'] = $request->logo->store('public');
            }

            $company->update($input);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->withErrors($e->getMessage());
        }
        DB::commit();

        toastr()->success('Company Information has been updated successfully');
        return redirect()->route('setting.index');
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();
        toastr()->error('You have successfully logged out');
        return Redirect::to("/login");

    }
}
