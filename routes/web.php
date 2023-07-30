<?php

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

use App\Http\Controllers\Front;
use App\Repositories\Product\ProductRepositoryInterface;
use App\Services\Product\ProductServiceInterface;
use Illuminate\Http\Request;

Route::get('/', [Front\HomeController::class, 'index']);
//Route::get('/',function (ProductRepositoryInterface $productRepository) {
//    return $productRepository->all();
//});

//Route::get('/',function (ProductServiceInterface $productService) {
//    return $productService->all();
//});

Route::prefix('shop')->group(function () {
    Route::get('', [Front\ShopController::class,'index']);
    Route::get('product/{id}', [Front\ShopController::class,'show']);
    Route::get('/category/{categoryName}', [Front\ShopController::class,'category']);
    Route::post('product/{id}', [Front\ShopController::class,'postComment']);
});

Route::prefix('cart')->group(function () {
    Route::get('/', [Front\CartController::class, 'index']);
    Route::get('add', [Front\CartController::class, 'add']);
    Route::get('update', [Front\CartController::class, 'update']);
    Route::get('delete', [Front\CartController::class, 'delete']);
    Route::get('destroy', [Front\CartController::class, 'destroy']);
});

Route::prefix('checkout')->group(function () {
    Route::get('', [Front\CheckoutController::class, 'index']);
    Route::post('/', [Front\CheckoutController::class, 'createOrder']);
    Route::get('result', [Front\CheckoutController::class, 'result']);
    Route::get('vnPayCheck', [Front\CheckoutController::class, 'vnPayCheck']);
//    Route::get('sendEmail', [Front\CheckoutController::class, 'vnPayCheck']);
});


Route::prefix('account')->group(function () {
    Route::get('login', [Front\AccountController::class, 'login']);
    Route::post('login', [Front\AccountController::class, 'checkLogin']);
    Route::get('logout', [Front\AccountController::class, 'logout']);
    Route::get('register', [Front\AccountController::class, 'register']);
    Route::post('register', [Front\AccountController::class, 'postRegister']);
});
