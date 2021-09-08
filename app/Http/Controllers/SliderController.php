<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Traits\ImageFunctions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SliderController extends Controller
{
    private $slider;
    use ImageFunctions;
    function __construct(Slider $slider)
    {
        $this->slider = $slider;
    }
    //
    function index()
    {
        $sliders = $this->slider->cursorPaginate(15);
        return view('admin.slider.index-slider', compact('sliders'));
    }
    function create()
    {
        return view('admin.slider.add-slider');
    }

    function store(SliderRequest $req)
    {
        try {
            $iamge =   $this->getFileName_FilePath($req->file('image'), 'slider');
            $this->slider->create([
                'name' => $req->name,
                'description' => $req->description,
                'file_name' => $iamge['file_name'],
                'file_path' => $iamge['file_path']
            ]);
            DB::commit();
            return redirect()->route('slider.create')->with('msg', 'Thêm slider thành công');
        } catch (\Exception $err) {
            DB::rollback();
            Log::error("create slider => " . $err->getMessage() . ' Line => ' . $err->getLine());
            return redirect()->route('slider.create')->with('msgerr', 'Thêm thất bại');
        }
    }

    function edit($id)
    {
        $sliders = $this->slider->find($id);
        return view('admin.slider.edit-slider', compact('sliders'));
    }

    function update($id, SliderRequest $req)
    {
        try {
            $sliders = $this->slider->find($id);
            if ($req->hasFile('image')) {
                $images =   $this->getFileName_FilePath($req->file('image'), 'slider');
                $sliders->update([
                    'name' => $req->name,
                    'description' => $req->description,
                    'file_name' => $images['file_name'],
                    'file_path' => $images['file_path'],
                ]);
            } else {
                $sliders->update([
                    'name' => $req->name,
                    'description' => $req->description,
                ]);
            }
            DB::commit();
            return redirect()->back()->with('msg', 'Chỉnh sửa thành công');
        } catch (\Exception $err) {
            DB::rollBack();
            Log::error("update slider => " . $err->getMessage() . ' Line => ' . $err->getLine());
            return redirect()->back()->with('msgerr', 'Chỉnh sửa thất bại');
        }
    }

    function delete($id)
    {
        $this->slider->find($id)->delete();
        return redirect()->back()->with('msg', 'Xóa thành công');
    }

    function trash()
    {
        $sliders =  $this->slider->onlyTrashed()->cursorPaginate(15);
        return view('admin.slider.trash-slider', compact('sliders'));
    }

    function restore($id)
    {
        $sliders = $this->slider->onlyTrashed()->find($id)->restore();
        if ($sliders) {
            return redirect()->back()->with('msg', 'Phục hồi thành công');
        } else {
            return redirect()->back()->with('msgerr', 'Phục hồi thành công');
        }
    }
    function forever($id)
    {
        $sliders = $this->slider->onlyTrashed()->find($id)->forceDelete();
        if ($sliders) {
            return redirect()->back()->with('msg', 'Xóa vĩnh viễn thành công');
        } else {
            return redirect()->back()->with('msgerr', 'Xóa thất bại');
        }
    }
}
