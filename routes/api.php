<?php

use App\Http\Controllers\Api\APIPortoController;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Auth
Route::post('login', [AuthController::class, 'login']);

Route::get('list-porto',[APIPortoController::class, 'listPorto'])->middleware('auth:api');
Route::post('create-porto', [APIPortoController::class, 'createPorto'])->middleware('auth:api');
Route::put('update-porto/{portoId}', [APIPortoController::class, 'updatePorto'])->middleware('auth:api');
Route::delete('delete-porto/{portoId}', [APIPortoController::class, 'deletePorto'])->middleware('auth:api');
