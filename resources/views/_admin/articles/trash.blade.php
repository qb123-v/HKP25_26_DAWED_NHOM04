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
                        <h3 class="mb-0">Bài viết đã xóa</h3>
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
                                            {{ $article->title }}
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
                                            <form action="{{ route('admin.articles.restore', [$article->id]) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <a href="#" class="fw-bold text-decoration-none text-secondary me-3"
                                                    onclick="if (confirm('Bạn có chắc chắn muốn khôi phục bài viết?')) { this.closest('form').submit(); } return false;">
                                                    <i class="fa-solid fa-recycle"></i>
                                                </a>
                                            </form>
                                            <form action="{{ route('admin.articles.forceDelete', [$article]) }}" method="POST"
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