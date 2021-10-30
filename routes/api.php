<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/students-list', [StudentController::class,'index']);
//login
Route::post('/login', [LoginController::class,'login']);
//RUTAS PROTEGIDAS POR SESION
Route::group(['middleware'=>'auth:api'], function(){
    Route::get('/books-list/{limit}', [BookController::class, 'index']);
    Route::post('/books-store', [BookController::class, 'store']);
    Route::put('/books-update/{id}', [BookController::class, 'update']);
    Route::delete('/books-delete/{id}', [BookController::class, 'destroy']);
});

