<?php

namespace App\Modules\Superadmin\Http\Controllers;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Imports\UsersImport;

use App\Modules\Superadmin\Models\CompanyUser;
use App\Modules\Superadmin\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function index(Request $request)
    {
        $company_id = null;

        $roles = Role::pluck('name', 'name')->all();
        $data = User::where('super_admin', 0)->get();
        return view('superadmin::users.index', compact('data', 'roles', 'company_id'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $user = User::create($input);
            $company_user = CompanyUser::where('user_id', $user->id)->first();
            $roles = $request->input('roles');
            $user->assignRole($roles);


        } catch (\Exception $e) {
            DB::rollback();
            return back()->withError($e->getMessage())->withInput();
        }
        DB::commit();
        toastr()->success('User created successfully');
        return redirect()->route('super.users.index');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('superadmin::users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = User::find($id);
        $company_id = $request->company_id;
        $roles = Role::pluck('name', 'company_id')->all();
        $userRole = $user->roles->pluck('name', 'company_id')->all();
        $companyroles = Role::where('company_id', $company_id)->get();
        $data = User::all();
        return view('superadmin::users.edit', compact('user', 'roles', 'companyroles',
            'userRole', 'data', 'company_id'));
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
            'email' => 'required|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $input = $request->all();
            if (!empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                $input = array_except($input, array('password'));
            }
            $user = User::find($id);

            $user->update($input);
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $company_user = CompanyUser::where('user_id', $user->id)->first();


            $user->assignRole($request->input('roles'));

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withError($e->getMessage())->withInput();
        }
        DB::commit();
        toastr()->info('User Updated Successfully');
        return redirect()->route('super.users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        toastr()->error('User removed successfully');
        return redirect()->route('super.users.index');

    }

    public function getcompanyroles(Request $request)
    {
        $companyroles = null;
        $company_id = $request->company_id;
        $companyroles = Role::where('company_id', $company_id)->get();
        $data = User::all();
        return view('superadmin::users.index', compact('companyroles', 'data', 'company_id'));
    }

}
