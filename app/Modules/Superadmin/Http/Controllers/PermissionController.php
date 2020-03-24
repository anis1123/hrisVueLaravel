<?php

namespace App\Modules\Superadmin\Http\Controllers;

use App\Http\Controllers\Controller;


use App\Modules\Superadmin\Models\Permission;
use App\Modules\Superadmin\Models\PermissionGroup;
use App\Modules\Superadmin\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
public function __construct()
{
//    $this->middleware['super-admin'];
}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permissions = Permission::all();
        return view('superadmin::permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superadmin::permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'group' => 'required',
            'guard_name' => 'required',
            'company_id' => 'required',

        ]);

        DB::beginTransaction();
        try {
            $group = new PermissionGroup();
            $group->name = $request->group;
            $group->company_id = $request->company_id;
            $group->save();

            $input0 = $request->group;
            $inputs[0] = $input0 . "-list";
            $inputs[1] = $input0 . "-create";
            $inputs[2] = $input0 . "-edit";
            $inputs[3] = $input0 . "-delete";

            for ($i = 0; $i < 4; $i++) {
                $permission = new Permission();
                $permission->name = $inputs[$i];
                $permission->group_id = $group->id;
                $permission->company_id = $request->company_id;
                $permission->guard_name = "web";
                $permission->save();
            }
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withError($e->getMessage())->withInput();
        }
        DB::commit();
        toastr()->success('Permission added succesfully');
        return redirect()->route('super.permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Permission $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("permissions")->where('id', $id)->delete();
        toastr()->error('Permission deleted successfully');
        return redirect()->route('super.permissions.index');

    }

    public function getcompanyid(Request $request)
    {
        $permissions = null;
        $group = PermissionGroup::where('company_id', $request->company_id)->get();


        $permissions = Permission::where('company_id', $request->company_id)->get();
        $company_id = $request->company_id;
        return view('superadmin::roles.create', compact('permissions', 'group', 'company_id'));
    }
}
