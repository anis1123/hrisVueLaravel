<?php

namespace App\Modules\Superadmin\Models;

use Illuminate\Database\Eloquent\Model;

class RoleHasPermission extends Model
{
    public $timestamps=false;
   protected $fillable=['permission_id','role_id','company_id'];
}
