<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Grupo de rutas que no requieren token - Abierta
Route::prefix('v1')->group(function(){
    //Ruta de login para usuario
    Route::post('login', [AuthController::class, 'login']);
});

Route::prefix('v1')->middleware('auth.api')->group(function(){
    ///api/v1/users
    Route::get('users', [UserController::class, 'getAll']);
    ///api/v1/user/{id}
    Route::get('user', [UserController::class, 'getUser']);
});