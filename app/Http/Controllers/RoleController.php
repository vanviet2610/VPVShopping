<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        return view('admin.role.add-role', compact('permission'));
    }

    function store(RoleRequest $req)
    {
        try {
            $role =   $this->role->create([
                'name' => $req->name,
                'display_name' => $req->display
            ]);
            foreach ($req->permission as  $value) {
                $role->addPermissionRole()->fir($value);
            }
            DB::commit();
            return redirect()->back()->with('msg', 'Thêm thành công');
        } catch (\Exception $err) {
            DB::commit();
            Log::error("create Role => " . $err->getMessage() . ' Line => ' . $err->getLine());
            return redirect()->back()->with('msgerr', 'Thêm thất bại');
        }
    }

    function edit($id)
    {
        $role = $this->role->find($id);
        $rolePermission = $role->addPermissionRole;
        $permission = $this->permission->where('parent_id', 0)->get();
        return view('admin.role.edit-role', compact('permission', 'rolePermission', 'role'));
    }

    function update($id, RoleRequest $req)
    {
        try {
            $role = $this->role->find($id);
            $role->addPermissionRole()->sync($req->permission);
            $role->update([
                'name' => $req->name,
                'display_name' => $req->display
            ]);
            DB::commit();
            return redirect()->back()->with('msg', 'Chỉnh sửa vai trò thành công');
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error("Edit Roles => " . $err->getMessage() . " Line => " . $err->getLine());
            return redirect()->back()->with('msgerr', 'Chỉnh sửa vai trò thất bại');
        }
    }
}
