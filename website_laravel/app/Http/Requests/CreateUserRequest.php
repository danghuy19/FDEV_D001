<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'username' => 'required|min:5',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed|regex:/(^(\d+)$)/u',
            'password_confirmation' => 'required|min:8',
            'avatar' => 'image|mimes:jpg,png,jpeg,gif,svg|max:200'
        ];
    }

    public function messages(){
        return [
            'username.required' => 'Vui lòng nhập tên đăng nhập',
            'username.min' => 'username phải có ít nhất 5 ký tự',
            'email.required' => 'Vui lòng nhập Email',
            'email.email' => 'Email không hợp lệ',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu có ít nhất 8 ký tự',
            'password.confirmed' => 'Mật khẩu và nhập lại không giống nhau',
            'password.regex' => 'Mật khẩu chỉ cho phép nhập số',
            'password_confirmation.required' => 'Vui lòng nhập vào ô xác nhận mật khẩu',
            'password_confirmation.min' => 'Xác nhận Mật khẩu có ít nhất 8 ký tự',
            //'avatar.image' => 'test message',
            'avatar.mimes' => 'Đây là file không hợp lệ, hoặc là hình ảnh dạng mở rộng chưa được cho phép',
            'avatar.max' => 'Kích thước file quá lớn, vui lòng chọn file nhỏ hơn'
        ];
    }
}
