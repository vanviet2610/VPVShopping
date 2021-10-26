<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Models\Permission;
use App\Models\Roles;
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
        $roles =   $this->role->paginate(10);
        return view('admin.role.index-roles', compact('roles'));
    }

    function create()
    {
        $permission = $this->permission->where('parent_id', 0)->get();

        dd($permission->getChildALL);
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
            if ($req->perrmision != 0) {
                foreach ($req->permission as  $value) {
                    $role->addPermissionRole()->attach($value);
                }
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
            $role = $this->role->findOrfail($id);
            if ($req->permission != 0) {
                $role->addPermissionRole()->sync($req->permission);
            }
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
        DB::beginTransaction();
        try {
            $role = $this->role->findOrFail($id);
            $role->delete();
            DB::commit();
            $roles = $this->role->oldest()->paginate(10);
            $tableRole = view('admin.role.partials-role.index-table-role', compact('roles'))->render();
            $quantityRole = view('admin.role.partials-role.view-bottom-quantity', compact('roles'))->render();
            return response()->json(
                [
                    'code' => 200,
                    'message' => 'Xóa thành công',
                    'view' => $tableRole,
                    'quantityRole' => $quantityRole,
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
        $roles = $this->role->onlyTrashed()->paginate(10);
        return view('admin.role.trash-role', compact('roles'));
    }

    function restore($id)
    {
        $role = $this->role->onlyTrashed()->findOrFail($id);
        DB::beginTransaction();
        try {
            $role->restore();
            $roles =  $this->role->onlyTrashed()->paginate(10);
            $roleOnlyTrash = view('admin.role.partials-role.trash-table-role', compact('roles'))->render();
            $quantity = view('admin.role.partials-role.view-bottom-quantity', compact('roles'))->render();
            DB::commit();
            return response()->json(
                [
                    'code' => 200,
                    'message' => 'Khôi phục thành công',
                    'content' => 'Chúc mừng bạn đã khôi phục thành công nhé !!!!!',
                    'roleOnlytrash' => $roleOnlyTrash,
                    'quantity' => $quantity
                ]
            );
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error("Restore Role =>> " . $err->getMessage() . " Line =>>" . $err->getLine());
            return response()->json(
                [
                    'code' => 404,
                    'message' => 'Khôi phục thất bại',
                    'content' => 'Khôi phục thất bại bạn vui lòng kiểm tra lại hoặc liên hệ admin kiểm tra !!!!!',
                ]
            );
        }
    }

    function destroy($id)
    {
        $role = $this->role->onlyTrashed()->findOrFail($id);
        DB::beginTransaction();
        try {
            $role->forceDelete();
            $roles = $this->role->onlyTrashed()->paginate(10);
            $roleOnlyTrash = view('admin.role.partials-role.trash-table-role', compact('roles'))->render();
            $quantity = view('admin.role.partials-role.view-bottom-quantity', compact('roles'))->render();
            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'Xóa vĩnh viễn thành công',
                'content' => 'Chúc mừng bạn đã xóa thành công vĩnh viễn nhé !!!!!',
                'view' => $roleOnlyTrash,
                'quantity' => $quantity
            ]);
        } catch (\Exception $err) {
            DB::rollback();
            Log::error("Destroy =>>> " . $err->getMessage() . " Line =>> " . $err->getLine());
            return response()->json([
                'code' => 404,
                'message' => 'Xóa thất bại',
                'content' => 'Chúc mừng bạn đã xóa vĩnh viễn thất bại nhé !!!!!',
            ]);
        }
    }
}
