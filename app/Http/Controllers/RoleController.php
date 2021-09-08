<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Roles;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    private $role, $permission;

    function __construct(Roles $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }
    function index()
    {
        $role =   $this->role->paginate(10);
        return view('admin.role.index-roles', compact('role'));
    }

    function create()
    {
        $permission = $this->permission->where('parent_id', 0)->get();
        return view('admin.role.add-role',compact('permission'));
    }
}
