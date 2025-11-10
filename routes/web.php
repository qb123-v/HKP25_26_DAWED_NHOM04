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



Route::get('tai-khoan', function () {
    return redirect()->route('user.dashboard');
    // return Auth('user')->id();
})->middleware('user.auth');

Route::prefix('tai-khoan')->name('user.')->group(function () {
    Route::get('dang-nhap', [UserAuthController::class, 'showLoginForm'])->name('login');
    Route::post('dang-nhap', [UserAuthController::class, 'login'])->name('login.post');


    // Route::get('/register', function () {
//     return view('auth.register');
// })->name('register');
// Route::get('/forgot-password', function () {
//     return view('auth.forgot-password');
// })->name('password.request');


    Route::middleware('user.auth')->group(function () {
        Route::get('dang-xuat', [UserAuthController::class, 'logout'])->name('logout');

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
