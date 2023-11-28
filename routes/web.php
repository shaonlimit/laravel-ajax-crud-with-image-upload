<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\PostController;
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

Route::get('/', [PostController::class, 'index'])->name('post.index');
Route::post('/store', [PostController::class, 'store'])->name('post.store');
Route::post('/update', [PostController::class, 'update'])->name('post.update');
Route::post('/delete', [PostController::class, 'delete'])->name('post.delete');
Route::post('/show', [PostController::class, 'show'])->name('post.show');
Route::get('/pagination/paginate-data', [PostController::class, 'pagination'])->name('post.pagination');
Route::get('/task_search', [PostController::class, 'search'])->name('post.search');


// Route::get('/pagination/paginate-data', [PostController::class, 'pagination'])->name('task.pagination');
// Route::get('/task_search', [PostController::class, 'search'])->name('task.search');