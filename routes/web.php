    <?php

    use App\Http\Controllers\BatchController;
    use App\Http\Controllers\MovimentController;
    use App\Http\Controllers\RoleController;
    use App\Http\Controllers\StockController;
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
Route::get('/perfil', [PerfilController::class, 'show'])->name('show-perfil');

Route::middleware([
    'auth:sanctum',
    //'permission:add products',
    config('jetstream.auth_session'),
    'verified'
])->group(function (){
    //This controller is showing the /usuarios page
    Route::get('/usuarios', [UserController::class, 'show'])->name('list-users');

    //This controller get the name of the permissions
    Route::get('/usuarios/role', [RoleController::class, 'showRoles']);

    //This controller is creating new user in DB
    Route::post('/usuarios', [UserController::class, 'create']);

    //This controller is getting all data from a specific user and showing in Modal Edit
    Route::get('/usuarios/{id}', [UserController::class, 'showEdit']);

    //This controller is editing the user
    Route::post('/usuarios/{id}', [UserController::class, 'update']);

    //This controller is deleting data from a user
    Route::get('/usuarios/delete/{id}', [UserController::class, 'destroy']);
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::group(['middleware' => ['role:add products|edit products|delete products']], function () {
        Route::get('/produtos', [ProductController::class, 'show'])->name('list-produtos');
    });

    Route::group(['middleware' => ['role:add products']], function () {

        //This controller is creating new product in DB
        Route::post('/produtos', [ProductController::class, 'create']);
    });

    Route::group(['middleware' => ['role:edit products']], function () {
        //This controller is getting all data from a specific product and showing in Modal Edit
        Route::get('/produtos/{id}', [ProductController::class, 'showEdit']);
        //This controller is editing the product
        Route::post('/produtos/{id}', [ProductController::class, 'update']);
    });

    Route::group(['middleware' => ['role:delete products']], function () {
        //This controller is deleting data from a product
        Route::get('/produtos/delete/{id}', [ProductController::class, 'destroy']);
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/stock', [StockController::class, 'index'])->name('stock');

    Route::get('/manage', [MovimentController::class, 'index'])->name('manage');
    Route::get('/manage/products/{id}', [MovimentController::class, 'infoProducts']);
    Route::get('/manage/batches/{id}', [BatchController::class, 'batches']);
    Route::post('/manage', [MovimentController::class, 'create']);
    Route::get('/manage/{id}', [MovimentController::class, 'showEdit']);
});
