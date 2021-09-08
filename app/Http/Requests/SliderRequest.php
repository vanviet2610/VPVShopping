<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        return [
            'name' => 'required',
            'description' => 'required',
            'image' => 'max:20480'
        ];
    }
    function messages()
    {
        return [
            'name.required' => 'vui lòng nhập tên slider',
            'name.required' => 'vui lòng nhập nội dung',
            'image.max' => 'Hình ảnh quá lớn giới hạn dưới 10MB'
        ];
    }
}
