<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\News\TeroNewsController;
use App\Http\Controllers\Video\VideoController;
use Illuminate\Support\Facades\Route;


Route::get('/', [LoginController::class, 'index'])->name('login');
Route::POST('/login-perform', [LoginController::class, 'store'])->name('login.perform');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::POST('/register-perform', [RegisterController::class, 'store'])->name('register.perform');
Route::POST('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'index'])->name('profile');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/video-list', [VideoController::class, 'index'])->name('video-list');
    Route::get('/video/{id}/detail', [VideoController::class, 'show'])->name('video-detail');
    Route::get('/video/{filename}', [VideoController::class, 'stream'])->name('video.stream');
    Route::post('/video/{id}/update', [VideoController::class, 'update'])->name('video.update');
    Route::get('/members', [UserController::class, 'members'])->name('members');
    Route::post('/members/create', [UserController::class, 'store'])->name('members.store');
    Route::get('/news', [NewsController::class, 'index'])->name('news');
    Route::get('/news/search', [NewsController::class, 'search'])->name('news.search');
    Route::get('/tero-news', [TeroNewsController::class, 'index'])->name('tero_news');
    Route::get('/tero-news/search', [TeroNewsController::class, 'search'])->name('tero-news.search');
    Route::get('/news/{id}/detail', [NewsController::class, 'show'])->name('news-detail');
    Route::get('/tero-news/{id}/detail', [TeroNewsController::class, 'show'])->name('tero-news-detail');
    Route::post('/news/{id}/update', [NewsController::class, 'update'])->name('news.update');
    Route::get('/members/{user_id}/show', [UserController::class, 'show']);
    Route::post('/upload-image', [TeroNewsController::class, 'uploadImage']);
});
