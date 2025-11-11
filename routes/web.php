<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\NewController;
use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\CategorieController;
use App\Http\Controllers\admin\ArtistController;
use App\Http\Controllers\admin\CommentController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\MediaController;
use App\Http\Controllers\admin\FooterController;
use App\Http\Controllers\UserAuthController;



// route cho người dùng
Route::get('/', function () {
    return view('index');
});
Route::get('news', function () {
    return view('news.index');
});
Route::get('news-item', function () {
    return view('news.show');
});


// Điều hướng về đường dẫn /tai-khoan/*
Route::get('tai-khoan', function () {

    return redirect()->route('user.dashboard');
})->middleware('user.auth');


// group route cho user
Route::prefix('tai-khoan')->name('user.')->group(function () {

    // Xử lý post đăng nhập
    Route::post('dang-nhap', [UserAuthController::class, 'login'])->name('login.post');


    // User đã đăng nhập không được phép truy cập các trang dưới đây
    Route::middleware('user.checkLogin')->group(function () {
        Route::get('dang-ky', function () {
            return view('auth.register');
        })->name('register');
        Route::get('/quen-mat-khau', function () {
            return view('auth.forgot-password');
        })->name('forgot-password');
        Route::get('dang-nhap', [UserAuthController::class, 'showLoginForm'])->name('login');
    });


    // User đã đăng nhập mới truy cập được các đường dẫn sau đây
    Route::middleware('user.auth')->group(function () {
        Route::post('dang-xuat', [UserAuthController::class, 'logout'])->name('logout');

        Route::get('thong-tin-tai-khoan', function () {
            return view('users.index');
        })->name('dashboard');

    });

});




// group route cho admin
Route::get('admin', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth.admin');

Route::prefix('admin')->group(function () {

    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.post');

    Route::middleware('auth.admin')->group(function () {

        Route::get('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        Route::get('dashboard', function () {
            return view('_admin.dashboard');
        })->name('admin.dashboard');
        Route::resource('news', NewController::class)->names('admin.news');
        Route::resource('categories', CategorieController::class)->names('admin.categories');
        Route::resource('artists', ArtistController::class)->names('admin.artists');
        Route::resource('comments', CommentController::class)->names('admin.comments');
        Route::resource('users', UserController::class)->names('admin.users');
        Route::resource('media', MediaController::class)->names('admin.media');
        Route::resource('footers', FooterController::class)->names('admin.footers');
    });
});
