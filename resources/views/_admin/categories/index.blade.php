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

                <!-- Filter Row -->
                <form class="row mb-3 g-2">
                    <div class="col-md-6">
                        <input type="text" name="name" class="form-control" placeholder="Tên chuyên mục">
                    </div>
                    <div class="col-md-3">
                        <select name="status" class="form-select">
                            <option value="">Chọn trạng thái</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-grid">
                        <button type="submit" class="btn btn-primary">Sắp xếp</button>
                    </div>
                </form>

                <!-- Categories Table -->
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width:40px;"><input type="checkbox" id="select-all"></th>
                            <th>Tên chuyên mục</th>
                            <!-- <th>Số lượng tin tức</th> -->
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td><input type="checkbox" name="selected[]" value="{{ $category->id }}"></td>
                                <td>{{ $category->name }}</td>

                                <td>
                                    @if ($category->status == 'Active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Edit</button>
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Bạn có chắc muốn xóa chuyên mục này?')">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Không có chuyên mục nào</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="mt-3">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </main>

    <!-- Optional: Script select all checkbox -->
    @section('scripts')
        <script>
            document.getElementById('select-all')?.addEventListener('change', function () {
                let checkboxes = document.querySelectorAll('input[name="selected[]"]');
                checkboxes.forEach(cb => cb.checked = this.checked);
            });
        </script>
    @endsection
@endsection