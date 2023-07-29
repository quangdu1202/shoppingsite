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
    Route::get('product/{id}', [Front\ShopController::class,'show']);
    Route::post('product/{id}', [Front\ShopController::class,'postComment']);
    Route::get('', [Front\ShopController::class,'index']);
    Route::get('/category/{categoryName}', [Front\ShopController::class,'category']);
});

Route::prefix('cart')->group(function () {
    Route::get('add/{id}', [Front\CartController::class, 'add']);
    Route::get('/', [Front\CartController::class, 'index']);
});
