<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Panel\BrandController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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

Route::controller(HomeController::class)->name('frontend.')->group(function(){
    Route::get('/', 'home')->name('home');
    Route::get('/product/single-product/{slug}', 'singleProduct')->name('singleProduct');
});

Route::middleware('guest')->group(function (){
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);
});

Route::any('logout', [LoginController::class, 'destroy'])->middleware('auth');

// admin routes
Route::prefix('panel')->name('admin.')->middleware(['auth','web'])->group(function(){
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    // categories
    Route::resource('category', CategoryController::class);
    Route::post('/category/update-with-files/{id}', [CategoryController::class, 'update']);

    //brands
    Route::resource('brand',BrandController::class);
    Route::post('/brand/update-with-files/{id}', [BrandController::class, 'update']);


    // test products
    Route::controller(ProductController::class)->name('product.')->group(function (){
        Route::get('products', 'index')->name('index');
        Route::get('product/create', 'create')->name('create');
        Route::post('product/store', 'store')->name('store');
    });

});


Route::fallback(function (){
   return [
       "action" => "Invalid route actions"
   ] ;
});



Route::get('/chart', function () {
    return inertia('Chart');
});

Route::get('/chat', function (){
    return "chat page";
});
