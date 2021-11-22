<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/collections/{collection}', [CollectionController::class, 'show'])->name('collections.show');
Route::get('/collections', [CollectionController::class, 'index'])->name('collections');

Route::get('/categories/{categoryName}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

Route::get('/@{username}', [UserController::class, 'show'])->name('user.show');
Route::get('/curators', [UserController::class, 'index'])->name('user');

require __DIR__.'/auth.php';
