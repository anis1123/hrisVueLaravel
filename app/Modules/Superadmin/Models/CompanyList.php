<?php

namespace App\Modules\Superadmin\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyList extends Model
{
    protected $fillable=['company_name','short_name','phone','mobile','email','address','country','currency','contact_person',
        'logo'];
}
