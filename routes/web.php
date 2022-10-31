<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\CategoriesController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';

// Top Page
Route::get('/top', [TopController::class, 'index'])->name('top');
// カテゴリー登録画面
Route::get('/category/edit',    [CategoriesController::class, 'edit'])->name('category.edit');
// カテゴリー新規登録
Route::post('/category/create', [CategoriesController::class, 'create'])->name('category.create');
