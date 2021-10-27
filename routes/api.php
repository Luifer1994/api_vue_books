<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
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
//login
Route::post('/login', [LoginController::class,'login']);



//RUTAS PROTEGIDAS POR SESION
Route::group(['middleware'=>'auth:api'], function(){
    Route::get('/books-list/{limit}', [BookController::class, 'index']);
    Route::post('/books-store', [BookController::class, 'store']);
    Route::put('/books-update/{id}', [BookController::class, 'update']);
    Route::delete('/books-delete/{id}', [BookController::class, 'destroy']);
});
