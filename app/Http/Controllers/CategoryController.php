<?php

namespace App\Http\Controllers;

use App\Components\Recusive;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //
    private $category;
    function __construct(Category $category)
    {
        $this->category = $category;
    }

    function index()
    {
        $category = $this->category->paginate(10);
        return view('admin.category.index-category', compact('category'));
    }
    function create()
    {
        $stringOptions = $this->getStringOptions('', $this->category->all());

        return view('admin.category.add-category', compact('stringOptions'));
    }
    function store(Request $req)
    {
        $this->validate($req, [
            'name' => 'required'
        ], [
            'name.required' => 'vui lòng nhập tên category'
        ]);

        try {
            $this->category->create([
                'name' => $req->name,
                'parent_id' => $req->parent_id,
                'slug' => Str::slug($req->name),
            ]);
            return redirect()->back()->with('msg', 'Thêm thành công');
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error("Create Category => " . $err->getMessage() . ' Line => ' . $err->getLine());
            return redirect()->back()->with('msgerr', 'Thêm không thành công');
        }
    }

    function edit($id)
    {
        $category =   $this->category->find($id);
        $stringOptions = $this->getStringOptions($category->parent_id, $this->category->all());
        return view('admin.category.edit-category', compact('category', 'stringOptions'));
    }

    function update($id, Request $req)
    {
        $this->validate($req, [
            'name' => 'required'
        ], [
            'name.required' => 'vui lòng nhập tên category'
        ]);

        try {
            $category =  $this->category->find($id);
            $category->update([
                'name' => $req->name,
                'parent_id' => $req->parent_id,
                'slug' => Str::slug($req->name)
            ]);
            DB::commit();
            return redirect()->back()->with('msg', 'Sửa thành công');
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error("Update category => " . $err->getMessage() . ' Line => ' . $err->getLine());
            return redirect()->back()->with('msgerr', 'Sửa thất bại');
        }
    }

    function delete($id)
    {
        $category =   $this->category->find($id)->delete();
        if ($category) {
            return redirect()->back()->with('msg', 'Xóa thành công');
        } else {
            return redirect()->back()->with('msgerr', 'Xóa thất bại');
        }
    }

    function trash()
    {
        $category =   $this->category->onlyTrashed()->Paginate(10);
        return view('admin.category.trash-category', compact('category'));
    }
    function restore($id)
    {
        $category =  $this->category->onlyTrashed()->find($id)->restore();
        if ($category) {
            return redirect()->back()->with('msg','Phục hồi thành công');
        }else{
            return redirect()->back()->with('msgerr','Phục hồi thất bại');
        }
    }
    function forever($id)
    {
        $category = $this->category->onlyTrashed()->find($id)->forceDelete();
        if ($category) {
            return redirect()->back()->with('msg','Xóa thành công');
        }else{
            return redirect()->back()->with('msgerr','Xóa thất bại');
        }
    }




    function getStringOptions($id, $data)
    {
        $recusive = new Recusive($data);
        return $recusive->getOptionsChildrent($id);
    }
}
