<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (is_null($this->route()->id)) {
            return [
                'title' => 'required',
                'content' => 'required',
                'price' => 'required|numeric',
                'imagefeature' => 'required|max:10240',
                'imagemutil' => 'required|max:30720',
                'tags' => 'required',
                'category' => 'required'
            ];
        } else {
            return [
                'title' => 'required',
                'content' => 'required',
                'price' => 'required|numeric',
                'imagefeature' => 'nullable|max:10240',
                'imagemutil' => 'nullable|max:30720',
                'tags' => 'required',
                'category' => 'required'
            ];
        }
    }
    public function messages()
    {
        if (is_null($this->route()->id)) {
            return [
                'title.required' => "Vui lòng nhập tiêu đề sản phẩm",
                'category.required' => "Vui lòng chọn thể loại sản phẩm",
                'content.required' => "Vui lòng nhập nội dung sản phẩm",
                'price.required' => "Vui lòng nhập giá sản phẩm",
                'price.numeric' => "vui lòng nhập bằng số",
                'imagefeature.required' => "Vui lòng nhập hình ảnh chính sản phẩm",
                'imagefeature.max' => "giới hạn hình ảnh chính product 10MB",
                'imagemutil.required' => "Vui lòng nhập  hình ảnh kèm thêm sản phẩm",
                'imagemutil.max' => "Giới hạn imahình ảnh kèm thêm sản phẩm 30MB",
                'tags.required' => "Vui lòng nhập thẻ sản phẩm",
            ];
        } else {
            return [
                'title.required' => "Vui lòng nhập tiêu đề sản phẩm",
                'category.required' => "Vui lòng chọn thể loại sản phẩm",
                'content.required' => "Vui lòng nhập nội dung sản phẩm",
                'price.required' => "Vui lòng nhập giá sản phẩm",
                'price.numeric' => "vui lòng nhập bằng số",
                'imagefeature.max' => "giới hạn hình ảnh chính product 10MB",
                'imagemutil.max' => "Giới hạn imahình ảnh kèm thêm sản phẩm 30MB",
                'tags.required' => "Vui lòng nhập thẻ sản phẩm",
            ];
        }
    }
}
