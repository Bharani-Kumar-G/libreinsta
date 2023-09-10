<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'profile'])->name('home');

Route::get('profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');

Route::get('profile/image/update', [App\Http\Controllers\ProfileImageController::class, 'update'])->name('profile.image.update');

Route::get('/profile/{id}', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');

Route::get('/post/create', [App\Http\Controllers\PostController::class, 'create'])->name('post.create');

Route::post('/post/store', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');

Route::post('profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

Route::post('profile/image/store', [App\Http\Controllers\ProfileImageController::class, 'store'])->name('profile.image.store');