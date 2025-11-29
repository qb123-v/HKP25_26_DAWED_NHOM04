<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleUpdateRequest;
use App\Http\Requests\CreateArticleRequest;
use App\Models\Article;
use App\Models\Artist;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ArticleManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Article::query();

        // Lọc theo category
        if ($request->filled('categorie'))
        {
            $query->whereHas('categorie', function ($q) use ($request) {
                $q->where('slug', $request->categorie);
            });
        }

        // Lọc theo artist
        if ($request->filled('artist'))
        {
            $query->whereHas('artist', function ($q) use ($request) {
                $q->where('slug', $request->artist);
            });
        }

        // Lọc theo search title
        if ($request->filled('search'))
        {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Sắp xếp theo views
        if ($request->filled('view'))
        {
            if ($request->view === 'increase')
            {
                $query->orderBy('views', 'asc');
            } elseif ($request->view === 'decrease')
            {
                $query->orderBy('views', 'desc');
            }
        }

        // Sắp xếp theo posting_date
        if ($request->filled('posting_date'))
        {
            if ($request->posting_date === 'oldest')
            {
                $query->orderBy('created_at', 'asc');
            } elseif ($request->posting_date === 'latest')
            {
                $query->orderBy('created_at', 'desc');
            }
        }

        // Nếu không có sắp xếp nào, mặc định mới nhất
        if (!$request->filled('view') && !$request->filled('posting_date'))
        {
            $query->orderBy('created_at', 'desc');
        }

        $articles = $query->paginate(10)->withQueryString(); // giữ query string khi phân trang
        $artists = Artist::all();
        $categories = Categorie::all();
        return view('_admin.articles.index', compact('articles', 'artists', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        $artists = Artist::all();
        return view('_admin.articles.create', compact('categories', 'artists'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateArticleRequest $request)
    {
        // Chuẩn bị dữ liệu lưu
        $data = $request->only([
            'slug',
            'title',
            'tag',
            'description',
            'content',
            'categorie_id',
            'artist_id'
        ]);

        // Xử lý thumbnail nếu có upload
        if ($request->hasFile('thumbnail'))
        {
            $file = $request->file('thumbnail');

            // Đổi tên file: timestamp + slug + extension
            $filename = time() . '_' . \Str::slug($data['slug']) . '.' . $file->getClientOriginalExtension();

            // Lưu file vào storage/app/public/images/articles
            $path = $file->storeAs('images/articles', $filename, 'public');

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
        Article::create($data);

        return redirect()
            ->route('admin.articles.index')
            ->with('message', 'Thêm bài viết mới thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Tìm bài viết theo ID, kèm quan hệ
        $article = Article::with(['artist', 'categorie'])->findOrFail($id);

        // Lấy categories và artists để hiển thị trong form edit
        $categories = Categorie::all();
        $artists = Artist::all();
        return view('_admin.articles.edit', compact('article', 'categories', 'artists'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleUpdateRequest $request, string $id)
    {
        $article = Article::findOrFail($id);
        // Chuẩn bị dữ liệu lưu
        $data = $request->only([
            'slug',
            'title',
            'tag',
            'description',
            'content',
            'categorie_id',
            'artist_id'
        ]);

        // Xử lý thumbnail nếu có upload
        if ($request->hasFile('thumbnail'))
        {
            $file = $request->file('thumbnail');

            // Đổi tên file: timestamp + slug + extension
            $filename = time() . '_' . \Str::slug($data['slug']) . '.' . $file->getClientOriginalExtension();

            // Lưu file vào storage/app/public/images/articles
            $path = $file->storeAs('images/articles', $filename, 'public');

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
        $article->update($data);

        return redirect()
            ->route('admin.articles.index')
            ->with('message', 'Cập nhật bài viết thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()
            ->route('admin.articles.index')
            ->with('message', 'Đã xóa bài viết thành công!');

    }
    public function ckeditorUpload(Request $request)
    {
        if ($request->hasFile('upload'))
        {
            $file = $request->file('upload');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/ckeditor'), $filename);

            $url = asset('uploads/ckeditor/' . $filename);

            return response()->json([
                'uploaded' => 1,
                'fileName' => $filename,
                'url' => $url
            ]);
        }
    }
    // Hiển thị danh sách nháp
    public function drafts()
    {

    }
    // Đăng thành lên tin
    public function publish()
    {

    }
    // hiển thị thùng rác
    public function trash()
    {
        $articles = Article::onlyTrashed()
            ->orderBy('deleted_at', 'desc')
            ->paginate(10);

        return view('_admin.articles.trash', compact('articles'));
    }
    // khôi phục bài đã xóa
    public function restore($id)
    {
        $article = Article::onlyTrashed()->findOrFail($id);
        $article->restore();

        return redirect()
            ->route('admin.articles.trash')
            ->with('message', 'Đã khôi phục bài viết thành công!');
    }
    // Xóa luôn
    public function forceDelete($id)
    {
        $article = Article::onlyTrashed()->findOrFail($id);
        $article->forceDelete();

        return redirect()
            ->route('admin.articles.trash')
            ->with('message', 'Đã xóa vĩnh viễn bài viết thành công!');
    }
}
