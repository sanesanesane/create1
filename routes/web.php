<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Symfony\Component\Mime\Test\Constraint\EmailSubjectContains;

//以下コントローラーを使用　
use App\Http\Controllers\BookController;
use App\Http\Controllers\SubjectController;


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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});

//以下ルート
//〇科目関連のルート
Route::get('subjects/create',[SubjectController::class,'create'])->name('subjects.create');
Route::post('subjects/store',[SubjectController::class,'store'])->name('subjects.store');
Route::get('subjects/index',[SubjectController::class,'index'])->name('subjects.index');
Route::delete('subjects/delete',[SubjectController::class,'delete'])->name('subjects.delete');
Route::get('subjects/edit',[SubjectController::class,'edit'])->name('subjects.edit');

//〇本・施設登録関連のルート
Route::get('books/create',[BookController::class,'create'])->name('books.create');
Route::post('books/store',[BookController::class,'store'])->name('books.store');
Route::get('books/index',[BookController::class,'index'])->name('books.index');
Route::delete('books/delete',[BookController::class,'delete'])->name('books.delete');
Route::get('books/edit',[BookController::class,'edit'])->name('books.edit');
