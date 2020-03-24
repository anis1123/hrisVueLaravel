<?php

namespace App\Modules\Superadmin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Superadmin\Models\CompanyList;
use App\Modules\Superadmin\Models\CompanyUser;
use App\Modules\Superadmin\Models\ModelHasRole;
use App\Modules\Superadmin\Models\Permission;
use App\Modules\Superadmin\Models\RoleHasPermission;
use App\Modules\Superadmin\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class CompanyListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $companies = CompanyList::where('status', 1)->get();
        return view('superadmin::company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = CompanyList::orderBy('id', 'DESC')->first();
        $id = 0;
        if ($company) {
            $id = $company->id;
        }
        $company_id = $id + 1;
        return view('superadmin::company.create', compact('company_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        DB::beginTransaction();

        $this->validate($request, [
            'company_name' => 'required|unique:company_lists,company_name',
            'phone' => 'required',
            'mobile' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'contact_person' => 'required',
            'logo' => 'required',
            'currency' => 'required',
            'country' => 'required',
            'company_id' => 'required|unique:company_lists,id',
            'name' => 'required',
            'login_email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);
        try {
            DB::beginTransaction();
            $input = $request->all();
            if ($request->hasFile('logo')) {
                $input['logo'] = $request->logo->store('public');
            }
            CompanyList::create($input);
            $role = new Role();
            $role->name = 'Admin-' . $request->company_id;
            $role->company_id = $request->company_id;
            $role->save();
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->login_email;
            $user->password = Hash::make($request->password);
            $user->company_id = $request->company_id;
            $user->role_id = $role->id;
            $user->save();
            create_permission_group('permission', $request->company_id);
            create_permission_group('role', $request->company_id);
            create_permission_group('user', $request->company_id);
            create_permission_group('setting', $request->company_id);
            $permissions = Permission::where('company_id', $request->company_id)->get();
            foreach ($permissions as $permission) {
                RoleHasPermission::create(['permission_id' => $permission->id,
                    'role_id' => $role->id]);
            }
            $srole = Role::where('company_id', $request->company_id)->first();
            $company_role = $srole->name;
            $user->assignRole([$company_role]);
            $ids = 1;
            $m = ModelHasRole::orderBy('model_id', 'DESC')->first();
            if ($m) {
                $ids = $m->model_id;
            }
            $n = ModelHasRole::where('model_id', $ids)->first();
            $n->role_id = $srole->id;
            $n->save();
        } catch (\Exception $e) {
            DB::rollBack();

        }
        DB::commit();
        toastr()->success('Company created successfully');
        return redirect()->route('super.company.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = CompanyList::where('id', $id)->where('status', 1)->first();
        return view('superadmin::company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = CompanyList::where('status', 1)->where('id', $id)->first();
        return view('superadmin::company.edit', compact('company'));
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
            'company_id' => 'required|unique:company_lists,id,' . $company->id,
        ]);
        try {
            $input = $request->all();
            if ($request->hasFile('logo')) {
                $input['logo'] = $request->logo->store('public');
            }

            $company->update($input);
        } catch (\Exception $e) {
            DB::rollBack();

        }
        DB::commit();
        toastr()->info('Company Updated successfully');
        return redirect()->route('super.company.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = CompanyList::where('id', $id)->where('status', 1)->first();
        $company->status = 0;
        $company->save();
        toastr()->error('Company Removed successfully');
        return redirect()->back();
    }
}
