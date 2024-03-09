<?php

use App\Http\Controllers\Admin\BlockController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\EnquirieController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Parser\Block\BlockContinue;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('admin', [LoginController::class, 'index'])->name('login');
Route::post('admin/login', [LoginController::class, 'login'])->name('login.post');

// for particular page open
Route::get('contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/{urlKey}', [HomeController::class, 'page'])->name('page');



Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('page', PageController::class);
    Route::resource('block', BlockController::class);
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('role', RoleController::class);
    Route::resource('permission', PermissionController::class);
    Route::get('enquirie', [EnquirieController::class, 'index'])->name('enquirie');
    Route::post('enquiriy-status', [EnquirieController::class, 'enquiriyStatus'])->name('enquiriy-status');
    Route::post('ckeditor/upload', [PageController::class, 'upload'])->name('ckeditor.upload');

});

// another way to use prefix in laravel-10
// Route::prefix('admin')->group(function(){
//     Route::get('login', [LoginController::class, 'index'])->name('login');
// });



Route::post('store', [EnquirieController::class, 'store'])->name('store');