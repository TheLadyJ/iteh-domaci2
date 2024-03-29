<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ReceptController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserReceptController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::resource('recepti', ReceptController::class)->only(['index','show']);
Route::resource('users.recepti',UserReceptController::class)->only(['index','show']);

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware'=>['auth:sanctum']], function(){
    Route::get('/profil', function(Request $request){
        return auth()->user();
    });
    Route::resource('recepti', ReceptController::class)->only(['update','store','destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
});