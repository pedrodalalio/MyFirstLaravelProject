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

Route::middleware([
    'auth:sanctum',
    'role:admin', 
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/usuarios', [UserController::class, 'show'])->name('list-users');
});

Route::get('/perfil', [PerfilController::class, 'show'])->name('show-perfil');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Example for a auth with role
// Route::middleware([
//     'auth:sanctum',
//     'role:admin', 
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/admin', function () {
//         return view('admin.index');
//     })->name('admin');
// });