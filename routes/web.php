<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Controllers\Controller;    
use App\Http\Controllers\LatihanController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\EcommerceController;
use App\Models\Category;
use App\Models\Product;

// Route::get('/', function () {
//     $categories = Category::all();
//     $products = Product::with('category')->get();
//     return view('welcome', compact('categories','products'));
// });

Route::get('/', [EcommerceController::class, 'index'])->name('welcome');

//routing dasar
Route::get('/sample',function(){
    return 'Hallo WhyRixx';
});
Route::get('/sample2', function () {
    return view('sample2');
});

//routing,controller & view dasar
Route::get('/sample3',[LatihanController::class,'index']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/siswa', [App\Http\Controllers\SiswaController::class, 'index'])->name('siswa.index');
Route::get('/siswa/create', [App\Http\Controllers\SiswaController::class, 'create'])->name('siswa.create');
Route::post('/siswa', [App\Http\Controllers\SiswaController::class, 'store'])->name('siswa.store');
Route::get('/testing', function () {
    return view('layouts.admin');
});
Route::get('latihan-js', function () {
    return view('latihan-js');
});


Route::group(['prefix' => 'admin','as'=> 'admin.','middleware' => ['auth', IsAdminMiddleware::class]], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('product', ProductController::class);
        Route::resource('category', CategoryController::class);
});

//user
Route::group(['prefix' => 'user','as'=> 'user.','middleware' => ['auth']], function () {});

Route::group([
    'middleware' => ['auth'],
], function () {
    Route::post('/order', [EcommerceController::class, 'createOrders'])->name('Order.create');
    Route::post('/checkout', [EcommerceController::class, 'checkOut'])->name('checkOut');
    Route::get('/my-orders', [EcommerceController::class, 'myOrders'])->name('myOrders');
    Route::get('/my-orders/{id}', [EcommerceController::class, 'orderDetail'])->name('orderDetail');
    Route::post('order/update-quantity', [EcommerceController::class, 'updateQuantity'])->name('updateQuantity');
    Route::post('order/remove-item', [EcommerceController::class, 'removeItem'])->name('removeItem');
});