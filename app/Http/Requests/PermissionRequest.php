<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
            'display' => 'required'
        ];
    }

    function messages()
    {
     return [
         'name.required' => 'Vui lòng nhập tên permisson',
         'display.required' => 'Vui lòng nhập nội dung permisson',
     ];   
    }
}
