<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PerfilController;

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

Route::get('/', [ProductController::class, 'index'])->name('home');
Route::get('/produtos', [ProductController::class, 'show'])->name('list-produtos');
//Route::get('/produtos', [ProductController::class, 'store'])->name('store-produtos');
Route::get('/usuarios', [UserController::class, 'show'])->name('list-users');
Route::get('/perfil', [PerfilController::class, 'show'])->name('show-perfil');
