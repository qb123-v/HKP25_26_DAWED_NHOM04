@extends('_admin._layouts.app')

@section('content')
<main class="app-main">

    @php
        // Dummy Articles
        $articles = [
            (object)['id' => 1, 'title' => 'Bài viết 1'],
            (object)['id' => 2, 'title' => 'Bài viết 2'],
        ];

        // Dummy Users
        $users = [
            (object)['id' => 1, 'name' => 'Nguyễn Văn A'],
            (object)['id' => 2, 'name' => 'Trần Thị B'],
            (object)['id' => 3, 'name' => 'Lê Thị C'],
            (object)['id' => 4, 'name' => 'Phạm Văn D'],
        ];

        // Dummy Comments (7 dòng minh họa)
        $comments = [
            (object)[
                'id' => 1,
                'content' => 'Đây là bình luận thử 1. Nội dung dài để test limit hiển thị.',
                'status' => 'Pending',
                'user' => (object)['name' => 'Nguyễn Văn A']
            ],
            (object)[
                'id' => 2,
                'content' => 'Bình luận thử 2.',
                'status' => 'Approved',
                'user' => (object)['name' => 'Trần Thị B']
            ],
            (object)[
                'id' => 3,
                'content' => 'Bình luận minh họa 3.',
                'status' => 'Pending',
                'user' => (object)['name' => 'Lê Thị C']
            ],
            (object)[
                'id' => 4,
                'content' => 'Bình luận minh họa 4.',
                'status' => 'Approved',
                'user' => (object)['name' => 'Phạm Văn D']
            ],
            (object)[
                'id' => 5,
                'content' => 'Bình luận minh họa 5.',
                'status' => 'Pending',
                'user' => (object)['name' => 'Nguyễn Văn A']
            ],
            (object)[
                'id' => 6,
                'content' => 'Bình luận minh họa 6.',
                'status' => 'Approved',
                'user' => (object)['name' => 'Trần Thị B']
            ],
            (object)[
                'id' => 7,
                'content' => 'Bình luận minh họa 7.',
                'status' => 'Pending',
                'user' => (object)['name' => 'Lê Thị C']
            ],
        ];
    @endphp

    <!-- Content Header -->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Quản lý bình luận</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Quản lý bình luận</li>
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
                <div class="col-md-3">
                    <select name="article" class="form-select">
                        <option value="">Chọn bài viết</option>
                        @foreach($articles as $article)
                            <option value="{{ $article->id }}">{{ $article->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="user" class="form-select">
                        <option value="">Chọn người dùng</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <input type="text" name="status" class="form-control" placeholder="Trạng thái">
                </div>
                <div class="col-md-3 d-grid">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>

            <!-- Comments Table -->
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th style="width:40px;"><input type="checkbox" id="select-all"></th>
                        <th>User</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($comments as $comment)
                    <tr>
                        <td><input type="checkbox" name="selected[]" value="{{ $comment->id }}"></td>
                        <td>{{ $comment->user->name }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($comment->content, 50) }}</td>
                        <td>
                            @if($comment->status == 'Pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($comment->status == 'Approved')
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-secondary">{{ $comment->status }}</span>
                            @endif
                        </td>
                        <td>
                            @if($comment->status == 'Pending')
                                <button class="btn btn-success btn-sm">Approve</button>
                            @elseif($comment->status == 'Approved')
                                <button class="btn btn-warning btn-sm">Hide</button>
                            @endif
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa bình luận này?')">Delete</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Không có bình luận nào</td>
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
    document.getElementById('select-all')?.addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('input[name="selected[]"]');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
</script>
@endsection

@endsection
