<?php

namespace App\Modules\Superadmin\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable=['name','group_id','guard_web'];
}
