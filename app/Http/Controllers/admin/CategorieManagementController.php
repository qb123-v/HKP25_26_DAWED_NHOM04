<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCatecorieRequest;
use App\Models\Categorie;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;

class CategorieManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = Categorie::query()->withCount('articles');

        // Xử lý các tham số get
        // Lọc theo tên
        if ($request->filled('name'))
        {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Lọc theo trạng thái
        if ($request->filled('status'))
        {
            $query->where('status', $request->status);
        }

        // Sắp xếp theo số lượng bài viết
        if ($request->filled('sort'))
        {
            if ($request->sort == 'increase')
            {
                $query->orderBy('articles_count', 'asc');
            }

            if ($request->sort == 'decrease')
            {
                $query->orderBy('articles_count', 'desc');
            }
        }
        // Nếu không có sắp xếp nào, mặc định mới nhất
        if (!$request->filled('sort') && !$request->filled('status') && !$request->filled('name'))
        {
            $query->orderBy('created_at', 'desc');
        }

        // Phân trang + giữ query string
        $categories = $query->paginate(10)->withQueryString();
        return view('_admin.categories.index', compact('categories'));
    }
    public function create()
    {
        return view('_admin.categories.create');
    }
    public function store(CreateCategoryRequest $request)
    {
        // Chuẩn bị dữ liệu lưu
        $data = $request->only([
            'slug',
            'name',
            'description',
        ]);

        // Xử lý thumbnail nếu có upload
        if ($request->hasFile('thumbnail'))
        {
            $file = $request->file('thumbnail');

            // Đổi tên file: timestamp + slug + extension
            $filename = time() . '_' . \Str::slug($data['slug']) . '.' . $file->getClientOriginalExtension();

            // Lưu file vào storage/app/public/images/categories
            $path = $file->storeAs('images/categories', $filename, 'public');

            $data['thumbnail'] = $filename;
        }
        // Xóa các trường trống
        foreach ($data as $key => $value)
        {
            if (is_null($value))
            {
                unset($data[$key]);
            }
        }
        // Tạo bài viết mới
        Categorie::create($data);

        return redirect()->route('admin.categories.index')->with('message', 'Tạo chuyên mục thành công');
    }
    public function edit($id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('_admin.categories.edit')->with('categorie', $categorie);
    }
    public function update(UpdateCatecorieRequest $request, $id)
    {
        // Tìm chuyên mục hoặc báo lỗi nếu không có
        $category = Categorie::findOrFail($id);

        // Chuẩn bị dữ liệu cập nhật
        $data = $request->only([
            'slug',
            'name',
            'description',
            'status',
        ]);

        // Xử lý thumbnail nếu có upload
        if ($request->hasFile('thumbnail'))
        {
            $file = $request->file('thumbnail');

            // Đổi tên file: timestamp + slug + extension
            $filename = time() . '_' . \Str::slug($data['slug']) . '.' . $file->getClientOriginalExtension();

            // Lưu file vào storage/app/public/images/categories
            $path = $file->storeAs('images/categories', $filename, 'public');

            $data['thumbnail'] = $filename;

            // Xóa file thumbnail cũ nếu có
            if ($category->thumbnail)
            {
                $oldFilePath = 'images/categories/' . $category->thumbnail;
                if (\Storage::disk('public')->exists($oldFilePath))
                {
                    \Storage::disk('public')->delete($oldFilePath);
                }
            }
        }

        // Xóa các trường trống
        foreach ($data as $key => $value)
        {
            if (is_null($value))
            {
                unset($data[$key]);
            }
        }

        // Cập nhật chuyên mục
        $category->update($data);

        return redirect()->route('admin.categories.index')->with('message', 'Cập nhật chuyên mục thành công');
    }
    public function destroy($id)
    {
        // Tìm chuyên mục hoặc báo lỗi nếu không có
        $category = Categorie::findOrFail($id);

        // Xoá chuyên mục
        $category->delete();
        return redirect()->back()->with('message', 'Đã xóa chuyên mục thành công');
    }
    public function status($id)
    {
        // Tìm chuyên mục
        $category = Categorie::findOrFail($id);

        // Đảo trạng thái (toggle)
        $category->status = $category->status == 1 ? 0 : 1;

        // Lưu thay đổi
        $category->save();
        return redirect()->back()->with('message', 'Cập nhật trạng thái thành công');
    }
}
