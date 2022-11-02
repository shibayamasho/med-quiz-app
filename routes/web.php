<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\QuizzesController;

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

// ログインしていないと不可にする
Route::middleware('auth')->group(function(){
    // カテゴリー登録画面
    Route::get('/category/edit',    [CategoriesController::class, 'edit'])->name('category.edit');
    // カテゴリー新規登録
    Route::post('/category/create', [CategoriesController::class, 'create'])->name('category.create');
    // 問題一覧画面
    Route::get('/quiz/index/{categoryId}', [QuizzesController::class, 'index'])->name('quiz.index');
    // 問題登録画面
    Route::get('/quiz/edit', [QuizzesController::class, 'edit'])->name('quiz.edit');
    // 問題新規登録
    Route::post('/quiz/create', [QuizzesController::class, 'create'])->name('quiz.create');
    // 問題解答画面
    Route::get('/quiz/challenge/{categoryId}', [QuizzesController::class, 'challenge'])->name('quiz.challenge');
});
