<?php

use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CustomerController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Panel\BrandController;
use App\Http\Controllers\Panel\BusinessSettingController;
use App\Http\Controllers\Panel\CategoryController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\OrderController;
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

    Route::get('/cart-details', 'cartDetails')->name('cartDetails');
});

Route::middleware('customer')->group(function(){
    Route::get('/dashboard', [CustomerController::class, 'dashboard'])->name('dashboard');

    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/save-to-checkout', [CheckoutController::class, 'addCheckout'])->name('addCheckout');

    Route::get('/select-payment', [PaymentController::class, 'payment'])->name('payment');
    Route::post('/make-payment', [PaymentController::class, 'makePayment'])->name('makePayment');
    Route::get('/make-payment', [PaymentController::class, 'orderComplete'])->name('orderComplete');
});

Route::prefix('customer')->name('customer.')->middleware( 'guest')->group(function (){
    Route::get('login', [CustomerController::class, 'login'])->name('login');
    Route::post('login', [CustomerController::class, 'checkLogin'])->name('checkLogin');

    Route::post('registration', [CustomerController::class, 'checkRegistration'])->name('checkRegistration');
});


Route::middleware('guest')->group(function (){
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);
});

Route::any('logout', [LoginController::class, 'destroy'])->middleware('auth');

// admin routes
Route::prefix('panel')->name('admin.')->middleware(['auth','web', 'admin'])->group(function(){
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

    // customer orders
    Route::controller(OrderController::class)->name('order.')->group(function(){
        Route::get('/orders', 'index')->name('index');
    });

    Route::get('/settings', [BusinessSettingController::class, 'index'])->name('businessIndex');
    Route::post('/settings', [BusinessSettingController::class, 'updateSetting'])->name('businessSave');

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
