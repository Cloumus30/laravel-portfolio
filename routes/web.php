<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PortoController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [ViewController::class, 'home']);

Route::get('/login', [ViewController::class, 'login']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/form-porto', [ViewController::class, 'formPorto']);
Route::post('/form-submit', [PortoController::class, 'createPorto']);
Route::get('/porto-delete/{portoId}', [PortoController::class, 'deletePorto']);

Route::get('/coba', [ViewController::class, 'coba']);