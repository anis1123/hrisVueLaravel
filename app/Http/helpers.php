<?php

use App\Modules\Employee\Entities\Employee;
use App\Modules\Superadmin\Models\CompanyList;
use App\Modules\Superadmin\Models\CompanyUser;
use App\Modules\Superadmin\Models\Permission;
use App\Modules\Superadmin\Models\PermissionGroup;
use App\Modules\Superadmin\Models\RoleHasPermission;
use App\Modules\Superadmin\Models\Setting;
use App\SalaryLevel;
use App\TaxInformation;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;

if (!function_exists('get_company_lists')) {
    function get_company_lists()
    {
        $settings = CompanyList::where('status', 1)->get();
        if (!empty($settings)) {
            return $settings;
        } else {
            return "";
        }
    }
}

if (!function_exists('create_permission_group')) {
    function create_permission_group($name,$company_id)
    {
        $group = new PermissionGroup();
        $group->name = $name;
        $group->company_id = $company_id;
        $group->save();

        $input0 = $name;
        $inputs[0] = $input0 . "-list";
        $inputs[1] = $input0 . "-create";
        $inputs[2] = $input0 . "-edit";
        $inputs[3] = $input0 . "-delete";

        for ($i = 0; $i < 4; $i++) {
            $permission = new Permission();
            $permission->name = $inputs[$i];
            $permission->group_id = $group->id;
            $permission->company_id = $company_id;
            $permission->guard_name = "web";
            $permission->save();
        }

    }
}
if (!function_exists('has_permission')) {
    function has_permission($name,$company_id)
    {
       $permission_id=Permission::where('name',$name)->where('company_id',$company_id)->first();

        $rolename=auth()->user()->getRoleNames();

       $role_id=Role::where('name',$rolename[0])->where('company_id',$company_id)->first();
        $check=RoleHasPermission::where('role_id',$role_id->id)->where('permission_id',$permission_id->id)->first();
        if (!empty($check)) {
            return true;
        } else {
            return false;
        }

    }
}
if (!function_exists('get_company_id')) {
    function get_company_id($id)
    {

        $settings = CompanyUser::where('user_id', $id)->first();

        if (!empty($settings)) {
            return $settings;
        } else {
            return "";
        }
    }
}

if (!function_exists('get_company_info')) {
    function get_company_info($id)
    {
//dd($id);
        $settings = CompanyList::where('status',1)->where('id', $id)->first();
//        dd($settings);
        if (!empty($settings)) {
            return $settings;
        } else {
            return "";
        }
    }
}
if (!function_exists('change_date_format')) {
    function change_date_format($date)
    {
        $updated_date=Carbon::createFromFormat('m/d/Y', $date)->format('Y-m-d');
        if (!empty($updated_date)) {
            return $updated_date;
        } else {
            return "";
        }
    }
}

if (!function_exists('get_tax_info')) {
    function get_tax_info($name)
    {
        $settings = TaxInformation::select('value')->where('name', $name)->first();
        if (!empty($settings)) {
            return $settings->value;
        } else {
            return "";
        }
    }
}
//if (!function_exists('get_company_info')) {
//    function get_company_info($name)
//    {
//        $settings = Setting::select('value')->where('name', $name)->first();
//        if (!empty($settings)) {
//            return $settings->value;
//        } else {
//            return "";
//        }
//    }
//}

if (!function_exists('get_basic_salary')) {
    function get_basic_salary($emp_id)
    {
        $session=date('Y');
        $employee=Employee::where('emp_id',$emp_id)->first();
        $level=SalaryLevel::where('id',$employee->level_id)->where('session_year',$session)->where('status',1)->first();
        $settings = $level->basic_salary;
        if (!empty($settings)) {
            return $settings;
        } else {
            return "";
        }
    }
}

if (!function_exists('permission_list')) {
    function permission_list($id)
    {
        $permissions = Permission::where('group_id', $id)->get();

        return $permissions;
    }
}

if (!function_exists('get_setting_info')) {
    function get_setting_info($name)
    {
        $settings = Setting::select('value')->where('name', $name)->first();
        if (!empty($settings)) {
            return $settings->value;
        } else {
            return "";
        }
    }
}

