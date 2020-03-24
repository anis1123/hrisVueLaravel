<?php

namespace App\Modules\Superadmin\Models;

use Illuminate\Database\Eloquent\Model;

class ModelHasRole extends Model
{
    protected $primaryKey='role_id';
    public $timestamps=false;
    protected $fillable=['role_id','model_id','model_type'];
}
