<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=>'auth'],function(){

    Route::post('login', [RegisterController::class,'login']);
    Route::post('signup', [RegisterController::class,'signup']);
    Route::group(['middleware'=>'auth:api'], function(){
        Route::get('logout', [RegisterController::class,'logout']);
        Route::get('user', [RegisterController::class,'user']);
    });



});

/*
Route::post('/register', [RegisterController::class, 'register']);
 Route::post('/login', [RegisterController::class, 'login']);
*/
Route::prefix('')->group(function(){
    Route::resource('posts', PostsController::class);
});