<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\NivelesController;
use App\Http\Controllers\UsuariosController;

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

Route::controller(NivelesController::class)->group(function () {
    Route::get('/niveles', 'index');
    Route::get('niveles/{id}', 'show');
    Route::post('niveles', 'store');
    Route::put('niveles/{id}', 'update');
});

Route::controller(UsuariosController::class)->group(function () {
    Route::get('usuarios', 'index');
    Route::get('usuarios/{id}', 'show');
    Route::post('usuarios', 'store');
    Route::put('usuarios/{id}', 'update');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
