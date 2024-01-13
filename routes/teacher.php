<?php

use App\Http\Controllers\Frontend\Teacher\AuthController;
use App\Http\Controllers\Frontend\Teacher\HomeController;
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

Route::group(['middleware' => ['guest']], function () {
    Route::get('/register', [AuthController::class, 'registerView'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/forget-password', [AuthController::class, 'forgetPasswordView'])->name('forget..password');
    Route::post('/forget-password', [AuthController::class, 'forgetPassword'])->name('forget..password');
    Route::get('/reset-password/{tokem}', [AuthController::class, 'resetPasswordView'])->name('reset.password');
    Route::post('/reset-password/{token}', [AuthController::class, 'resetPassword']);
});

Route::middleware(['auth:teacher'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
});