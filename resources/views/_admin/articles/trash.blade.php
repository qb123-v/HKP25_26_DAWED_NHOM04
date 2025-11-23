@extends('_admin._layouts.app')

@push('style')
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    <!-- fontawesome -->
@endpush

@section('content')
    <!--begin::App Main-->
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Quản lý tin tức</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Quản lý tin tức
                            </li>
                        </ol>
                    </div>
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
            <!--begin::Container-->
            <div class="container-fluid">
                @if (session('message'))
                    <div class="alert alert-{{ session('alert-type', 'success') }}">
                        {{ session('message') }}
                    </div>
                @endif
                <div class="card mb-4">
                    <div class="card-body">
                        <form method="get" action="{{ route('admin.articles.index') }}">
                            <div class="row">
                                <div class="col-md-2">
                                    <a href="{{ route('admin.articles.create') }}" class="btn btn-dark w-100">
                                        + Bài viết mới</a>
                                </div>
                                <div class="col-md-2">
                                    <select name="artist" id="" class="form-select" onchange="this.form.submit()">
                                        <option value="">Nghệ sĩ</option>
                                        @foreach($artists as $artist)
                                            <option value="{{ $artist->slug }}" {{ request('artist') == $artist->slug ? 'selected' : '' }}>{{ $artist->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="categorie" id="" class="form-select" onchange="this.form.submit()">
                                        <option value="">Chuyên mục</option>
                                        @foreach($categories as $categorie)
                                            <option value=" {{ $categorie->slug }}" {{ request('categorie') == $categorie->slug ? 'selected' : '' }}>{{ $categorie->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="view" id="" class="form-select" onchange="this.form.submit()">
                                        <option value="">Lượt xem</option>
                                        <option value="increase" {{ request('view') == 'increase' ? 'selected' : '' }}>Tăng
                                            dần</option>
                                        <option value="decrease" {{ request('view') == 'decrease' ? 'selected' : '' }}>Giảm
                                            dần</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <select name="posting_date" id="" class="form-select" onchange="this.form.submit()">
                                        <option value="">Ngày đăng</option>
                                        <option value="latest" {{ request('posting_date') == 'latest' ? 'selected' : '' }}>Mới
                                            nhất
                                        </option>
                                        <option value="oldest" {{ request('posting_date') == 'oldest' ? 'selected' : '' }}>Cũ
                                            nhất
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <div class="d-flex">
                                        <input type="text" class="form-control me-2" placeholder="Tìm kiếm..." name="search"
                                            value="{{ request('search') }}">
                                        <button class="btn btn-outline-secondary">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb-4"> <!--begin::Header-->
                    <div class="card-header ">
                        Danh sách bài viết ({{ $articles->total() }} bài viết)
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">STT</th>
                                    <th>Tiêu đề</th>
                                    <th>Danh mục</th>
                                    <th>Nghệ sĩ</th>
                                    <th>Lượt xem</th>
                                    <th>Ngày đăng</th>
                                    <th>Ngày sửa</th>
                                    <th width="100" class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($articles as $article)
                                    <tr class="align-middle">
                                        <td class="text-center">
                                            {{ $loop->iteration + ($articles->currentPage() - 1) * $articles->perPage() }}
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.articles.edit', $article->id) }}"
                                                class="text-decoration-none text-black fw-bold">{{ $article->title }}</a>
                                        </td>
                                        <td>
                                            {{ $article->categorie->name ?? '-' }}

                                        </td>
                                        <td>
                                            {{ $article->artist->name ?? '—' }}
                                        </td>
                                        <td>
                                            {{ $article->views }}
                                        </td>
                                        <td>
                                            {{ $article->created_at->format("H:i d/m/Y") }}
                                        </td>
                                        <td>
                                            {{ $article->updated_at->format("H:i d/m/Y") }}
                                        </td>
                                        <td class="text-center">
                                            <a target="_blank"
                                                href="{{ route('articles.show', [$article->id, $article->slug]) }}"
                                                class="text-decoration-none text-secondary"><i class="fa-solid fa-eye"></i></a>
                                            <a href="{{ route('admin.articles.edit', $article->id) }}"
                                                class="text-decoration-none text-secondary"><i
                                                    class="fa-solid fa-pen-to-square "></i></a>
                                            <form action="{{ route('admin.articles.destroy', [$article]) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#" class="fw-bold text-decoration-none text-secondary"
                                                    onclick="if (confirm('Bạn có chắc chắn muốn xóa bài viết?')) { this.closest('form').submit(); } return false;">
                                                    <i class="fa-solid fa-trash "></i>
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            Dữ liệu trống. Không có chuyên mục nào
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div> <!-- /.card-body -->
                    <!-- phân trang nếu quá 10 chuyên mục -->
                    @if ($articles->lastPage() > 1)
                        <div class="card-footer clearfix">
                            <div class="float-start mt-1">
                                Hiển thị {{ $articles->count() }} trên tổng số {{ $articles->total() }} chuyên mục
                            </div>
                            <ul class="pagination pagination-sm m-0 float-end">
                                {{-- Nút "Trước" --}}
                                @if ($articles->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">«</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $articles->previousPageUrl() }}">«</a>
                                    </li>
                                @endif

                                {{-- Danh sách các trang --}}
                                @for ($i = 1; $i <= $articles->lastPage(); $i++)
                                    <li class="page-item {{ $i == $articles->currentPage() ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $articles->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor

                                {{-- Nút "Sau" --}}
                                @if ($articles->hasMorePages())
                                    <li class="page-item"><a class="page-link" href="{{ $articles->nextPageUrl() }}">»</a></li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">»</span></li>
                                @endif
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->
@endsection