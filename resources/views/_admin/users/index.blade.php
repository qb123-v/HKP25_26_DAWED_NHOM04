@extends('_admin._layouts.app')

@push('style')
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
    <!-- fontawesome -->
@endpush

@php
    $categories = [
        (object) [
            'id' => 1,
            'title' => 'abc',
        ],
        (object) [
            'id' => 2,
            'title' => 'dbc',
        ]
    ];
    $users = [
        (object) ['id' => 1, 'name' => 'user1', 'email' => 'email1@gmail.com'],
        (object) ['id' => 2, 'name' => 'user1', 'email' => 'email1@gmail.com'],
        (object) ['id' => 3, 'name' => 'user1', 'email' => 'email1@gmail.com'],
        (object) ['id' => 4, 'name' => 'user1', 'email' => 'email1@gmail.com'],
    ];
@endphp

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
                        <h3 class="mb-0">Quản lý người dùng</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Quản lý người dùng
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
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <!-- <div class="col-8">
                                                    </div> -->
                            <div class="col-12">
                                <form method="get" action="" class="">
                                    <div class="d-flex">
                                        <input type="text" class="form-control me-2" placeholder="Tìm kiếm...">
                                        <button class="btn btn-outline-secondary">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4"> <!--begin::Header-->
                    <div class="card-header ">
                        Danh sách người dùng (.... người dùng)
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px" class="text-center">
                                        <input type="checkbox" class="form-check-input">
                                    </th>
                                    <th style="width: 10px" class="text-center">STT</th>
                                    <th>Tên người dùng</th>
                                    <th>Email</th>
                                    <th width="100" class="text-center">Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr class="align-middle">
                                        <td>
                                            <input type="checkbox" class="form-check-input">

                                        </td>
                                        <td class="text-center">
                                            1
                                        </td>
                                        <td>
                                            <a href="" class="text-decoration-none text-black fw-bold">{{ $user->name }}</a>
                                        </td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.categories.edit', $user->id) }}"
                                                class="text-decoration-none text-secondary"><i class="fa-solid fa-eye"></i></a>
                                            <a href="{{ route('admin.categories.edit', $user->id) }}"
                                                class="text-decoration-none text-secondary"><i
                                                    class="fa-solid fa-pen-to-square "></i></a>
                                            <form action="{{ route('admin.categories.destroy', $user->id) }}" method="POST"
                                                class="d-inline" id="CategorieFormDelete">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#" class="fw-bold text-decoration-none text-secondary"
                                                    onclick="if (confirm('Bạn có chắc chắn muốn xóa chuyên mục?')) { document.getElementById('CategorieFormDelete').submit(); } return false;">
                                                    <i class="fa-solid fa-trash "></i>
                                                </a>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            Dữ liệu trống. Không có người dùng nào
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div> <!-- /.card-body -->
                    <!-- phân trang nếu quá 10 chuyên mục -->
                    <div class="card-footer clearfix">
                        <div class="float-start mt-1">
                            Hiển thị ... trên tổng số ... người dùng
                        </div>
                        <ul class="pagination pagination-sm m-0 float-end">
                            {{-- Nút "Trước" --}}



                            <li class="page-item"><a class="page-link" href="">«</a>
                            </li>


                            {{-- Danh sách các trang --}}
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item ">
                                <a class="page-link" href="#">3</a>
                            </li>


                            <!-- nút sau -->
                            <li class="page-item"><a class="page-link" href="">»</a></li>

                        </ul>
                    </div>

                </div>

            </div>
            <!--end::Container-->
        </div>
        <!--end::App Content-->
    </main>
    <!--end::App Main-->
@endsection