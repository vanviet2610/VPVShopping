<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\TryCatch;

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
            DB::beginTransaction();
            $role =   $this->role->create([
                'name' => $req->name,
                'display_name' => $req->display
            ]);
            foreach ($req->permission as  $value) {
                $role->addPermissionRole()->attach($value);
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
            DB::beginTransaction();
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

    public function delete($id)
    {
        $role = $this->role->findOrFail($id);
        DB::beginTransaction();
        try {
            $role->delete();
            DB::commit();
            return response()->json(
                [
                    'code' => 200,
                    'message' => 'xóa thành công'
                ]
            );
        } catch (\Exception $err) {
            DB::rollback();
            Log::error("delete Roles => " . $err->getMessage() . " Line => " . $err->getLine());
            return response()->json(
                [
                    'code' => 404,
                    'message' => 'Xóa Thất bại'
                ]
            );
        }
    }

    function trash()
    {
        $role = $this->role->onlyTrashed()->paginate(10);
        return view('admin.role.trash-role', compact('role'));
    }

    function restore($id)
    {
        $role = $this->role->onlyTrashed()->findOrFail($id);
        DB::beginTransaction();

        try {
            $role->restore();
            DB::commit();
            return response()->json(
                [
                    'code' => 200,
                ]
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(
                [
                    'code' => 404,
                ]
            );
        }
    }
    function destroy($id)
    {
        $role = $this->role->onlyTrashed()->find($id)->forceDelete();
        if ($role) {
            return redirect()->back()->with('msg', 'Xóa vĩnh viễn vai trò thành công');
        } else {
            DB::rollBack();
            return redirect()->back()->with('msgerr', 'Xóa thất bại trò thất bại');
        }
    }
}
