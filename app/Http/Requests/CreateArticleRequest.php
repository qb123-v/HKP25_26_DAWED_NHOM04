<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateArticleRequest extends FormRequest
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
            'slug' => 'string|required|unique:articles,slug',
            'title' => 'string|required',
            'tag' => 'nullable|string',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'categorie_id' => 'nullable|integer|min:1|exists:categories,id',
            'artist_id' => 'nullable|integer|min:1|exists:artists,id',
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:2048'
        ];
    }
    public function messages(): array
    {
        return [
            'slug.required' => 'Không bỏ trống đường dẫn',
            'slug.string' => 'Ký tự nhập không hợp lệ',
            'slug.unique' => 'Dường dẫn cho bài viết này đã tồn tại',

            'title.required' => 'Không bỏ trống tiêu đề',
            'title.string' => 'Ký tự nhập không hợp lệ',

            'tag.string' => 'Ký tự nhập không hợp lệ',

            'description.string' => 'Ký tự nhập không hợp lệ',

            'categorie_id.exists' => 'Danh mục không tồn tại',
            'categorie_id.integer' => 'Danh mục không tồn tại',
            'categorie_id.min' => 'Danh mục không tồn tại',

            'artist_id.exists' => 'Nghệ sĩ không tồn tại',
            'artist_id.integer' => 'Nghệ sĩ không tồn tại',
            'artist_id.min' => 'Nghệ sĩ không tồn tại',

            'thumbnail.required' => 'Chưa chọn thumbnail cho bài viết',
            'thumbnail.image' => 'Tải lên không hợp lệ, vui lòng upload hình ảnh',
            'thumbnail.mimes' => 'Định dạng ảnh không được hỗ trợ',
            'thumbnail.max' => 'Kích thước file quá lớn. Chọn ảnh kích thước < 2049 Mb',
        ];
    }
}
