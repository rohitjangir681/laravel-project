<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\BlockController;
use App\Http\Controllers\Admin\CartController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ManageCustomerController;
use App\Http\Controllers\Admin\ManageOrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\CustomCssFile;

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
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::post('enquiries-store', [EnquiryController::class, 'store'])->name('enquiries.store');
Route::get('admin', [LoginController::class, 'index'])->name('login');
Route::post('admin/login', [LoginController::class, 'login'])->name('login.post');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('user', UserController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::resource('page', PageController::class);
    Route::post('ckeditor/upload', [PageController::class, 'upload'])->name('ckeditor.upload');
    Route::resource('slider', SliderController::class);
    Route::resource('block', BlockController::class);
    Route::get('enquiries', [EnquiryController::class, 'index'])->name('enquiries');
    
    Route::post('enquiriy-status', [EnquiryController::class, 'enquiriyStatus'])->name('enquiriy.status');
    Route::resource('coupon', CouponController::class);

    // Products route
    Route::resource('product', ProductController::class);

    // Category route
    Route::resource('category', CategoryController::class);

    // Attribute route
    Route::resource('attribute', AttributeController::class);

    Route::get('manage-orders', [ManageOrderController::class, 'ManageOrders'])->name('manage.orders');
    Route::get('order-show/{id}', [ManageOrderController::class, 'show'])->name('order.show');

    Route::get('manage/customers', [ManageCustomerController::class, 'index'])->name('manage.customers');
    Route::get('manage/customers/show/{id}', [ManageCustomerController::class, 'show'])->name('manage.customer.show');
    Route::get('manage/customers/order/show/{id}', [ManageCustomerController::class, 'orderShow'])->name('manage.customer.order.show');

});



Route::get('customer/create', [CustomerController::class, 'create'])->name('customer.create');
Route::get('customer/login', [CustomerController::class, 'customerLogin'])->name('customer.login');
Route::post('customer/authenticate', [CustomerController::class, 'login'])->name('customer.authenticate');
Route::post('customer/store', [CustomerController::class, 'store'])->name('customer.store');
Route::get('customer/logout', [CustomerController::class, 'logout'])->name('customer.logout');
Route::get('customer/profile', [CustomerController::class, 'profile'])->name('customer.profile');
Route::post('customer/update', [CustomerController::class, 'update'])->name('customer.update');
Route::get('customer/product/show/{id}', [CustomerController::class, 'customerProductShow'])->name('customer.product.show');


Route::post('wishlist/store', [WishlistController::class, 'store'])->name('wishlist.store');
Route::post('wishlist/destroy/{productId}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');


Route::get('cart', [CartController::class, 'viewCart'])->name('cart');

// cart delete
Route::delete('cart/delete/{id}', [CartController::class, 'cartDelete'])->name('cart.delete');

// increase cart item on cart view page..
Route::post('cart/update-item/{id}', [CartController::class, 'cartUpdate'])->name('cart.update-item');

Route::get('checkout', [CheckoutController::class, 'CheckoutPage'])->name('checkout.page');

Route::post('checkout-place-order', [CheckoutController::class, 'CheckoutPlaceOrderStore'])->name('checkout.place.order');
Route::get('checkout/order-success', [CheckoutController::class, 'CheckoutOrderSuccess'])->name('checkout.order.success');





// coupon apply
Route::post('coupon/apply', [CartController::class, 'couponApply'])->name('coupon.apply');


// getting category by this route
Route::get('/category/{url_key}', [HomeController::class, 'categoryData'])->name('category.data');

Route::get('/product/{url_key}', [HomeController::class, 'productData'])->name('product.data');

// cart route
Route::post('cart/store/{id}', [CartController::class, 'addToCart'])->name('cart.store');

// getting page and block by this
Route::get('/{url_key}', [HomeController::class, 'pageData'])->name('page.data');
