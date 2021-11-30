<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\CollectionLikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemLikeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::post('/collections', [CollectionController::class, 'store'])->name('collections.store');
Route::get('/collections/{collection}', [CollectionController::class, 'show'])->name('collections.show');
Route::patch('/collections/{collection}', [CollectionController::class, 'update'])->name('collections.update');
Route::delete('/collections/{collection}', [CollectionController::class, 'destroy'])->name('collections.destroy');
Route::get('/collections', [CollectionController::class, 'index'])->name('collections');

Route::post('/collections/{collection}/likes', [CollectionLikeController::class, 'store'])->name('collections.likes');
Route::delete('/collections/{collection}/likes', [CollectionLikeController::class, 'destroy'])->name('collections.likes');

Route::post('/items/{collection}', [ItemController::class, 'store'])->name('items.store');
Route::patch('/items/{item}', [ItemController::class, 'update'])->name('items.update');
Route::delete('/items/{item}', [ItemController::class, 'destroy'])->name('items.destroy');

Route::post('/items/{item}/likes', [ItemLikeController::class, 'store'])->name('items.likes');
Route::delete('/items/{item}/likes', [ItemLikeController::class, 'destroy'])->name('items.likes');

Route::post('/comments/{collection}', [CommentController::class, 'store'])->name('comments');

Route::get('/categories/{categoryName}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

Route::patch('/@{username}', [UserController::class, 'update'])->name('user.update');
Route::get('/@{username}', [UserController::class, 'show'])->name('user.show');
Route::get('/curators', [UserController::class, 'index'])->name('user');

require __DIR__.'/auth.php';
