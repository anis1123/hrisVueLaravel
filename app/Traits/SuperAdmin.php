<?php
namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait SuperAdmin
{
    public function isSuperadmin()
    {
        return Auth::user()->super_admin==1;
    }
}

