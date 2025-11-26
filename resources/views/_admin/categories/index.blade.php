@extends('_admin._layouts.app')

@section('content')
    <main class="app-main">

        <!-- Content Header -->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Quản lý chuyên mục</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Quản lý chuyên mục</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="app-content">
            <div class="container-fluid">
                @if (session('message'))
                    <div class="alert alert-{{ session('alert-type', 'success') }}">
                        {{ session('message') }}
                    </div>
                @endif
                <!-- Filter Row -->
                <form method="get" action="{{ route('admin.categories.index') }}" class="">
                    <div class="row mb-3">
                        <div class="col-md-2">
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-success">+ Chuyên mục mới</a>
                        </div>
                        <div class="col-md-2">
                            <input type="text" name="name" class="form-control" placeholder="Tên chuyên mục"
                                value="{{ request('name') }}">
                        </div>
                        <div class="col-md-2">
                            <select name="status" class="form-select">
                                <option value="">Trạng thái</option>
                                <option value="1">Hoạt động</option>
                                <option value="0">Không hoạt động</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select name="sort" class="form-select">
                                <option value="">Lượng bài viết</option>
                                <option value="increase">Tăng dần</option>
                                <option value="decrease">Giảm dần</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">Lọc</button>
                        </div>
                        <div class="col-md-2">
                            <a class="btn btn-warning w-100 " href="{{ route('admin.categories.index') }}">Xóa lọc</a>
                        </div>
                    </div>
                </form>

                <!-- Categories Table -->
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width:40px;">STT</th>
                            <th>Tên chuyên mục</th>
                            <th>Số lượng bài viết</th>
                            <th width="100px" class="text-center">Trạng thái</th>
                            <th width="150px">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td class="text-center">
                                    {{ $loop->iteration + ($categories->currentPage() - 1) * $categories->perPage() }}
                                </td>
                                <td>
                                    <a class="text-decoration-none text-black"
                                        href="{{ route('admin.categories.edit', $category->id) }}">{{ $category->name }}</a>
                                </td>
                                <td>
                                    {{ $category->articles_count }}
                                    <a href="{{ route('admin.articles.index', ['categorie' => $category->slug]) }}"><span
                                            class="ms-4 badge bg-warning">Xem danh sách</span></a>
                                </td>

                                <td class="text-center">
                                    <form action=" {{ route('admin.categories.status', $category->id)  }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button class="btn p-0 border-0 bg-transparent">
                                            @if ($category->status === 1)
                                                <span class="badge bg-success">Hoạt động</span>
                                            @else
                                                <span class="badge bg-secondary">Không hoạt động</span>
                                            @endif
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('admin.categories.edit', $category->id) }}">Edit</a>
                                    <form method="post" action="{{ route('admin.categories.destroy', $category->id) }} "
                                        class="d-inline">
                                        @csrf
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Bạn có chắc muốn xóa chuyên mục này?')">Delete</button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Không có chuyên mục nào</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if ($categories->lastPage() > 1)
                    <!-- Pagination -->
                    <div class="mt-3">
                        <nav aria-label="Page navigation">
                            <ul class="pagination">
                                <!-- Nút trước -->
                                @if ($categories->onFirstPage())
                                    <li class="page-item disabled">
                                        <a href="#" class="page-link">Trước</a>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $categories->previousPageUrl() }}">Trước</a>
                                    </li>
                                @endif
                                @for ($i = 1; $i <= $categories->lastPage(); $i++)
                                    <!-- Danh sách các trang -->
                                    <li class="page-item {{ $i == $categories->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $categories->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <!-- Nút sau -->
                                @if ($categories->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $categories->nextPageUrl() }}">Sau</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <a class="page-link" href="">Sau</a>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                @endif


            </div>
        </div>
    </main>


@endsection