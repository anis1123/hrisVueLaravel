<?php

namespace App\Modules\Superadmin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Superadmin\Models\Permission;
use App\Modules\Superadmin\Models\PermissionGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permission = Permission::get();
        $roles = Role::all();
        return view('superadmin::roles.index', compact('roles', 'permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $group = PermissionGroup::all();
        return view('superadmin::roles.create', compact('group'));
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
            'name' => 'required',
            'permission' => 'required',
            'company_id' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $role = Role::create(['name' => $request->input('name'),
                'company_id' => $request->company_id]);
            $role->syncPermissions($request->input('permission'));
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withError($e->getMessage())->withInput();
        }
        DB::commit();
        toastr()->success('Role Added successfully');
        return redirect()->route('super.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->get();


        return view('superadmin::roles.show', compact('role', 'rolePermissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $group = PermissionGroup::where('company_id', $role->company_id)->get();

        $permission = Permission::where('company_id', $role->company_id)->get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        return view('superadmin::roles.edit', compact('role', 'permission', 'rolePermissions', 'group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
            'company_id' => 'required'
        ]);
        DB::beginTransaction();
        try {
            $role = Role::find($id);
            $role->name = $request->input('name');
            $role->company_id = $request->input('company_id');
            $role->save();


            $role->syncPermissions($request->input('permission'));
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withError($e->getMessage())->withInput();
        }
        DB::commit();
        toastr()->info('Role Updated successfully');
        return redirect()->route('super.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        toastr()->error('Role deleted successfully');
        return redirect()->route('super.roles.index');

    }
}
