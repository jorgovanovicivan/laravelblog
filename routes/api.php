<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

use App\Http\Controllers\RegisterController;
use Laravelista\Comments\CommentController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!

Route::group(['prefix'=>'auth'],function(){

    Route::post('login', [RegisterController::class,'login']);
    Route::post('signup', [RegisterController::class,'signup']);
    Route::group(['middleware'=>'auth:api'], function(){
        Route::get('logout', [RegisterController::class,'logout']);
        Route::get('user', [RegisterController::class,'user']);
    });



});
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post('/register', [RegisterController::class, 'register']);
 Route::post('/login', [RegisterController::class, 'login']);

Route::prefix('')->group(function(){
    Route::resource('posts', PostsController::class);
});

Route::post('/comments',[CommentController::class,'store']);
Route::delete('comments/{comment}',[CommentController::class,'destroy']);
Route::post('comments/{comment}',[CommentController::class,'reply']);
Route::put('comments/{comment}',[CommentController::class,'update']);