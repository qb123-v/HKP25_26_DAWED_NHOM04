<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\ArticleManagementController;
use App\Http\Controllers\admin\AdminAuthController;
use App\Http\Controllers\admin\CategorieManagementController;
use App\Http\Controllers\admin\ArtistManagementController;
use App\Http\Controllers\admin\CommentManagementController;
use App\Http\Controllers\admin\UserManagementController;
use App\Http\Controllers\admin\MediaManagementController;
use App\Http\Controllers\admin\FooterManagementController;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\NewsletterController;

// route cho người dùng
Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('news-item', function () {
    return view('news.show');
});

// Điều hướng về đường dẫn /tai-khoan/*
Route::get('tai-khoan', function () {

    return redirect()->route('user.dashboard');
})->middleware('user.auth')->name('user');

// group route cho user
Route::prefix('tai-khoan')->name('user.')->middleware('web')->group(function () {

    // Xử lý post đăng nhập
    Route::post('dang-nhap', [UserAuthController::class, 'login'])->name('login.post');

    // User đã đăng nhập không được phép truy cập các trang dưới đây
    Route::middleware('user.checkLogin')->group(function () {
        Route::controller(UserController::class)->group(function () {
            Route::get('dang-ky', 'create')->name('register');
            Route::post('dang-ky', 'store')->name('register.post');
        });
        Route::get('dang-nhap', [UserAuthController::class, 'showLoginForm'])->name('login');
        Route::get('/quen-mat-khau', [UserAuthController::class, 'showForgotPasswordForm'])
            ->name('forgot-password');
        Route::post('/quen-mat-khau', [UserAuthController::class, 'forgotPassword'])
            ->name('forgot-password.post');
    });

    Route::get('/dat-lai-mat-khau/{token}', [UserAuthController::class, 'showResetPasswordForm'])
        ->name('reset-password');
    Route::post('/dat-lai-mat-khau', [UserAuthController::class, 'resetPassword'])
        ->name('reset-password.post');

    // User đã đăng nhập mới truy cập được các đường dẫn sau đây
    Route::middleware('user.auth')->group(function () {
        Route::post('dang-xuat', [UserAuthController::class, 'logout'])->name('logout');

        Route::controller(UserController::class)
            ->group(function () {
                Route::get('/thong-tin-tai-khoan', 'show')->name('dashboard');
                Route::get('/cap-nhat-thong-tin', 'edit')->name('edit');
            });
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

        Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        Route::get('dashboard', function () {
            return view('_admin.dashboard');
        })->name('admin.dashboard');
        Route::resource('articles', ArticleManagementController::class)->names('admin.articles');
        Route::resource('categories', CategorieManagementController::class)->names('admin.categories');
        Route::resource('artists', ArtistManagementController::class)->names('admin.artists');
        Route::resource('comments', CommentManagementController::class)->names('admin.comments');
        Route::resource('users', UserManagementController::class)->names('admin.users');
        Route::resource('media', MediaManagementController::class)->names('admin.media');

        // route admin management footer
        Route::controller(FooterManagementController::class)->name('admin.footers.')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::put('/', 'update')->name('update');
        });
    });
});

// Trang danh sách bài viết để hiển thị tạm
Route::get('bai-viet', [ArticleController::class, 'index'])->name('articles');

Route::get('/bai-viet/{id}/{slug}', [ArticleController::class, 'show'])
    ->name('articles.show');

// Gửi comment chỉ cho user đã đăng nhập (guard 'user')
Route::post('/bai-viet/{id}/comment', [ArticleController::class, 'storeComment'])
    ->middleware('auth:user')  // <- dùng guard 'user'
    ->name('articles.comment');

// Route đăng ký nhận bản tin
Route::post('/dang-ky-nhan-bao', [NewsletterController::class, 'subscribe'])
    ->name('newsletter.subscribe');
