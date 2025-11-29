@extends('_layouts.app')
@section('title', 'Quản lý thông tin nghệ sĩ')

@section('content')
<main style="background:#fff;min-height:calc(100vh - 120px);">
    <!-- Global page header -->
    <div style="max-width:1200px;margin:0 auto;padding:1.25rem;padding-bottom:.5rem;">
        <h1 style="margin:0;font-size:1.6rem;font-weight:700;color:#111827;">Quản lý thông tin nghệ sĩ</h1>
    </div>

    <div style="max-width:1200px;margin:0 auto;padding:0 1.25rem 1.25rem;display:flex;flex-direction:column;gap:1rem;">
        <!-- Top toolbar (search & filters) -->
        <div style="border:1px solid #e5e7eb;border-radius:.75rem;background:#fff;overflow:hidden;">
            <div style="display:flex;gap:.6rem;align-items:center;padding:.85rem 1rem;background:#fafafa;flex-wrap:wrap;">
                <div style="position:relative;min-width:260px;flex:1;">
                    <input type="text" placeholder="Tìm kiếm nghệ sĩ" style="width:100%;border:1px solid #e5e7eb;border-radius:.5rem;padding:.55rem .9rem;font-size:.95rem;">
                    <span style="position:absolute;right:.65rem;top:50%;transform:translateY(-50%);color:#9ca3af;">🔎</span>
                </div>
                <div>
                    <label style="display:block;font-size:.8rem;color:#6b7280;margin-bottom:.25rem;">Thể loại</label>
                    <select style="border:1px solid #e5e7eb;border-radius:.5rem;padding:.55rem .7rem;font-size:.95rem;color:#374151;min-width:180px;">
                        <option>Tất cả</option>
                        <option>Ca sĩ</option>
                        <option>Diễn viên</option>
                        <option>Nhạc sĩ</option>
                        <option>Người mẫu</option>
                    </select>
                </div>
                <div>
                    <label style="display:block;font-size:.8rem;color:#6b7280;margin-bottom:.25rem;">Trạng thái</label>
                    <select style="border:1px solid #e5e7eb;border-radius:.5rem;padding:.55rem .7rem;font-size:.95rem;color:#374151;min-width:180px;">
                        <option>Tất cả</option>
                        <option>Đang hoạt động</option>
                        <option>Tạm ẩn</option>
                        <option>Chờ duyệt</option>
                    </select>
                </div>
                <button type="button" style="margin-left:auto;background:#f3f4f6;color:#111827;padding:.6rem .85rem;border:1px solid #e5e7eb;border-radius:.5rem;font-size:.95rem;white-space:nowrap;">Lọc nâng cao</button>
            </div>
        </div>

        <!-- Bottom table -->
        <div style="border:1px solid #e5e7eb;border-radius:.75rem;background:#fff;overflow:hidden;">
            <!-- Header with count -->
            <div style="display:flex;justify-content:space-between;align-items:center;padding:.9rem 1rem;border-bottom:1px solid #e5e7eb;background:#fcfcfc;">
                <div style="font-weight:700;color:#111827;">Danh sách nghệ sĩ <span style="color:#6b7280;font-weight:600;">(247 nghệ sĩ)</span></div>
                <div style="display:flex;gap:.5rem;">
                    <button type="button" style="background:#f9fafb;color:#111827;padding:.45rem .7rem;border:1px solid #e5e7eb;border-radius:.45rem;font-size:.9rem;">Xuất CSV</button>
                    <button type="button" style="background:#2563eb;color:#fff;padding:.45rem .7rem;border:1px solid #1d4ed8;border-radius:.45rem;font-size:.9rem;">+ Thêm nghệ sĩ</button>
                </div>
            </div>

            <!-- Table header -->
            <div style="display:grid;grid-template-columns:44px 1.2fr 1fr 1fr 160px 140px 140px;gap:0;border-bottom:1px solid #e5e7eb;">
                <div style="padding:.7rem 1rem;background:#fcfcfc;border-right:1px solid #e5e7eb;display:flex;align-items:center;">
                    <input type="checkbox" aria-label="Chọn tất cả">
                </div>
                <div style="padding:.7rem 1rem;font-weight:600;color:#111827;background:#fcfcfc;border-right:1px solid #e5e7eb;">Nghệ sĩ</div>
                <div style="padding:.7rem 1rem;font-weight:600;color:#111827;background:#fcfcfc;border-right:1px solid #e5e7eb;">Thể loại</div>
                <div style="padding:.7rem 1rem;font-weight:600;color:#111827;background:#fcfcfc;border-right:1px solid #e5e7eb;">Liên hệ</div>
                <div style="padding:.7rem 1rem;font-weight:600;color:#111827;background:#fcfcfc;border-right:1px solid #e5e7eb;">Ngày tham gia</div>
                <div style="padding:.7rem 1rem;font-weight:600;color:#111827;background:#fcfcfc;border-right:1px solid #e5e7eb;">Trạng thái</div>
                <div style="padding:.7rem 1rem;font-weight:600;color:#111827;background:#fcfcfc;">Thao tác</div>
            </div>

            <!-- Table rows (fake data) -->
            @foreach([1,2,3,4,5,6,7,8] as $i)
            <div style="display:grid;grid-template-columns:44px 1.2fr 1fr 1fr 160px 140px 140px;gap:0;border-top:1px solid #f3f4f6;align-items:center;">
                <!-- checkbox -->
                <div style="padding:.8rem 1rem;display:flex;align-items:center;">
                    <input type="checkbox" aria-label="Chọn nghệ sĩ {{ $i }}">
                </div>

                <!-- artist (avatar + name + email) -->
                <div style="padding:.8rem 1rem;display:flex;gap:.75rem;align-items:center;min-width:0;">
                    <div style="width:40px;height:40px;border-radius:50%;background:#f3f4f6;border:1px solid #e5e7eb;display:flex;align-items:center;justify-content:center;">🎤</div>
                    <div style="min-width:0;">
                        <div style="font-weight:600;color:#111827;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">Nghệ sĩ Demo {{ $i }}</div>
                        <div style="font-size:.85rem;color:#6b7280;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">artist{{ $i }}@mail.com</div>
                    </div>
                </div>

                <!-- category -->
                <div style="padding:.8rem 1rem;color:#374151;white-space:nowrap;">Ca sĩ</div>

                <!-- contact -->
                <div style="padding:.8rem 1rem;color:#374151;white-space:nowrap;">090{{ 12 + $i }} 3456</div>

                <!-- joined at -->
                <div style="padding:.8rem 1rem;color:#6b7280;white-space:nowrap;">01/0{{ ($i%9)+1 }}/2025</div>

                <!-- status -->
                <div style="padding:.8rem 1rem;white-space:nowrap;">
                    <span style="border:1px solid #d1fae5;background:#ecfdf5;color:#065f46;font-size:.85rem;padding:.2rem .5rem;border-radius:999px;">Đang hoạt động</span>
                </div>

                <!-- actions icons -->
                <div style="padding:.6rem 1rem;display:flex;gap:.35rem;align-items:center;">
                    <a href="#" title="Xem" aria-label="Xem" style="text-decoration:none;display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:.4rem;border:1px solid #dbeafe;background:#eff6ff;color:#2563eb;font-size:16px;">👁️</a>
                    <a href="#" title="Sửa" aria-label="Sửa" style="text-decoration:none;display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:.4rem;border:1px solid #d1fae5;background:#ecfdf5;color:#065f46;font-size:16px;">✏️</a>
                    <a href="#" title="Xoá" aria-label="Xoá" style="text-decoration:none;display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:.4rem;border:1px solid #fee2e2;background:#fef2f2;color:#991b1b;font-size:16px;">🗑️</a>
                </div>
            </div>
            @endforeach

            <!-- Pagination -->
            <div style="display:flex;justify-content:flex-end;gap:.5rem;margin:1rem;">
                <a href="#" style="text-decoration:none;color:#374151;border:1px solid #e5e7eb;padding:.45rem .75rem;border-radius:.5rem;background:#fff;">Trước</a>
                <a href="#" style="text-decoration:none;color:#fff;background:#2563eb;padding:.45rem .75rem;border-radius:.5rem;">Sau</a>
            </div>
        </div>
    </div>
</main>
@endsection
