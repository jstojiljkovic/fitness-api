<?php

use App\Http\Controllers\V1\Auth\LoginController;
use App\Http\Controllers\V1\Auth\RegisterController;
use App\Http\Controllers\V1\EquipmentController;
use App\Http\Controllers\V1\VideoController;
use App\Http\Controllers\V1\WorkoutController;
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

Route::middleware('auth:api')->prefix('v1')->group(static function () {
    //TODO Access to this will go through CMS
    // Route::apiResource('organisations', OrganisationController::class);
    Route::apiResource('equipments', EquipmentController::class);
    Route::apiResource('videos', VideoController::class);
    Route::apiResource('workouts', WorkoutController::class);
});

Route::prefix('/v1')->group(static function () {
    Route::post('/register', [ RegisterController::class, 'register' ]);
    Route::post('/login', [ LoginController::class, 'login' ]);
});
