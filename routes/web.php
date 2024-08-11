<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
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

Route::get('/', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'actionLogin'])->name('signin');

Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/signup', [AuthController::class, 'store'])->name('signup');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        // Route::get('/', [BookController::class, 'dashboard'])->name('dashboard.dashboard');
        Route::get('export', [BookController::class, 'export'])->name('book.export');
        Route::resource('book', BookController::class);
        Route::resource('category', CategoryController::class);
    });
});
