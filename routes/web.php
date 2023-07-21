<?php

use App\Http\Controllers\Api\AuthController as ApiAuthController;
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

Route::get('/login', [ViewController::class, 'login'])->name('login');
Route::get('/forbiden', [ApiAuthController::class, 'forbiden'])->name('forbiden');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function(){
    Route::get('/form-porto', [ViewController::class, 'formPorto']);
    Route::post('/form-submit', [PortoController::class, 'createPorto']);
    Route::get('/porto-delete/{portoId}', [PortoController::class, 'deletePorto']);

    Route::get('/form-porto/edit/{id}', [ViewController::class, 'viewPorto']);
    Route::post('/form-porto/update/{id}', [PortoController::class, 'updatePorto']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::get('/porto/detail/{id}', [ViewController::class, 'viewDetailPorto']);
