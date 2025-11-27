<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'slug' => 'required|string|unique:categories,slug',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048'
        ];
    }
    public function messages(): array
    {
        return [
            'slug.required' => 'Không bỏ trống đường dẫn',
            'slug.string' => 'Ký tự nhập không hợp lệ',
            'slug.unique' => 'Đường dẫn cho chuyên mục này đã tồn tại',

            'name.required' => 'Không bỏ trống tiêu đề',
            'name.string' => 'Ký tự nhập không hợp lệ',


            'thumbnail.required' => 'Chưa chọn thumbnail cho bài viết',
            'thumbnail.image' => 'Tải lên không hợp lệ, vui lòng upload hình ảnh',
            'thumbnail.mimes' => 'Định dạng ảnh không được hỗ trợ',
            'thumbnail.max' => 'Kích thước file quá lớn. Chọn ảnh kích thước < 2049 Mb',
        ];
    }
}
