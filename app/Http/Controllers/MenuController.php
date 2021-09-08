<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MenuController extends Controller
{
    private $menu;
    function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    function index()
    {
        $menus =  $this->menu->cursorPaginate(15);
        return view('admin.menu.index-menu', compact('menus'));
    }

    function create()
    {
        $options = $this->getOptions(null);
        return view('admin.menu.add-menu', compact('options'));
    }

    function store(MenuRequest $req)
    {
        try {
            $this->menu->create([
                'name' => $req->name,
                'parent_id' => $req->parent_id,
            ]);
            DB::commit();
            return redirect()->back()->with('msg', 'Thêm thành công');
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error("Create Menu ==>> " . $err->getMessage() . ' Line =>> ' . $err->getLine());
        }
    }
    function edit($id)
    {
        $menus = $this->menu->find($id);
        $options = $this->getOptions($menus->parent_id);
        return view('admin.menu.edit-menu', compact('options', 'menus'));
    }

    function update($id, MenuRequest $req)
    {
        try {
            $this->menu->find($id)->update([
                'name' => $req->name,
                'parent_id' => $req->parent_id
            ]);
            DB::commit();
            return redirect()->back()->with('msg', 'chỉnh sửa thành công');
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error("Edit Menu ==>> " . $err->getMessage() . ' Line =>> ' . $err->getLine());
        }
    }

    function delete($id)
    {
        $this->menu->find($id)->delete();
        return redirect()->back()->with('msg', 'xóa thành công');
    }

    function trash()
    {
        $menus = $this->menu->onlyTrashed()->cursorPaginate(15);
        return view('admin.menu.trash-menu', compact('menus'));
    }

    function restore($id)
    {
        $this->menu->onlyTrashed()->find($id)->restore();
        return redirect()->back()->with('msg', 'Khôi phục thành công');
    }

    function forever($id)
    {
        $this->menu->onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('msg', 'Xóa thành công');
    }

    function getOptions($id)
    {
        $menuOptions = new Recusive($this->menu->all());
        return $menuOptions->getOptionsChildrent($id);
    }
}
