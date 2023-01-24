<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\midDios;
use App\Http\Controllers\AsignarController;

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

//users**************
Route::controller (UserController::class)->prefix('user')->group(function () {
    Route::put('update','updateUser')->middleware(['cors']);
    Route::put('updateattributes','updateAttributes');
    Route::get('create/{id}/{number}','createUsers');
    Route::get('get/{id}','getUser');
    Route::get('getattributes/{id}', 'getAttributes');
    Route::get('delete/{id}','deleteUser')->middleware(['cors']);

});
//imagenes**************
Route::controller(ImageUploadController::class)->prefix('image')->group(function () {
    Route::get('getAvatar/{id}','getAvatar');
    Route::post('store','store' )->middleware(['cors']);
    Route::put('updateAvatar','updateAvatar')->middleware(['cors']);
});
//pruebas**************
Route::middleware('auth:sanctum')->prefix('prueba')->group(function () {
    Route::post('eleccion/crear', [PruebaController::class,'insertPruebaEleccion'])->middleware(['midDios']);
    Route::post('valoracion/crear', [PruebaController::class,'insertPruebaValoracion'])->middleware(['midDios']);
    Route::post('puntual/crear', [PruebaController::class,'insertPruebaPuntual'])->middleware(['midDios']);
    Route::post('resplibre/crear', [PruebaController::class,'insertPruebaRespLibre'])->middleware(['midDios']);
    Route::get('listar', [PruebaController::class,'getPruebas'])->middleware(['midDios']);
    Route::delete('borrar/{id}', [PruebaController::class,'deletePrueba'])->middleware(['midDios']);
});
//comunes, login, logout, registro, verificacion**************
Route::post('register', [AuthController::class, 'register'])->middleware(['cors']);
Route::post('login', [AuthController::class, 'login'])->middleware(['cors']);
Route::post('logout', [AuthController::class, 'logout']);
Route::get('verification', [VerificationController::class, 'verificateMail']);

//asignar**************
Route::middleware('auth:sanctum')->prefix('asignar')->group(function () {
    Route::get('listar/usuariosdios/{id}', [AsignarController::class,'getUsuariosDios']);
    Route::get('listar/usuarioprotegido/{id}/{idprueba}', [AsignarController::class,'getUsuariosProtegidos']);
    Route::get('listar/usuarioafin/{id}/{idprueba}', [AsignarController::class,'getUsuariosAfines']);
    Route::post('asignarprueba', [AsignarController::class,'insertarUsuariosAsignados']);
    Route::get('listar/usuariosasignados/{idprueba}', [AsignarController::class,'getUsuariosAsignados']);
});

// Route::controller(PruebaController::class)->prefix('prueba')->group(function () {
//     Route::post('eleccion/crear', 'insertPruebaEleccion')->middleware(['cors']);
//     Route::post('valoracion/crear', 'insertPruebaValoracion')->middleware(['cors']);
//     Route::post('puntual/crear', 'insertPruebaPuntual')->middleware(['cors']);
//     Route::post('resplibre/crear', 'insertPruebaRespLibre')->middleware(['cors']);
//     Route::get('listar', 'getPruebas')->middleware(['cors']);
//     Route::delete('borrar/{id}', 'deletePrueba')->middleware(['cors']);
// });

