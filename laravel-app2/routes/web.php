<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Custom\Myfolder\CustomNamespace as newNameForThis; // my custom namespace class
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\DeletePracticeController;
use App\Http\Controllers\Home\HomeController;

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

Route::get('test', function(){
    $customNamespace = new newNameForThis();
    return $customNamespace->getNameSpace();
});

Route::post('customimage', [PageController::class, 'customImage'])->name('customimage');


Route::get('new-test', [TestController::class, 'index'])->name('new-test');

Route::resource('student', StudentController::class);

Route::get('test', [TestController::class, 'myTestFunction'])->name('test');

Route::get('admin', [LoginController::class, 'index'])->name('login');
Route::post('admin/login', [LoginController::class, 'login'])->name('login.post');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class);
    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('role', RoleController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('ckeditor', NewController::class);
    Route::post('ckeditor/upload', [NewController::class, 'upload'])->name('ckeditor.upload');
    Route::get('delete', [DeletePracticeController::class, 'index'])->name('delete');
    Route::post('deleteStore', [DeletePracticeController::class, 'store'])->name('delete.store');
    Route::delete('delete.destroy/{id}', [DeletePracticeController::class, 'destroy'])->name('delete.destroy');
    Route::get('profile/{id}', [DeletePracticeController::class, 'show'])->name('delete.show');

    // Page add, delete, show etc...
    Route::get('page', [PageController::class, 'index'])->name('page.index');
    Route::get('page/create', [PageController::class, 'create'])->name('page.create');
    Route::post('page/store', [PageController::class, 'store'])->name('page.store');
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/{url_key}', [PageController::class, 'pageData'])->name('page.data');


