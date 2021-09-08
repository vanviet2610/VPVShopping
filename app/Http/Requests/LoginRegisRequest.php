<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRegisRequest extends FormRequest
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
            'name' => 'bail|required|min:3',
            'email' => 'bail|required|email:filter|unique:users,email',
            'password' => 'required',
            'password_confirm' => 'bail|required|same:password'
        ];
    }
    function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên ',
            'name.min' => 'Tên không nhỏ hơn 3 ký tự',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập đúng định dạng email ví dụ @gmail.com',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password_confirm.required' => 'Vui lòng nhập lại mật khẩu',
            'password_confirm.same' => 'Mật khẩu nhập lại không đúng ',
        ];
    }
}
