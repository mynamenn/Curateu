<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/collections', [CollectionController::class, 'create'])->name('collections.create');
Route::get('/collections/{collection}', [CollectionController::class, 'show'])->name('collections.show');
Route::get('/collections', [CollectionController::class, 'index'])->name('collections');

Route::post('/collections/{collection}/likes', [CollectionController::class, 'store'])->name('collections.likes');
Route::delete('/collections/{collection}/likes', [CollectionController::class, 'destroy'])->name('collections.likes');

Route::post('/items/{item}/likes', [ItemController::class, 'store'])->name('items.likes');
Route::delete('/items/{item}/likes', [ItemController::class, 'destroy'])->name('items.likes');

Route::post('/comments/{collection}', [CommentController::class, 'store'])->name('comments');

Route::get('/categories/{categoryName}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

Route::get('/@{username}', [UserController::class, 'show'])->name('user.show');
Route::get('/curators', [UserController::class, 'index'])->name('user');

require __DIR__.'/auth.php';
