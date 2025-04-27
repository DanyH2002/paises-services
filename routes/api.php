<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CountriesController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\Regions;

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('users')->group(function () {
        Route::post('/logout', [UserController::class, 'logout']);
    });

    Route::prefix('countries')->group(function () {
        Route::post('/create', [CountriesController::class, 'create']);
        Route::get('/list', [CountriesController::class, 'list']);
        Route::get('/{id}', [CountriesController::class, 'show']);
        Route::put('/update/{id}', [CountriesController::class, 'update'])-> where('id', '[0-9]+');
        Route::delete('/delete/{id}', [CountriesController::class, 'delete'])->where('id', '[0-9]+');
    });
    Route::get('regiones', [Regions::class, 'list']);
});
