<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Symfony\Component\Mime\Test\Constraint\EmailSubjectContains;
use Illuminate\Support\Facades\Log;

//以下コントローラーを使用　
use App\Http\Controllers\BookController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\AgeController;
use App\Http\Controllers\Museumcontroller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\UserController;


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

Route::get('/',function()
{
if(Auth::check())
{
    return redirect ('home.index');
}
else
{
    return view('users.title');
}
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

Route::get('/test', function () {
    return view('test');
});

//以下ルート

//〇認証機能関連
Route::get('/users/create',[UserController::class,'create'])->name('users.create');
Route::post('/users/register',[UserController::class,'register'])->name('users.register');
Route::get('/users/loginpage',[UserController::class,'loginpage'])->name('users.loginpage');
Route::post('/users/login',[UserController::class,'login'])->name('users.login');
Route::get('/users/show',[UserController::class,'show'])->name('users.show');
Route::post('/users/logout',[UserController::class,'logout'])->name('users.logout');
Route::get('/users/title',[UserController::class,'title'])->name('users.title');


//〇追加要綱
Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/profile', [ProfileController::class, 'show'])->name('home.show');


//〇タイトル画面についてのルート
Route::get('/title/view',[DashboardController::class,'index'])->name('dashboard.title');
Route::get('/title/menu',[DashboardController::class,'menu'])->name('dashboard.menu');

//〇科目関連のルート
Route::get('subjects/create',[SubjectController::class,'create'])->name('subjects.create');
Route::post('subjects/store',[SubjectController::class,'store'])->name('subjects.store');
Route::get('subjects/index',[SubjectController::class,'index'])->name('subjects.index');
Route::post('subjects/{subject_ID}/delete',[SubjectController::class,'delete'])->name('subjects.delete');

//〇地域関連のルート
Route::get('countries/create',[CountryController::class,'create'])->name('countries.create');
Route::post('countries/store',[CountryController::class,'store'])->name('countries.store');
Route::get('countries/index',[CountryController::class,'index'])->name('countries.index');
Route::post('countries/{country_ID}/delete',[CountryController::class,'delete'])->name('countries.delete');

//〇年代関連のルート
Route::get('ages/create',[AgeController::class,'create'])->name('ages.create');
Route::post('ages/store',[AgeController::class,'store'])->name('ages.store');
Route::get('ages/index',[AgeController::class,'index'])->name('ages.index');
Route::post('ages/{age_ID}/delete', [AgeController::class, 'delete'])->name('ages.delete');


//〇本登録関連のルート
Route::get('books/create',[BookController::class,'create'])->name('books.create');
Route::post('books/store',[BookController::class,'store'])->name('books.store');
Route::get('books/index',[BookController::class,'index'])->name('books.index');
Route::delete('books/delete',[BookController::class,'delete'])->name('books.delete');
Route::get('books/edit',[BookController::class,'edit'])->name('books.edit');

//〇施設登録関連のルート
Route::get('museums/create',[Museumcontroller::class,'create'])->name('museums.create');
Route::post('museums/store',[Museumcontroller::class,'store'])->name('museums.store');
Route::get('museums/index',[Museumcontroller::class,'index'])->name('museums.index');
Route::get('museums/show/{museum}', [Museumcontroller::class, 'show'])->name('museums.show');
Route::delete('museums/delete',[Museumcontroller::class,'delete'])->name('museums.delete');
Route::get('museums/edit',[Museumcontroller::class,'edit'])->name('museums.edit');
Route::get('museums/site',[Museumcontroller::class,'site'])->name('museums.site');
Route::get('museums/map',[Museumcontroller::class,'map'])->name('museums.map');


//〇作品登録関連のルート
Route::get('works/create',[WorkController::class,'create'])->name('works.create');
Route::post('works/store',[WorkController::class,'store'])->name('works.store');
Route::get('works/index',[WorkController::class,'index'])->name('works.index');
Route::get('works/show/{work}', [WorkController::class, 'show'])->name('works.show');
Route::get('works/{work}/edit', [WorkController::class, 'edit'])->name('works.edit');
Route::patch('works/{work}', [WorkController::class, 'update'])->name('works.update');
Route::post('works/{worl_id}/delete',[WorkController::class, 'delete'])->name('works.delete');