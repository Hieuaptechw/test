<?php

use App\Http\Controllers\admin\AddProductController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\SearchController;
use App\Http\Controllers\admin\UploadController;
use App\Http\Controllers\admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\CategoriController;
use App\Http\Controllers\admin\SubcategoriController;
use App\Http\Controllers\admin\ListProductController;

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



Route::get('/', function () {
    return view('admin.login');
});
Route::get('login', [AdminController::class, 'adminlogin'])->name('login');
Route::post('login', [AdminController::class, 'login'])->name('login-p');


// Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
//     Route::get('/', function () {
//         return view('admin.dashboard');
//     });
//     Route::get('/dashboard', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard');
//     Route::get('/categories', [CategoriController::class, 'viewList']);
//     Route::post('/categories/add', [CategoriController::class, 'insert']);
//     Route::delete('/categories/delete/{id}', [CategoriController::class, 'delete']);
//     Route::post('/logout', [AdminController::class, 'logout'])->name('logout-p');
//     Route::get('/categories/edit/{id}', [CategoriController::class, 'edit']);
//     Route::put('/categories/update/{id}', [CategoriController::class, 'update']);
//     //SUBCATEGORY
//     Route::get('/subcategories', [SubcategoriController::class, 'viewList']);
//     Route::post('/subcategories/add', [SubcategoriController::class, 'insert']);
//     Route::delete('/subcategories/delete/{id}', [SubcategoriController::class, 'delete']);
//     Route::get('/subcategories/edit/{id}', [SubcategoriController::class, 'edit']);
//     Route::put('/subcategories/update/{id}', [SubcategoriController::class, 'update']);
//     //BRAND
//     Route::get('/brand', [BrandController::class, 'viewList']);
//     Route::post('/brand/add', [BrandController::class, 'insert']);
//     Route::delete('/brand/delete/{id}', [BrandController::class, 'delete']);
//     Route::get('/brand/edit/{id}', [BrandController::class, 'edit']);
//     Route::put('/brand/update/{id}', [BrandController::class, 'update']);
// //PRODUCT
//     // Route::get('/products', [BrandController::class, 'viewList']);
//     Route::get('/products', [ListProductController::class, 'viewList']);
//     Route::get('/products/add', [AddProductController::class, 'create']);
//     Route::post('/products/store', [AddProductController::class, 'store'])->name('products.store');
//     Route::delete('/products/delete/{id}', [ListProductController::class, 'delete']);
//     Route::get('/products/edit/{id}', [ListProductController::class, 'edit']);
//     Route::get('/products/edit1/{id}', [ListProductController::class, 'edit1']);
//     Route::put('/products/update/{id}', [ListProductController::class, 'update']);
//     Route::delete('/products/delete/{id}', [ListProductController::class, 'delete']);
//     // CATEGORI
    
// });


Route::group(['prefix' => 'admin','middleware' => ['auth', 'role:admin']], function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    });
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/categories', [CategoriController::class, 'viewList']);
    Route::post('/categories/add', [CategoriController::class, 'insert']);
    Route::delete('/categories/delete/{id}', [CategoriController::class, 'delete']);
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout-p');
    Route::get('/categories/edit/{id}', [CategoriController::class, 'edit']);
    Route::put('/categories/update/{id}', [CategoriController::class, 'update']);
    //SUBCATEGORY
    Route::get('/subcategories', [SubcategoriController::class, 'viewList']);
    Route::post('/subcategories/add', [SubcategoriController::class, 'insert']);
    Route::delete('/subcategories/delete/{id}', [SubcategoriController::class, 'delete']);
    Route::get('/subcategories/edit/{id}', [SubcategoriController::class, 'edit']);
    Route::put('/subcategories/update/{id}', [SubcategoriController::class, 'update']);
    //BRAND
    Route::get('/brand', [BrandController::class, 'viewList']);
    Route::post('/brand/add', [BrandController::class, 'insert']);
    Route::delete('/brand/delete/{id}', [BrandController::class, 'delete']);
    Route::get('/brand/edit/{id}', [BrandController::class, 'edit']);
    Route::put('/brand/update/{id}', [BrandController::class, 'update']);
//PRODUCT
    // Route::get('/products', [BrandController::class, 'viewList']);
    Route::get('/products', [ListProductController::class, 'viewList']);
    Route::get('/products/add', [AddProductController::class, 'create']);
    Route::post('/products/store', [AddProductController::class, 'store'])->name('products.store');
    Route::delete('/products/delete/{id}', [ListProductController::class, 'delete']);
    Route::get('/products/edit/{id}', [ListProductController::class, 'edit']);
    Route::get('/products/edit1/{id}', [ListProductController::class, 'edit1']);
    Route::put('/products/update/{id}', [ListProductController::class, 'update']);
    Route::delete('/products/delete/{id}', [ListProductController::class, 'delete']);
    Route::put('/products/update/{id}', [ListProductController::class, 'update']);
    // Order
    Route::get('/orders', [OrderController::class, 'getUserOrders']);
    Route::put('/orders/{id}/update-status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');
    Route::get('/users', [UserController::class, 'viewlist'])->name('search');
    Route::get('/search', [SearchController::class, 'search'])->name('search');

});


Route::group(['prefix' => 'admin'], function () {
   
  
});

Route::post('/upload',[UploadController::class,'upload']);
Route::post('/uploads',[UploadController::class,'uploads']);




