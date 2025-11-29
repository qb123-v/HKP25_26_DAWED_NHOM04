@extends('_admin._layouts.app')

@section('content')
    <style>
        .artist-row {
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }
        .artist-row:hover {
            background-color: #f8f9fa !important;
            transform: scale(1.01);
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .artist-row:active {
            transform: scale(0.99);
        }
    </style>

    <!--begin::App Main-->
    <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Row-->
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="mb-0">Quản lý nghệ sĩ</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Quản lý nghệ sĩ
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
                <!-- Top Toolbar (Search & Filters) -->
                <div class="card mb-3">
                    <div class="card-body">
                        <form method="GET" action="{{ route('admin.artists.index') }}">
                            <div class="row g-3 align-items-end">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" name="name" class="form-control" placeholder="Tìm kiếm nghệ sĩ theo tên" value="{{ request('name') }}">
                                        <span class="input-group-text">🔎</span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" name="email" class="form-control" placeholder="Tìm kiếm theo email" value="{{ request('email') }}">
                                        <span class="input-group-text">@</span>
                                    </div>
                                </div>
                                <div class="col-md-4 text-end">
                                    <button type="submit" class="btn btn-primary">Lọc</button>
                                    <a href="{{ route('admin.artists.index') }}" class="btn btn-secondary">Xoá lọc</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Main Table -->
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Danh sách nghệ sĩ</strong>
                                <span class="text-muted">({{ $artists->total() }} nghệ sĩ)</span>
                            </div>
                            <div>
                                <a href="{{ route('admin.artists.exportCsv', request()->query()) }}" class="btn btn-sm btn-outline-secondary me-2">Xuất CSV</a>
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addArtistModal">+ Thêm nghệ sĩ</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th style="width: 40px;">
                                            <input type="checkbox" class="form-check-input">
                                        </th>
                                        <th>Nghệ sĩ</th>
                                        <th style="width: 150px;">Email</th>
                                        <th style="width: 140px;">Ngày tham gia</th>
                                        <th style="width: 140px;">Trạng thái</th>
                                        <th style="width: 140px;">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($artists as $artist)
                                    <tr class="artist-row" data-artist-id="{{ $artist->id }}" data-artist-name="{{ $artist->name }}" data-artist-email="{{ $artist->email }}">
                                        <td>
                                            <input type="checkbox" class="form-check-input">
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div style="width: 40px; height: 40px; border-radius: 50%; background: #f3f4f6; border: 1px solid #dee2e6; display: flex; align-items: center; justify-content: center;">🎤</div>
                                                <div>
                                                    <div class="fw-bold">{{ $artist->name }}</div>
                                                    <small class="text-muted">{{ $artist->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $artist->email }}</td>
                                        <td>
                                            <small class="text-muted">{{ $artist->created_at ? $artist->created_at->format('d/m/Y') : '' }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-success">Đang hoạt động</span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <button type="button" class="btn btn-info" title="Xem">
                                                    <i class="fas fa-eye"></i> Xem
                                                </button>
                                                <button type="button" class="btn btn-success" title="Sửa">
                                                    <i class="fas fa-edit"></i> Sửa
                                                </button>
                                                <button type="button" class="btn btn-danger" title="Xóa">
                                                    <i class="fas fa-trash"></i> Xóa
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted">Không có nghệ sĩ nào.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            {{ $artists->withQueryString()->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->

    <!-- Add Artist Modal -->
    <div class="modal fade" id="addArtistModal" tabindex="-1" aria-labelledby="addArtistModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('admin.artists.store') }}">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addArtistModalLabel">Thêm nghệ sĩ mới</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="mb-3">
                            <label class="form-label">Tên nghệ sĩ</label>
                            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
                        </div>
                        <!-- Add more fields as needed -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Artist Detail Modal -->
    <div class="modal fade" id="artistDetailModal" tabindex="-1" aria-labelledby="artistDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="artistDetailForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="artistDetailModalLabel">Hồ sơ nghệ sĩ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <!-- Left Sidebar -->
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <div style="width:96px;height:96px;border-radius:50%;background:#f3f4f6;border:1px solid #dee2e6;margin:0 auto 1rem;display:flex;align-items:center;justify-content:center;font-size:2rem;">🧑‍🎤</div>
                                    <h5 class="mb-1" id="modalArtistName">Nguyễn Văn A</h5>
                                    <p class="text-muted small" id="modalArtistEmail">artist@example.com</p>
                                    <button class="btn btn-sm btn-outline-secondary">📷 Thay đổi ảnh</button>
                                </div>
                            </div>
                            <div class="card mt-3">
                                <div class="list-group list-group-flush">
                                    <a href="#" class="list-group-item list-group-item-action">🖼️ Avatar</a>
                                    <a href="#" class="list-group-item list-group-item-action">✉️ Email</a>
                                    <a href="#" class="list-group-item list-group-item-action active">👤 Hồ sơ cá nhân</a>
                                    <a href="#" class="list-group-item list-group-item-action">❤️ Yêu thích</a>
                                    <a href="#" class="list-group-item list-group-item-action">🔔 Thông báo</a>
                                    <a href="#" class="list-group-item list-group-item-action">⚙️ Cài đặt</a>
                                    <a href="#" class="list-group-item list-group-item-action text-danger">🚪 Đăng xuất</a>
                                </div>
                            </div>
                        </div>

                        <!-- Right Content -->
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">Hồ sơ cá nhân</h6>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" id="artistDetailId" name="id">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Họ và tên</label>
                                            <input type="text" class="form-control" name="name" id="artistDetailName">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="artistDetailEmail">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Số điện thoại</label>
                                            <input type="text" class="form-control" name="phone" id="artistDetailPhone">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Ngày sinh</label>
                                            <input type="date" class="form-control" name="dob" id="artistDetailDob">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Địa chỉ</label>
                                        <input type="text" class="form-control" name="address" id="artistDetailAddress">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Giới thiệu bản thân</label>
                                        <textarea class="form-control" rows="4" name="intro" id="artistDetailIntro"></textarea>
                                    </div>

                                    <!-- Row 5 -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Sở thích</label>
                                        <div class="row">
                                            @php($interests=['Phim Việt','Nhạc Việt','Phim Hollywood','Phim Hàn','Thời trang','Tin tức sao'])
                                            @foreach($interests as $k=>$label)
                                            <div class="col-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" {{ $k % 2 === 0 ? 'checked' : '' }}>
                                                    <label class="form-check-label">{{ $label }}</label>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Row 6 -->
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Cài đặt thông báo</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" checked>
                                            <label class="form-check-label">Nhận thông báo qua email</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox">
                                            <label class="form-check-label">Nhận tin tức mới</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span id="artistDetailMsg" class="me-auto text-success"></span>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Huỷ</button>
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        console.log('Script loaded - inline');
        
        // Wait for DOM to be fully loaded
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initArtistRows);
        } else {
            initArtistRows();
        }
        
        function initArtistRows() {
            console.log('Initializing artist rows...');
            console.log('Bootstrap available:', typeof bootstrap !== 'undefined');
            console.log('jQuery available:', typeof $ !== 'undefined');
            
            const rows = document.querySelectorAll('.artist-row');
            console.log('Found rows:', rows.length);
            
            if (rows.length === 0) {
                console.error('No artist rows found! Check if the table is rendered.');
                return;
            }
            
            // Handle row clicks
            rows.forEach((row, index) => {
                console.log('Attaching listener to row', index + 1);
                
                row.addEventListener('click', function(e) {
                    console.log('========== ROW CLICKED ==========');
                    console.log('Row index:', index + 1);
                    console.log('Target element:', e.target);
                    console.log('Target tagName:', e.target.tagName);
                    console.log('Closest btn-group:', e.target.closest('.btn-group'));
                    console.log('Target type:', e.target.type);
                    
                    // Don't trigger if clicking on action buttons or checkboxes
                    if (e.target.closest('.btn-group') || e.target.type === 'checkbox') {
                        console.log('❌ Click ignored - button or checkbox clicked');
                        return;
                    }

                    // Always get artistId from the clicked row, not from a reused variable
                    const artistId = this.getAttribute('data-artist-id');

                    fetch('{{ url('admin/artists') }}/' + artistId)
                        .then(response => response.json())
                        .then(data => {
                            document.getElementById('modalArtistName').textContent = data.name || '';
                            document.getElementById('modalArtistEmail').textContent = data.email || '';

                            // Fill form fields
                            document.getElementById('artistDetailId').value = data.id;
                            document.getElementById('artistDetailName').value = data.name || '';
                            document.getElementById('artistDetailEmail').value = data.email || '';
                            document.getElementById('artistDetailPhone').value = data.phone || '';
                            document.getElementById('artistDetailDob').value = data.dob || '';
                            document.getElementById('artistDetailAddress').value = data.address || '';
                            document.getElementById('artistDetailIntro').value = data.intro || '';
                        })
                        .catch(() => {
                            // fallback
                        })
                        .finally(() => {
                            const modalElement = document.getElementById('artistDetailModal');
                            if (typeof bootstrap !== 'undefined') {
                                const modal = new bootstrap.Modal(modalElement);
                                modal.show();
                            } else if (typeof $ !== 'undefined' && $.fn.modal) {
                                $('#artistDetailModal').modal('show');
                            }
                        });
                });
            });

            // Handle update submit
            document.getElementById('artistDetailForm').onsubmit = function(e) {
                e.preventDefault();
                const id = document.getElementById('artistDetailId').value;
                const formData = new FormData(this);

                // Debug: log all form data
                console.log('Submitting update for artist ID:', id);
                for (let [key, value] of formData.entries()) {
                    console.log('Form field:', key, '=>', value);
                }

                fetch('{{ url('admin/artists') }}/' + id + '/update', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: formData
                })
                .then(res => {
                    console.log('Fetch response status:', res.status);
                    return res.json();
                })
                .then(data => {
                    console.log('Response JSON:', data);
                    if (data.success) {
                        document.getElementById('artistDetailMsg').textContent = 'Cập nhật thành công!';
                    } else if (data.errors) {
                        document.getElementById('artistDetailMsg').textContent = Object.values(data.errors).join(', ');
                    }
                })
                .catch(err => {
                    console.error('Update AJAX error:', err);
                });
            };
        }
    </script>
@endsection