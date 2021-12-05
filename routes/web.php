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

Route::post('/collectionTags/{collection}', [CollectionController::class, 'updateTags'])->name('collections.updateTags');

Route::prefix('/collections')->group(function () {
    Route::post('/', [CollectionController::class, 'store'])->name('collections.store');
    Route::get('/{collection}', [CollectionController::class, 'show'])->name('collections.show');
    Route::patch('/{collection}', [CollectionController::class, 'update'])->name('collections.update');
    Route::delete('/{collection}', [CollectionController::class, 'destroy'])->name('collections.destroy');
    Route::get('/', [CollectionController::class, 'index'])->name('collections');
    Route::post('/{collection}/likes', [CollectionLikeController::class, 'store'])->name('collections.likes');
    Route::delete('/{collection}/likes', [CollectionLikeController::class, 'destroy'])->name('collections.likes');
});

Route::prefix('/items')->group(function () { 
    Route::post('/{collection}', [ItemController::class, 'store'])->name('items.store');
    Route::patch('/{item}', [ItemController::class, 'update'])->name('items.update');
    Route::delete('/{item}', [ItemController::class, 'destroy'])->name('items.destroy');
    Route::post('/{item}/likes', [ItemLikeController::class, 'store'])->name('items.likes');
    Route::delete('/{item}/likes', [ItemLikeController::class, 'destroy'])->name('items.likes');
});

Route::prefix('/comments')->group(function () {
    Route::post('/apiStore', [CommentController::class, 'apiStore']);
    Route::post('/apiIndex', [CommentController::class, 'apiIndex']);
    Route::post('/{collection}', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::patch('/{comment}', [CommentController::class, 'update'])->name('comments.update');
});

Route::prefix('/categories')->group(function () { 
    Route::patch('/{tag}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/{tag}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/{categoryName}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/', [CategoryController::class, 'index'])->name('categories');
    Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
});

Route::patch('/updateRole/{user}', [UserController::class, 'updateRole'])->name('user.updateRole');
Route::patch('/@{username}', [UserController::class, 'update'])->name('user.update');
Route::get('/@{username}', [UserController::class, 'show'])->name('user.show');
Route::get('/curators', [UserController::class, 'index'])->name('user');

require __DIR__ . '/auth.php';
