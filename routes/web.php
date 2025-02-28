<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\Video\VideoController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::POST('/login-perform', [LoginController::class, 'store'])->name('login.perform');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::POST('/register-perform', [RegisterController::class, 'store'])->name('register.perform');
Route::POST('/logout', [LoginController::class, 'destroy'])->name('logout');
Route::get('/test', [NewsController::class, 'index'])->name('test');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::get('/page', function() {
        //
    })->name('page');
    Route::get('/virtual-reality', function() {
        //
    })->name('virtual-reality');
    Route::get('/rtl', function() {
        //
    })->name('rtl');
    Route::get('/profile-static', function() {
        //
    })->name('profile-static');
    Route::get('/sign-in-static', function() {
        //
    })->name('sign-in-static');
    Route::get('/sign-up-static', function() {
        //
    })->name('sign-up-static');
    Route::get('/profile.update', function() {
        //
    })->name('profile.update'); 
    Route::get('/pages/tables', function() {
        return view('pages.tables');
    })->name('pages.tables'); 
    Route::get('/tables', function() {
        //
    })->name('tables'); 
    Route::get('/video-list', [VideoController::class, 'index'])->name('video-list'); 
    Route::get('/video/{id}/detail', [VideoController::class, 'show'])->name('video-detail'); 
    Route::get('/video/{filename}', [VideoController::class, 'stream'])->name('video.stream');
    Route::post('/video/{id}/update', [VideoController::class, 'update'])->name('video.update');
    Route::get('/members', [UserController::class, 'members'])->name('members');
    Route::get('/news', [NewsController::class, 'index'])->name('news');    
    Route::get('/news/search', [NewsController::class, 'search'])->name('news.search');
    Route::get('/news/{id}/detail', [NewsController::class, 'show'])->name('news-detail');
    Route::post('/news/{id}/update', [NewsController::class, 'update'])->name('news.update'); 
});

