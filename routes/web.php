<?php

use App\Livewire\Admin\Brand\Index;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\RouteRegistrar;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Admin\DashBoardController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\WishListController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();

Route::get('search', [FrontendController::class, 'searchProducts']);
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('collections', [FrontendController::class, 'categories'])->name('frontend.category');
Route::get('collections/{category_slug}', [FrontendController::class, 'products'])->name('frontend.product');
Route::get('collections/{category_slug}/{product_slug}', [FrontendController::class, 'productView'])->name('frontend.productView');
Route::get('new-arrivals', [FrontendController::class, 'newArrival'])->name('frontend.new-arrivals');
Route::get('featured-products', [FrontendController::class, 'featuredProducts'])->name('frontend.featuredProducts');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [DashBoardController::class, 'index']);

    Route::get('settings', [SiteSettingController::class, 'index']);
    Route::post('settings', [SiteSettingController::class, 'store']);

    //Category route
    Route::controller(CategoryController::class)->group(function () {
        Route::get('category', 'index')->name('category.index');
        Route::get('category/create', 'create')->name('category.create');
        Route::post('category', 'store')->name('category.store');
        Route::get('category/{category}/edit', 'edit')->name('category.edit');
        Route::put('category/{category}', 'update')->name('category.update');
    });

    //Product Route
    Route::controller(ProductController::class)->group(function () {
        Route::get('products', 'index')->name('product.index');
        Route::get('products/create', 'create');
        Route::post('products', 'store')->name('product.store');
        Route::get('products/{product}/edit', 'edit')->name('product.edit');
        Route::put('products/{product}', 'update')->name('product.update');
        Route::get('products/{product}/delete', 'delete')->name('product.delete');
        Route::get('products/{productImage_id}/destroyImage', 'destroyImage')->name('product.deleteImage');
        Route::post('product-color/{product_color_id}', 'updateColorQuantity');
        Route::get('product-color/{product_color_id}/delete', 'deleteProductColor');
    });

    //Color route
    Route::controller(ColorController::class)->group(function () {
        Route::get('colors', 'index')->name('color.index');
        Route::get('colors/create', 'create')->name('color.create');
        Route::post('colors/create', 'store')->name('color.store');
        Route::get('colors/{color}/edit', 'edit')->name('color.edit');
        Route::put('colors/{color}', 'update')->name('color.update');
        Route::get('colors/{color}/delete', 'destroy')->name('color.delete');
    });

    //Order route
    Route::controller(\App\Http\Controllers\Admin\OrderController::class)->group(function () {
        // Route::get('/orders/{id}', 'show');
        Route::get('orders', 'index')->name('adminorder.index');
        Route::get('orders/{orderId}', 'show')->name('adminorder.show');
        Route::put('orders/{orderId}', 'updateOrderStatus')->name('adminorder.update');

        Route::get('invoice/{orderId}', 'viewInvoice')->name('admin.invoice');
        Route::get('invoice/{orderId}/generate', 'generateInvoice')->name('admin.generateinvoice');
    });

    //Brand route
    Route::get('brand', [BrandController::class, 'index'])->name('brand.index');

    //Slider route
    Route::controller(SliderController::class)->group(function () {
        Route::get('sliders', 'index')->name('slider.index');
        Route::get('sliders/create', 'create')->name('slider.create');
        Route::post('sliders/create', 'store')->name('slider.store');
        Route::get('sliders/{slider}/edit', 'edit')->name('slider.edit');
        Route::put('sliders/{slider}', 'update')->name('slider.update');
        Route::get('sliders/{slider}/delete', 'destroy')->name('slider.delete');
    });

    Route::controller(App\Http\Controllers\Admin\UserController::class)->group(function () {
        Route::get('/users', 'index');
        Route::get('/users/create', 'create');
        Route::post('/users', 'store');
        Route::get('users/{userId}/edit', 'edit');
        Route::put('/users/{userId}', 'update')->name('user.update');
        Route::get('/users/{userId}', 'destory');
    });
});
Route::middleware(['auth'])->group(function () {
    Route::get('wishlist', [WishListController::class, 'index'])->name('wishlist.index');
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::get('orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('orders/{orderId}', [OrderController::class, 'show'])->name('order.show');
    Route::get('profile', [UserController::class, 'index']);
    Route::post('profile',[UserController::class,'updateUserDetails']);
});

Route::get('thank-you', [FrontendController::class, 'thankyou'])->name('frontend.thankyou');
