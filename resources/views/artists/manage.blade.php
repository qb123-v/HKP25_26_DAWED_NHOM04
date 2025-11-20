@extends('_layouts.app')
@section('title', 'Quản lý nghệ sĩ')

@section('content')
<main style="background:#fff;min-height:calc(100vh - 120px);">
    <div style="max-width:1200px;margin:0 auto;padding:1.25rem;">
        <h1 style="margin:0 0 .25rem;font-size:1.6rem;font-weight:700;color:#111827;">Quản lý nghệ sĩ</h1>
        <p style="margin:0 0 1rem;color:#6b7280;">Hồ sơ cá nhân & cài đặt hiển thị</p>

        <div style="display:flex;gap:1.25rem;align-items:flex-start;">
            <!-- Left table / sidebar -->
            <aside style="width:300px;flex:0 0 300px;">
                <div style="border:1px solid #e5e7eb;border-radius:.75rem;background:#fff;overflow:hidden;">
                    <div style="padding:1.25rem;display:flex;flex-direction:column;align-items:center;gap:.75rem;border-bottom:1px solid #e5e7eb;">
                        <div style="width:96px;height:96px;border-radius:999px;background:#f3f4f6;border:1px solid #e5e7eb;overflow:hidden;display:flex;align-items:center;justify-content:center;font-size:2rem;color:#9ca3af;">🧑‍🎤</div>
                        <div style="text-align:center;">
                            <div style="font-weight:700;color:#111827;">Nguyễn Văn A</div>
                            <div style="color:#6b7280;font-size:.9rem;">artist@example.com</div>
                        </div>
                        <a href="#" style="text-decoration:none;background:#f3f4f6;color:#111827;padding:.45rem .75rem;border-radius:.5rem;border:1px solid #e5e7eb;font-size:.9rem;">📷 Thay đổi ảnh</a>
                    </div>

                    <div style="padding:.5rem 0;">
                        <ul style="list-style:none;margin:0;padding:.25rem;display:flex;flex-direction:column;">
                            <li>
                                <a href="#" style="display:flex;gap:.6rem;align-items:center;padding:.6rem .75rem;border-radius:.5rem;text-decoration:none;color:#111827;">
                                    <span>🖼️</span><span>Avatar</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" style="display:flex;gap:.6rem;align-items:center;padding:.6rem .75rem;border-radius:.5rem;text-decoration:none;color:#111827;">
                                    <span>✉️</span><span>Email</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" style="display:flex;gap:.6rem;align-items:center;padding:.6rem .75rem;border-radius:.5rem;background:#eff6ff;border:1px solid #dbeafe;text-decoration:none;color:#1d4ed8;">
                                    <span>👤</span><span>Hồ sơ cá nhân</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" style="display:flex;gap:.6rem;align-items:center;padding:.6rem .75rem;border-radius:.5rem;text-decoration:none;color:#111827;">
                                    <span>❤️</span><span>Yêu thích</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" style="display:flex;gap:.6rem;align-items:center;padding:.6rem .75rem;border-radius:.5rem;text-decoration:none;color:#111827;">
                                    <span>🔔</span><span>Thông báo</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" style="display:flex;gap:.6rem;align-items:center;padding:.6rem .75rem;border-radius:.5rem;text-decoration:none;color:#111827;">
                                    <span>⚙️</span><span>Cài đặt</span>
                                </a>
                            </li>
                            <li>
                                <a href="#" style="display:flex;gap:.6rem;align-items:center;padding:.6rem .75rem;border-radius:.5rem;text-decoration:none;color:#b91c1c;">
                                    <span>🚪</span><span>Đăng xuất</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </aside>

            <!-- Right table / main content -->
            <section style="flex:1;min-width:0;">
                <div style="border:1px solid #e5e7eb;border-radius:.75rem;background:#fff;overflow:hidden;">
                    <div style="padding:1rem 1.25rem;border-bottom:1px solid #e5e7eb;background:#fafafa;">
                        <h2 style="margin:0;font-size:1.1rem;font-weight:700;color:#111827;">Hồ sơ cá nhân</h2>
                    </div>

                    <div style="padding:1rem 1.25rem;display:grid;gap:1rem;">
                        <!-- Row 1: Họ và tên, Email -->
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                            <div>
                                <label style="display:block;color:#374151;font-size:.9rem;margin-bottom:.35rem;">Họ và tên</label>
                                <input type="text" value="Nguyễn Văn A" style="width:100%;border:1px solid #e5e7eb;border-radius:.5rem;padding:.55rem .75rem;font-size:.95rem;" />
                            </div>
                            <div>
                                <label style="display:block;color:#374151;font-size:.9rem;margin-bottom:.35rem;">Email</label>
                                <input type="email" value="artist@example.com" style="width:100%;border:1px solid #e5e7eb;border-radius:.5rem;padding:.55rem .75rem;font-size:.95rem;" />
                            </div>
                        </div>

                        <!-- Row 2: Phone, DOB -->
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                            <div>
                                <label style="display:block;color:#374151;font-size:.9rem;margin-bottom:.35rem;">Số điện thoại</label>
                                <input type="text" value="0901 234 567" style="width:100%;border:1px solid #e5e7eb;border-radius:.5rem;padding:.55rem .75rem;font-size:.95rem;" />
                            </div>
                            <div>
                                <label style="display:block;color:#374151;font-size:.9rem;margin-bottom:.35rem;">Ngày sinh</label>
                                <input type="date" value="1995-05-10" style="width:100%;border:1px solid #e5e7eb;border-radius:.5rem;padding:.55rem .75rem;font-size:.95rem;" />
                            </div>
                        </div>

                        <!-- Row 3: Address -->
                        <div>
                            <label style="display:block;color:#374151;font-size:.9rem;margin-bottom:.35rem;">Địa chỉ</label>
                            <input type="text" value="123 Lê Lợi, Quận 1, TP. HCM" style="width:100%;border:1px solid #e5e7eb;border-radius:.5rem;padding:.55rem .75rem;font-size:.95rem;" />
                        </div>

                        <!-- Row 4: Bio -->
                        <div>
                            <label style="display:block;color:#374151;font-size:.9rem;margin-bottom:.35rem;">Giới thiệu bản thân</label>
                            <textarea rows="4" style="width:100%;border:1px solid #e5e7eb;border-radius:.5rem;padding:.6rem .75rem;font-size:.95rem;">Xin chào, tôi là ca sĩ/diễn viên yêu thích âm nhạc và điện ảnh.</textarea>
                        </div>

                        <!-- Row 5: Interests -->
                        <div>
                            <div style="color:#374151;font-size:.9rem;margin-bottom:.35rem;font-weight:600;">Sở thích</div>
                            <div style="display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:.65rem 1rem;">
                                @php($interests=[
                                    'Phim Việt','Nhạc Việt','Phim Hollywood','Phim Hàn','Thời trang','Tin tức sao'
                                ])
                                @foreach($interests as $k=>$label)
                                <label style="display:flex;align-items:center;gap:.5rem;color:#111827;">
                                    <input type="checkbox" {{ $k % 2 === 0 ? 'checked' : '' }} />
                                    <span>{{ $label }}</span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Row 6: Notifications -->
                        <div>
                            <div style="color:#374151;font-size:.9rem;margin-bottom:.35rem;font-weight:600;">Cài đặt thông báo</div>
                            <div style="display:flex;flex-wrap:wrap;gap:1rem;">
                                <label style="display:flex;align-items:center;gap:.5rem;color:#111827;">
                                    <input type="checkbox" checked />
                                    <span>Nhận thông báo qua email</span>
                                </label>
                                <label style="display:flex;align-items:center;gap:.5rem;color:#111827;">
                                    <input type="checkbox" />
                                    <span>Nhận tin tức mới</span>
                                </label>
                            </div>
                        </div>

                        <div style="display:flex;justify-content:flex-end;gap:.5rem;margin-top:.5rem;">
                            <button type="button" style="background:#f3f4f6;color:#111827;padding:.55rem .9rem;border:1px solid #e5e7eb;border-radius:.5rem;font-size:.9rem;">Huỷ</button>
                            <button type="button" style="background:#2563eb;color:#fff;padding:.55rem .9rem;border:1px solid #1d4ed8;border-radius:.5rem;font-size:.9rem;">Lưu thay đổi</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</main>
@endsection
