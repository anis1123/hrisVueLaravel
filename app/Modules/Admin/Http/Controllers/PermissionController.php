<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;


use App\Modules\Superadmin\Models\CompanyUser;
use App\Modules\Superadmin\Models\Permission;
use App\Modules\Superadmin\Models\PermissionGroup;
use App\Modules\Superadmin\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
public function __construct()
{

    $this->middleware('permission:permission-list');
    $this->middleware('permission:permission-create', ['only' => ['create', 'store']]);
    $this->middleware('permission:permission-edit', ['only' => ['edit', 'update']]);
    $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $company_id=User::where('company_id',auth()->user()->company_id)->first();

        $permissions = Permission::where('company_id',$company_id->company_id)->get();


        return view('admin::permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin::permissions.create');
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
        toastr()->success('Permissions added successfully');
        return redirect()->route('permissions.index');
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
        return redirect()->route('permissions.index');

    }


}
