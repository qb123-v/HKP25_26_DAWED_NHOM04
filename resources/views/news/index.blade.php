@extends('_layouts.app')
@section('title', 'Quản lý tin tức')

@push('styles')
    <!-- Ai sử dụng framework nào thì bỏ comment dòng đó -->

    <!-- Dòng này cho tailwind -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script> -->

    <!-- Dòng này cho bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@endpush

<!-- Dùng để import CDN/file js -->
@push('stylesjs')
    <!-- import js vào đây -->
@endpush


@section('content')
<main style="background:#fff;min-height:calc(100vh - 120px);">
    <!-- Global page header (moved to top) -->
    <div style="max-width:1200px;margin:0 auto;padding:1.25rem;padding-bottom:.5rem;">
        <h1 style="margin:0;font-size:1.6rem;font-weight:700;color:#111827;">Quản lý tin tức</h1>
        <p style="margin:.25rem 0 0;color:#6b7280;">Quản lý và chỉnh sửa các tin tức showbiz</p>
    </div>

    <div style="max-width:1200px;margin:0 auto;padding:0 1.25rem 1.25rem;display:flex;gap:1.25rem;">

        <!-- Left sidebar (filters) -->
        <aside style="width:280px;flex:0 0 280px;">
            <div style="border:1px solid #e5e7eb;border-radius:.75rem;background:#fff;overflow:hidden;">
                <!-- Top area: statuses -->
                <div style="padding:.85rem 1rem;border-bottom:1px solid #e5e7eb;">
                    <div style="font-weight:600;color:#111827;">Bộ lọc</div>
                </div>
                <div style="padding:.5rem 0;border-bottom:1px solid #e5e7eb;">
                    <div style="padding:.5rem 1rem;color:#6b7280;font-size:.85rem;text-transform:uppercase;">Trạng thái</div>
                    <ul style="list-style:none;margin:0;padding:.25rem .5rem .75rem;display:flex;flex-direction:column;gap:.15rem;">
                        <li>
                            <a href="#" style="display:flex;justify-content:space-between;align-items:center;text-decoration:none;color:#111827;padding:.5rem .5rem;border-radius:.5rem;">
                                <span><span style="margin-right:.5rem">🗂️</span>1. Tất cả bài viết</span>
                                <span style="background:#f3f4f6;color:#374151;font-size:.75rem;padding:.1rem .45rem;border-radius:999px;">—</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" style="display:flex;justify-content:space-between;align-items:center;text-decoration:none;color:#111827;padding:.5rem .5rem;border-radius:.5rem;">
                                <span><span style="margin-right:.5rem">📝</span>2. Bản nháp</span>
                                <span style="background:#f3f4f6;color:#374151;font-size:.75rem;padding:.1rem .45rem;border-radius:999px;">—</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" style="display:flex;justify-content:space-between;align-items:center;text-decoration:none;color:#111827;padding:.5rem .5rem;border-radius:.5rem;">
                                <span><span style="margin-right:.5rem">✅</span>3. Đã xuất bản</span>
                                <span style="background:#f3f4f6;color:#374151;font-size:.75rem;padding:.1rem .45rem;border-radius:999px;">—</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" style="display:flex;justify-content:space-between;align-items:center;text-decoration:none;color:#111827;padding:.5rem .5rem;border-radius:.5rem;">
                                <span><span style="margin-right:.5rem">⏳</span>4. Chờ duyệt</span>
                                <span style="background:#f3f4f6;color:#374151;font-size:.75rem;padding:.1rem .45rem;border-radius:999px;">—</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" style="display:flex;justify-content:space-between;align-items:center;text-decoration:none;color:#b91c1c;padding:.5rem .5rem;border-radius:.5rem;">
                                <span><span style="margin-right:.5rem">🗑️</span>5. Thùng rác</span>
                                <span style="background:#fee2e2;color:#991b1b;font-size:.75rem;padding:.1rem .45rem;border-radius:999px;">—</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Bottom area: categories -->
                <div style="padding:.5rem 0;">
                    <div style="padding:.5rem 1rem;color:#6b7280;font-size:.85rem;text-transform:uppercase;">Chuyên mục</div>
                    <ul style="list-style:none;margin:0;padding:.25rem .5rem .75rem;display:flex;flex-direction:column;gap:.15rem;">
                        <li>
                            <a href="#" style="display:block;text-decoration:none;color:#111827;padding:.5rem .5rem;border-radius:.5rem;"><span style="margin-right:.5rem">🎬</span>1. Điện ảnh</a>
                        </li>
                        <li>
                            <a href="#" style="display:block;text-decoration:none;color:#111827;padding:.5rem .5rem;border-radius:.5rem;"><span style="margin-right:.5rem">🎵</span>2. Âm nhạc</a>
                        </li>
                        <li>
                            <a href="#" style="display:block;text-decoration:none;color:#111827;padding:.5rem .5rem;border-radius:.5rem;"><span style="margin-right:.5rem">⭐</span>3. Sao Việt</a>
                        </li>
                        <li>
                            <a href="#" style="display:block;text-decoration:none;color:#111827;padding:.5rem .5rem;border-radius:.5rem;"><span style="margin-right:.5rem">🌍</span>4. Sao ngoại</a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>

        <!-- Main content area -->
        <section style="flex:1;min-width:0;">

            <!-- Prototype table area -->
            <div style="border:1px solid #e5e7eb;border-radius:.75rem;background:#fff;overflow:hidden;">
                <!-- Top toolbar (right aligned) -->
                <div style="display:flex;justify-content:flex-end;gap:.5rem;align-items:center;padding:.75rem 1rem;border-bottom:1px solid #e5e7eb;background:#fafafa;flex-wrap:wrap;">
                    <a href="/admin/news/create" style="text-decoration:none;background:#2563eb;color:#fff;padding:.5rem .8rem;border-radius:.5rem;font-size:.9rem;white-space:nowrap;">+ Tạo bài viết mới</a>
                    <button type="button" style="background:#f3f4f6;color:#111827;padding:.5rem .8rem;border:1px solid #e5e7eb;border-radius:.5rem;font-size:.9rem;cursor:pointer;white-space:nowrap;">Tất cả trạng thái</button>
                    <button type="button" style="background:#f3f4f6;color:#111827;padding:.5rem .8rem;border:1px solid #e5e7eb;border-radius:.5rem;font-size:.9rem;cursor:pointer;white-space:nowrap;">Tất cả thể loại</button>
                    <div style="position:relative;min-width:260px;">
                        <input type="text" placeholder="Tìm kiếm bài viết" style="width:100%;border:1px solid #e5e7eb;border-radius:.5rem;padding:.5rem .75rem;font-size:.9rem;">
                        <span style="position:absolute;right:.6rem;top:50%;transform:translateY(-50%);color:#9ca3af;">🔎</span>
                    </div>
                </div>

                <!-- Table header -->
                <div style="display:grid;grid-template-columns:44px 1fr 140px 140px 160px 160px;gap:0;border-bottom:1px solid #e5e7eb;background:#fff;">
                    <div style="padding:.7rem 1rem;border-right:1px solid #e5e7eb;background:#fcfcfc;display:flex;align-items:center;">
                        <input type="checkbox" aria-label="Chọn tất cả">
                    </div>
                    <div style="padding:.7rem 1rem;font-weight:600;color:#111827;border-right:1px solid #e5e7eb;background:#fcfcfc;">Tiêu đề</div>
                    <div style="padding:.7rem 1rem;font-weight:600;color:#111827;border-right:1px solid #e5e7eb;background:#fcfcfc;">Trạng thái</div>
                    <div style="padding:.7rem 1rem;font-weight:600;color:#111827;border-right:1px solid #e5e7eb;background:#fcfcfc;">Tác giả</div>
                    <div style="padding:.7rem 1rem;font-weight:600;color:#111827;border-right:1px solid #e5e7eb;background:#fcfcfc;">Ngày tạo</div>
                    <div style="padding:.7rem 1rem;font-weight:600;color:#111827;background:#fcfcfc;">Thao tác</div>
                </div>

                <!-- Table rows (fake data) -->
                @foreach([1,2,3,4,5] as $i)
                    <div style="display:grid;grid-template-columns:44px 1fr 140px 140px 160px 160px;gap:0;border-top:1px solid #f3f4f6;">
                        <!-- checkbox -->
                        <div style="padding:.8rem 1rem;display:flex;align-items:center;">
                            <input type="checkbox" aria-label="Chọn bài viết {{ $i }}">
                        </div>
                        <!-- title + thumb -->
                        <div style="padding:.8rem 1rem;display:flex;gap:.75rem;align-items:center;min-width:0;">
                            <div style="width:56px;height:38px;background:#f3f4f6;border:1px solid #e5e7eb;border-radius:.4rem;flex:0 0 56px;"></div>
                            <div style="min-width:0;">
                                <div style="font-weight:600;color:#111827;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">Bài viết demo số {{ $i }}</div>
                                <div style="font-size:.85rem;color:#6b7280;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">Mô tả ngắn nội dung bài viết...</div>
                            </div>
                        </div>
                        <!-- status -->
                        <div style="padding:.8rem 1rem;color:#16a34a;font-weight:600;white-space:nowrap;">Xuất bản</div>
                        <!-- author -->
                        <div style="padding:.8rem 1rem;color:#374151;white-space:nowrap;">Admin</div>
                        <!-- created date -->
                        <div style="padding:.8rem 1rem;color:#6b7280;white-space:nowrap;">12/11/2025</div>
                        <!-- actions (icons) -->
                        <div style="padding:.6rem 1rem;display:flex;gap:.35rem;align-items:center;flex-wrap:wrap;">
                            <a href="#" title="Xem" aria-label="Xem" style="text-decoration:none;display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:.4rem;border:1px solid #dbeafe;background:#eff6ff;color:#2563eb;font-size:16px;">👁️</a>
                            <a href="#" title="Sửa" aria-label="Sửa" style="text-decoration:none;display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:.4rem;border:1px solid #d1fae5;background:#ecfdf5;color:#065f46;font-size:16px;">✏️</a>
                            <a href="#" title="Xoá" aria-label="Xoá" style="text-decoration:none;display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:.4rem;border:1px solid #fee2e2;background:#fef2f2;color:#991b1b;font-size:16px;">🗑️</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div style="display:flex;justify-content:flex-end;gap:.5rem;margin-top:1rem;">
                <a href="#" style="text-decoration:none;color:#374151;border:1px solid #e5e7eb;padding:.45rem .75rem;border-radius:.5rem;background:#fff;">Trước</a>
                <a href="#" style="text-decoration:none;color:#fff;background:#2563eb;padding:.45rem .75rem;border-radius:.5rem;">Sau</a>
            </div>
        </section>

    </div>
</main>
@endsection