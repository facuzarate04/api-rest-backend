<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Turn\TurnController;
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
Route::prefix('v1')->group(function () {
    Route::post('register',[AuthController::class, 'register'])->name('register');
    Route::post('login',[AuthController::class, 'login'])->name('login');

    Route::middleware([])->group(function () { 
        Route::resource('turns', TurnController::class);
    });
});

