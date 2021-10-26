<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    private $permission;
    function __construct(Permission $permission)
    {
        $this->permission = $permission;
    }
    function index()
    {
        $permission = $this->permission->with('getParent_id')->paginate(10);
        return view('admin.permission.index-permission', compact('permission'));
    }

    function create()
    {
        $options =  $this->getStringOptions('', $this->permission->all());
        return view('admin.permission.add-permission', compact('options'));
    }

    function store(PermissionRequest $req)
    {
        try {
            $this->permission->create([
                'name' => $req->name,
                'display_name' => $req->display,
                'parent_id' => $req->parent_id,
                'slug' => Str::slug($req->name),
            ]);
            DB::commit();
            return redirect()->back()->with('msg', 'Thêm thành công');
        } catch (\Exception $err) {
            DB::rollback();
            Log::error("Create Permission => " . $err->getMessage() . ' Line => ' . $err->getLine());
            return redirect()->back()->with('msgerr', 'Thêm thất bại');
        }
    }

    function edit($id)
    {
        $permission =  $this->permission->find($id);
        $options = $this->getStringOptions($permission->parent_id, $this->permission->all());
        return view('admin.permission.edit-permission', compact('permission', 'options'));
    }

    function update($id, PermissionRequest $req)
    {
        $permission =   $this->permission->find($id)->update([
            'name' => $req->name,
            'display_name' => $req->display,
            'parent_id' => $req->parent_id,
            'slug' => Str::slug($req->name),
        ]);
        if ($permission) {
            return redirect()->back()->with('msg', 'Chỉnh sửa thành công');
        } else {
            return redirect()->back()->with('msgerr', 'Chỉnh sửa thất bại');
        }
    }

    function delete($id)
    {
        $permission = $this->permission->find($id)->delete();
        if ($permission) {
            return redirect()->back()->with('msg', 'Xóa  thành công');
        } else {
            return redirect()->back()->with('msgerr', 'Xóa thất bại');
        }
    }

    function trash()
    {
        $permission = $this->permission->onlyTrashed()->paginate(10);
        return view('admin.permission.trash-permission', compact('permission'));
    }
    function restore($id)
    {
        $permission = $this->permission->onlyTrashed()->find($id)->restore();
        if ($permission) {
            return redirect()->back()->with('msg', 'Khôi phục  thành công');
        } else {
            return redirect()->back()->with('msgerr', 'Khôi phục thất bại');
        }
    }
    function destroy($id)
    {
        $permission = $this->permission->onlyTrashed()->find($id)->forceDelete();
        if ($permission) {
            return redirect()->back()->with('msg', 'Xóa thành công');
        } else {
            return redirect()->back()->with('msgerr', 'Xóa thất bại');
        }
    }

    function getStringOptions($id, $data)
    {
        $recusive = new Recusive($data);
        return $recusive->getOptionsChildrent($id);
    }
}
