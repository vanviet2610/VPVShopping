<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];

    function getChildALL()
    {
        return $this->hasMany(Permission::class, 'parent_id');
    }
    public function getParent_id()
    {
        return $this->belongsTo(Permission::class, 'parent_id');
    }
}
