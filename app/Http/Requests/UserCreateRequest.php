<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Email;

class UserCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8'

        ];
    }
    public function messages()
    {
        return [
            'name' => 'Vui lòng nhập tên của bạn',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã được đăng ký',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải dài hơn 8 ký tự',
            'password_confirmation.required' => 'Nhập mật khẩu xác nhận',
            'password_confirmation.min' => 'Mật khẩu phải dài hơn 8 ký tự',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp',
        ];
    }
}
