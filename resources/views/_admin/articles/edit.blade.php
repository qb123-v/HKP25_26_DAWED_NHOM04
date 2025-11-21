@extends('_admin._layouts.app')

@push('style')
    <style>
        /* chỉnh chiều cao tối thiểu của khung soạn thảo */
        .ck-editor__editable_inline {
            min-height: 300px;
            /* bạn muốn 400px hay 500px cũng được */
        }
    </style>
@endpush
@push('stylejs')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>


    <script>
        function slugify(str) {
            return str
                .toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .replace(/[^a-z0-9\s-]/g, '')
                .trim()
                .replace(/\s+/g, '-');
        }

        $(document).ready(function () {
            const $titleInput = $("#tilte");
            const $slugInput = $("#slug");
            const $check = $("#flexCheckDefault");

            $titleInput.on("input", function () {
                if (!$check.is(":checked")) {
                    $slugInput.val(slugify($(this).val()));
                }
            });

            $check.on("change", function () {
                if ($(this).is(":checked")) {
                    $slugInput.prop("disabled", false);
                } else {
                    $slugInput.prop("disabled", true)
                        .val(slify($titleInput.val()));
                }
            });

            // Preview thumbnail image
            $("#thumbnail").on("change", function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (evt) {
                        $("#thumbnail-img").attr("src", evt.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
        ClassicEditor
            .create(document.querySelector('#content'), {
                ckfinder: {
                    uploadUrl: "{{ route('admin.ckeditor.upload') . '?_token=' . csrf_token() }}"
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
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
                        <h3 class="mb-0">Chỉnh sửa tin tức</h3>
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
                <form action="" method="post" novalidate>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card mb-4">
                                <div class="card-header">Thông tin chung</div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="slug" class="form label">Đường dẫn bài viết (được tạo tự động khi nhập
                                            tiêu đề)</label>
                                        <input type="text" id="slug" class="form-control" name="slug"
                                            value="{{ $article->slug }}" disabled>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Chỉnh sửa đường dẫn
                                            </label>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="tilte" class="form label">Tiêu đề bài viết</label>
                                        <input type="text" id="tilte" class="form-control" name="title"
                                            value="{{ $article->title }}">
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header">Nội dung chính</div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="content" class="form label">Nội dung chính</label>
                                        <textarea id="content" name="content"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header">Các tác vụ</div>
                                <div class="card-body">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-header">Các danh mục</div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="artist" class="form-label">Nghệ sĩ</label>
                                        <select name="artist" id="" class="form-select">
                                            <option value="">Chọn nghệ sĩ</option>
                                            @foreach ($artists as $artist)
                                                <option value="{{ $artist->id }}" @selected($artist->id == $article->artist_id)>
                                                    {{ $artist->name }}
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="categories" class="form-label">Danh mục</label>
                                        <select name="categories" id="" class="form-select">
                                            <option value="">Chọn danh mục</option>
                                            @foreach($categories as $categorie)
                                                <option value="{{ $categorie->id }}"
                                                    @selected($categorie->id == $article->categorie_id)>
                                                    {{ $categorie->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-4">
                                <div class="card-header">Hình ảnh</div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label for="thumbnail" class="form-label">Chọn hình thumbnail</label>
                                        <input type="file" class="form-control" id="thumbnail">
                                    </div>
                                    <img id="thumbnail-img" class="w-100"
                                        src="{{ asset('images/articles/' . $article->thumbnail) }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Cập nhật</button>
                </form>
            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->
@endsection