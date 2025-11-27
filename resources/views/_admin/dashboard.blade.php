@extends('_admin._layouts.app')

@section('content')
    <!--begin::App Main-->
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Thống kê</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!--end::App Content Header-->

        <!--begin::App Content-->
        <div class="app-content">
            <div class="container-fluid">

                <!-- 4 ô thống kê lớn -->
                <div class="row g-4 mb-7">
                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="flex-shrink-0 bg-primary bg-opacity-10 text-primary rounded-3 p-3 me-4">
                                    <i class="ki-outline ki-file-added fs-2qx"></i>
                                </div>
                                <div>
                                    <div class="fs-3 fw-bold text-gray-800">
                                        {{ number_format(\App\Models\Article::count()) }}</div>
                                    <div class="text-gray-600 fw-medium">Tổng bài viết</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="flex-shrink-0 bg-success bg-opacity-10 text-success rounded-3 p-3 me-4">
                                    <i class="ki-outline ki-eye fs-2qx"></i>
                                </div>
                                <div>
                                    <div class="fs-3 fw-bold text-gray-800">
                                        {{ number_format(\App\Models\Article::sum('views')) }}</div>
                                    <div class="text-gray-600 fw-medium">Tổng lượt xem</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="flex-shrink-0 bg-warning bg-opacity-10 text-warning rounded-3 p-3 me-4">
                                    <i class="ki-outline ki-calendar-add fs-2qx"></i>
                                </div>
                                <div>
                                    <div class="fs-3 fw-bold text-gray-800">
                                        {{ \App\Models\Article::whereDate('created_at', today())->count() }}</div>
                                    <div class="text-gray-600 fw-medium">Bài viết hôm nay</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-xl-3">
                        <div class="card border-0 shadow-sm h-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="flex-shrink-0 bg-info bg-opacity-10 text-info rounded-3 p-3 me-4">
                                    <i class="ki-outline ki-message-text-2 fs-2qx"></i>
                                </div>
                                <div>
                                    <div class="fs-3 fw-bold text-gray-800">{{ \App\Models\Comment::count() }}</div>
                                    <div class="text-gray-600 fw-medium">Tổng bình luận</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <!-- Top 10 bài hot -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0 text-white">Top 10 bài viết được xem nhiều nhất</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th class="ps-4">STT</th>
                                        <th>Tiêu đề</th>
                                        <th>Nghệ sĩ</th>
                                        <th class="text-end pe-4">Lượt xem</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @forelse(\App\Models\Article::with('artist')->orderByDesc('views')->take(10)->get() as $index => $item)
                                        <tr>
                                            <td class="ps-4 fw-bold text-gray-600">{{ $index + 1 }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if ($item->thumbnail)
                                                        <img src="{{ asset('storage/images/articles/' . $item->thumbnail ?? 'images/no-image.jpg') }}"
                                                            class="rounded me-3" width="60" height="60"
                                                            style="object-fit: cover;" alt="{{ $item->title }}">
                                                    @else
                                                        <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center"
                                                            style="width:60px;height:60px;">
                                                            <i class="ki-outline ki-picture fs-2x text-gray-400"></i>
                                                        </div>
                                                    @endif
                                                    <a href="{{ route('articles.show', ['id' => $item->id, 'slug' => $item->slug]) }}"
                                                        class="text-hover-primary fw-semibold" style="max-width: 380px;">
                                                        {{ Str::limit($item->title, 60) }}
                                                    </a>
                                                </div>
                                            </td>
                                            <td class="text-gray-700">{{ $item->artist?->name ?? '—' }}</td>
                                            <td class="text-end pe-4 fw-bold text-success">
                                                {{ number_format($item->views) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-9 text-gray-500">Chưa có lượt xem</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->
@endsection
