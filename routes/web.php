<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileImageController;
use App\Http\Controllers\FollowsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();



Route::get('/profile', [ProfileController::class, 'profile'])->name('home');

Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

Route::get('profile/image/update', [ProfileImageController::class, 'update'])->name('profile.image.update');

Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile');

Route::get('/post/create', [PostController::class, 'create'])->name('post.create');

Route::post('/follow/{profile}', [FollowsController::class, 'store']);

Route::get('post/index/{post}', [PostController::class, 'index'])->name('post.index');

Route::get('/post/edit/{post}', [PostController::class, 'edit'])->name('post.edit');

Route::post('/post/store', [PostController::class, 'store'])->name('post.store');

Route::post('/post/update', [PostController::class, 'update'])->name('post.update');

Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::post('profile/image/store', [ProfileImageController::class, 'store'])->name('profile.image.store');

Route::post('post/delete',[PostController::class, 'delete'])->name('post.delete');