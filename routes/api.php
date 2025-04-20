<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CountriesController;
use App\Http\Controllers\api\UserController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function ()
{
    Route::prefix('users')->group(function ()
    {
        Route::put('/change-password/{id}', [UserController::class, 'changePassword'])->where('id', '[0-9]+');
        Route::put('/update-profile/{id}', [UserController::class, 'updateProfile'])->where('id', '[0-9]+');
        Route::get('/logout', [UserController::class, 'logout']);
    });

    Route::prefix('countries')->group(function ()
    {
        Route::get('', [CountriesController::class, 'list']);
        Route::get('/show/{id}', [CountriesController::class, 'show'])->where('id', '[0-9]+');
        Route::post('/create', [CountriesController::class, 'create']);
        Route::put('/update/{id}', [CountriesController::class, 'update'])->where('id', '[0-9]+');
        Route::delete('/delete/{id}', [CountriesController::class, 'delete'])->where('id', '[0-9]+');
        Route::post('/index', [CountriesController::class, 'filter']);
        Route::get('/regions', [CountriesController::class, 'regions']);
        Route::get('/regions/{id}', [CountriesController::class, 'countriesByRegion'])->where('id', '[0-9]+');
    });
});
