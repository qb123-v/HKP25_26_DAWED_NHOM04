<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleUpdateRequest extends FormRequest
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
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('articles', 'slug')->ignore($this->route('article')),
            ],
            'title' => 'required|string',
            'tag' => 'nullable|string',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            'categorie_id' => 'nullable|integer|min:1|exists:categories,id',
            'artist_id' => 'nullable|integer|min:1|exists:artists,id',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048'
        ];
    }
    public function messages()
    {
        return [
            'slug.required' => 'Không bỏ trống đường dẫnss',
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

            'thumbnail.image' => 'Tải lên không hợp lệ, vui lòng upload hình ảnh',
            'thumbnail.mimes' => 'Định dạng ảnh không được hỗ trợ',
            'thumbnail.max' => 'Kích thước file quá lớn. Chọn ảnh kích thước < 2049 Mb',

        ];
    }
}
