<?php

use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Frontend\HomeController;
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

Route::get('/', [HomeController::class, 'index'])->name('frontend.index');

Route::get('{page?}/{slug}', [ContentController::class, 'show'])->name('frontend.content.show')->where('page', '^(?!.*admin).*$');
Route::get('{slug}', [ContentController::class, 'show'])->name('content.show');
