<?php

use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AdminProductCategoryController as AdminProductCategoryController;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\Homecontroller;
use \App\Models\User;
use App\Http\Controllers\Front;
use App\Http\Controllers\Front\AccountController;

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

Route::get('/', [Homecontroller::class, 'index']);



Route::prefix('shop')->group(function () {
    Route::get('/product/{id}', [Front\ShopController::class, 'show']);
    Route::post('/product/{id}', [Front\ShopController::class, 'postComment']);

    Route::get('/', [Front\ShopController::class, 'index']);

    Route::get('/{categoryName}', [Front\ShopController::class,'category']);
});



Route::prefix('cart')->group(function () {
    Route::get('add/{id}', [Front\CartController::class, 'add']);
    Route::get('/', [Front\CartController::class, 'index']);
    Route::get('delete/{rowId}', [Front\CartController::class, 'delete']);
    Route::get('destroy', [Front\CartController::class, 'destroy']);
    Route::get('update', [Front\CartController::class, 'update']);


});


Route::prefix('checkout')->group(function () {
    Route::get('/', [Front\CheckOutController::class, 'index']);
    Route::post('/', [Front\CheckOutController::class, 'addOrder']);
    Route::get('/vnPayCheck', [Front\CheckOutController::class, 'vnPayCheck']);
    Route::get('/result', [Front\CheckOutController::class, 'result']);

});

//Route::get('/', function (){
//    return User::all();
//});


Route::prefix('account')->group(function(){
    Route::get('login', [AccountController::class, 'login']);
    Route::post('login', [AccountController::class, 'checkLogin']);

    Route::get('logout', [AccountController::class, 'logout']);

    Route::get('register', [AccountController::class, 'register']);
    Route::post('register', [AccountController::class, 'postRegister']);

    Route::prefix('my-order')->middleware('CheckMemberLogin')->group(function(){
        Route::get('/', [AccountController::class, 'myOrderIndex']);
        Route::get('{id}', [AccountController::class, 'myOrderShow']);

    });


});

//admin

Route::prefix('admin')->middleware('CheckAdminLogin')->group(function(){

    Route::redirect('', 'admin/user');

    Route::resource('user', UserController::class);


    Route::resource('category',App\Http\Controllers\Admin\ProductCategoryController::class);
    Route::resource('brand' , App\Http\Controllers\Admin\BrandConller::class);
    Route::resource('product/{product_id}/image', App\Http\Controllers\Admin\ProductImageController::class);
    Route::resource('product/{product_id}/detail', App\Http\Controllers\Admin\ProductDetailController::class);
    Route::resource('product', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('order', App\Http\Controllers\Admin\OrderController::class);

    Route::prefix('login')->group(function(){
        Route::get('', [AdminHomeController::class, 'getLogin'])->withoutMiddleware('CheckAdminLogin');
        Route::post('', [AdminHomeController::class, 'postLogin'])->withoutMiddleware('CheckAdminLogin');
    });

    Route::get('logout', [AdminHomeController::class, 'logout']);

});


