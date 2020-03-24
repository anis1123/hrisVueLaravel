<?php

namespace App\Modules\Superadmin\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyUser extends Model
{
    protected $fillable=['company_id','user_id'];

    public function users(){
        return $this->belongsTo('App\Modules\Superadmin\Models\User','user_id');
    }

    public function companies(){
        return $this->belongsTo('App\Modules\SUperadmin\Models\CompanyList','company_id');
    }
}
