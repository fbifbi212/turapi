<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AutController;
use App\Http\Controllers\TourController;
use App\Http\Controllers\UserController;
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
/* burda register deneme kullanıcı açmak için eklenmiştir. */

Route::post('/register', [AutController::class, 'register']);
Route::post('/login', [AutController::class, 'login']);
Route::post('/logout', [AutController::class, 'logout'])->middleware('auth:api');
/* eğer istenirse tüm turları listelemek için bağlantı eklenebilir buraya middlewaresiz yetkisiz
Route::get('/AllTours', [TourController::class, 'indexAll']);
gibi
*/



Route::group(['middleware' => 'auth:api'], function () {
    Route::middleware(['App\Http\Middleware\CheckUserRole:admin,tour_operator'])->group(function () {
        Route::resource('tours', TourController::class);
    });

    Route::middleware(['App\Http\Middleware\CheckUserRole:admin'])->group(function () {
        Route::resource('user', UserController::class);
    });
});
