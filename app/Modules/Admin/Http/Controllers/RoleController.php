<?php

namespace App\Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Superadmin\Models\CompanyUser;
use App\Modules\Superadmin\Models\Permission;
use App\Modules\Superadmin\Models\PermissionGroup;
use App\Modules\Superadmin\Models\RoleHasPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    public function __construct()
    {
//        if (Gate::denies('role-list')) {
//            abort(403);
//        }

        $this->middleware('permission:role-list');
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

//        dd(auth()->user()->can('setting-list'));
        $company_id = auth()->user()->company_id;

        $permission = Permission::where('company_id', $company_id)->get();
        $roles = Role::where('company_id', $company_id)->get();

        return view('admin::roles.index', compact('roles', 'permission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company_id = auth()->user()->company_id;

        $group = PermissionGroup::where('company_id', $company_id)->get();
        return view('admin::roles.create', compact('group', 'company_id'));
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
            $checkrole = 'Admin-' . $request->company_id;
            if ($request->name == $checkrole) {
                $rolename = $request->name;
            } else {
                $rolename = $request->name . '-' . $request->company_id;
            }
            $role = Role::create(['name' => $rolename,
                'company_id' => $request->company_id]);
            $permissions = $request->permission;
            foreach ($permissions as $permission) {
                RoleHasPermission::create(['permission_id' => $permission,
                    'role_id' => $role->id]);
            }
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withError($e->getMessage())->withInput();
        }
        DB::commit();
        toastr()->success('Role stored successfully');
        return redirect()->route('roles.index');
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


        return view('admin::roles.show', compact('role', 'rolePermissions'));
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

        return view('admin::roles.edit', compact('role', 'permission', 'rolePermissions', 'group'));
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
            $rolename = $request->name . '-' . $request->company_id;
            $role = Role::find($id);
            $role->name = $rolename;
            $role->company_id = $request->input('company_id');
            $role->save();


            $role->syncPermissions($request->input('permission'));
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withError($e->getMessage())->withInput();
        }
        DB::commit();
        toastr()->info('Roles Updated Successfully');
        return redirect()->route('roles.index');
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
        return redirect()->route('roles.index');

    }
}
