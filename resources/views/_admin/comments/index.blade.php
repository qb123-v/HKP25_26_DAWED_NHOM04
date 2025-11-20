@extends('_admin._layouts.app')

@section('content')
<main class="app-main">

    <div class="app-content-header">
        <div class="container-fluid">
            <h3>Quản lý bình luận</h3>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">

            <!-- Filter -->
            <form class="row mb-3 g-2">
                <div class="col-md-3">
                    <select name="article" class="form-select">
                        <option value="">Chọn bài viết</option>
                        @foreach($articles as $article)
                            <option value="{{ $article->id }}" @if(request('article')==$article->id) selected @endif>{{ $article->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="user" class="form-select">
                        <option value="">Chọn người dùng</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" @if(request('user')==$user->id) selected @endif>{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Tất cả trạng thái</option>
                        <option value="0" @if(request('status')==='0') selected @endif>Pending</option>
                        <option value="1" @if(request('status')==='1') selected @endif>Approved</option>
                        <option value="2" @if(request('status')==='2') selected @endif>Hidden</option>
                    </select>
                </div>
                <div class="col-md-3 d-grid">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>

            <!-- Table -->
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Article</th>
                        <th>Comment</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($comments as $comment)
                        <tr>
                            <td>{{ $comment->id }}</td>
                            <td>{{ $comment->user->name }}</td>
                            <td>{{ $comment->article->title }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($comment->content, 50) }}</td>
                            <td>{!! $comment->statusBadge() !!}</td>
                            <td>
                                @if($comment->status == 0)
                                    <a href="{{ route('admin.comments.approve', $comment->id) }}" class="btn btn-success btn-sm">Approve</a>
                                @elseif($comment->status == 1)
                                    <a href="{{ route('admin.comments.hide', $comment->id) }}" class="btn btn-warning btn-sm">Hide</a>
                                @elseif($comment->status == 2)
                                    <a href="{{ route('admin.comments.show', $comment->id) }}" class="btn btn-primary btn-sm">Show</a>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Không có bình luận nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $comments->links() }}
            </div>

        </div>
    </div>
</main>
@endsection
