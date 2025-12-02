<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CountriesController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\ContinentController;
use App\Http\Controllers\api\LanguageController;
use App\Http\Controllers\api\CurrencyController;

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
        Route::post('/update/{id}', [CountriesController::class, 'update']);
        Route::delete('/delete/{id}', [CountriesController::class, 'delete']);
    });

    Route::prefix('catalogs')->group(function () {
        Route::get('/continents', [ContinentController::class, 'list']);
        Route::get('/languages', [LanguageController::class, 'list']);
        Route::get('/currencies', [CurrencyController::class, 'list']);
    });
});
