<?php

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

Route::get('/', function () {
    return view('pages.app');
});

Route::get('/form-porto', function () {
    return view('pages.formPortoPage');
});

Route::post('/form-submit', function(){
    return response()->json([
        'data' => request()->toArray()
    ]);
});