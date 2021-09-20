<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roles extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable  = ['name','display_name'];
  
    function addPermissionRole()
    {
        return $this->belongsToMany(Permission::class,'permission_role','role_id','permission_id')->withTimestamps();
    }

}
