<?php

namespace App\Modules\Superadmin\Http\Controllers;

use App\Modules\Superadmin\Models\CompanyList;
use App\Modules\Superadmin\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('superadmin::setting.create');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        try {
            if ($request->hasFile('logo')) {
                $path = $request->logo->store('public');
                $data = ['name' => 'logo', 'value' => $path];
                if (Setting::where('name', 'logo')->exists()) {
                    Setting::where('name', '=', 'logo')->update($data);
                } else {


                    Setting::create($data);
                }
            }
            foreach ($_POST as $key => $value) {
                if ($key == "_token") {
                    continue;
                }

                $data = array();
                $data['value'] = $value;
                $data['updated_at'] = Carbon::now();
                if (Setting::where('name', $key)->exists()) {
                    Setting::where('name', '=', $key)->update($data);
                } else {
                    $data['name'] = $key;
                    $data['created_at'] = Carbon::now();
                    Setting::insert($data);
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withError($e->getMessage())->withInput();
        }
        DB::commit();
        toastr()->success('SuperAdmin Setting has been updated successfully');
        return redirect()->route('supersetting.index');
    }
}
