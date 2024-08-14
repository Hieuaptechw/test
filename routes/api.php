<?php

use App\Http\Controllers\admin\SearchController;
use App\Http\Controllers\auth\OrderAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoriController;
use App\Http\Controllers\auth\CategoriauthController;
use App\Http\Controllers\auth\BrandAuthController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\ListProductController;
use App\Http\Controllers\auth\ProductAuthController;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\ForgotpasswordController;
use App\Http\Controllers\auth\CartAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['prefix' => ''], function () {
    //CATEGORIS
    Route::get('/admin/categories', [CategoriController::class, 'getlist']);
    Route::post('/admin/categories/add', [CategoriController::class, 'insert']);
//BRAND
Route::get('/admin/brand', [BrandController::class, 'getlist']);
Route::post('/admin/brand/add', [BrandController::class, 'insert']);
//Product
Route::get('/admin/products', [ListProductController::class, 'getlist']);
Route::post('/admin/prducts/add', [ListProductController::class, 'insert']);
});



Route::post("/password/email",[ForgotpasswordController::class,'sendResetLinkEmail']);
Route::post("/password/reset",[ForgotpasswordController::class,'reset'])->name('password.reset');



Route::post("register",[ApiController::class,'register']);
Route::post("login",[ApiController::class,'login']);
Route::group([
    "middleware"=>["auth:sanctum"]

],function(){

//profile
    Route::get("profile",[ApiController::class,'profile']);
    Route::get("logout",[ApiController::class,'logout']);
});

Route::get('/category', [CategoriauthController::class, 'getCategory']);
Route::get('/category/{category_name}', [CategoriauthController::class, 'getSubcategories']);

Route::get('/new-products', [ProductAuthController::class, 'getNewProducts']);
Route::get('/top-selling', [ProductAuthController::class, 'topselling']);
Route::get('/products/{slug}', [ProductAuthController::class, 'getProductCategory']);
Route::get('/products/details/{slug}', [ProductAuthController::class, 'getProductCategoryDetail']);
Route::get('/products_details/{id}', [ProductAuthController::class, 'getDetailProduct']);


//addToCart

Route::post('/cart/add', [CartAuthController::class, 'addToCart']);
Route::post('/cart/delete', [CartAuthController::class, 'deleteCart']);
Route::get('/cart/product', [CartAuthController::class, 'productcard']);

Route::get('/brand/{brand}', [BrandAuthController::class, 'getBrand']);


Route::post('/order/checkout', [OrderAuthController::class, 'createOrder']);
Route::get('/order/getorder', [OrderAuthController::class, 'getUserOrders']);
Route::get('/order/{order_id}', [OrderAuthController::class, 'getOrderDetails']);
Route::get('/search/{query}', [SearchController::class, 'searchapi']);
