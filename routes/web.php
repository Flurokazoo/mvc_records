<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\ReviewLikeController;
use App\Http\Controllers\RegistrationController;


Route::get('/register', [RegistrationController::class, 'index'])->name('register');
Route::post('/register', [RegistrationController::class, 'post'])->name('register');

Route::get('/albums', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/albums', [AlbumController::class, 'post'])->name('dashboard'); //AlbumController
Route::post('/albums/search', [SearchController::class, 'post'])->name('dashboard.search');
//Route::get('/albums/search', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/albums/{album}', [AlbumController::class, 'index'])->name('album'); //AlbumController
Route::post('/albums/{album}', [ReviewController::class, 'post'])->name('album'); //ReviewController

Route::delete('/albums/reviews/{review}', [ReviewController::class, 'destroy'])->name('review.destroy'); //Albums/{album}/reviews/{review} ReviewController
Route::get('/albums/reviews/{review}/edit', [ReviewController::class, 'index'])->name('review.edit'); //Albums/{album}/reviews/{review}/likes
Route::put('/albums/reviews/{review}/edit', [ReviewController::class, 'update'])->name('review.update'); //Albums/{album}/reviews/{review}/likes

Route::post('/albums/reviews/{review}/like', [ReviewLikeController::class, 'post'])->name('review.likes'); //Albums/{album}/reviews/{review}/likes
Route::delete('/albums/reviews/{review}/like', [ReviewLikeController::class, 'destroy'])->name('review.likes'); //Albums/{album}/reviews/{review}/likes

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'post'])->name('login');

Route::post('/logout', [LogoutController::class, 'post'])->name('logout');

Route::get('/admin', [AdminPanelController::class, 'index'])->name('admin');
Route::post('/admin/{user}', [AdminPanelController::class, 'post'])->name('admin.user');
Route::delete('/admin/{user}', [AdminPanelController::class, 'destroy'])->name('admin.user');

Route::post('/admin', [TagController::class, 'post'])->name('admin.tag');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
