<?php


use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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
// 1|RAye8OUg6aXM7SMQyq8m5Qq6fUvgv9MSPbH2bQer4ea1a232

Route::group(['prefix' => 'v1', 'middleware' => 'auth:sanctum'], function(){
    Route::resource('users', UserController::class);
});


Route::get('get-token', function() {
    $user = User::find(38);
    $token = $user->createToken('auth:sanctum');
    return $token->plainTextToken;
});



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
