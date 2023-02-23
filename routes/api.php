<?php

use App\Http\Controllers\V1\Auth\LoginController;
use App\Http\Controllers\V1\Auth\RegisterController;
use App\Http\Controllers\V1\EquipmentController;
use App\Http\Controllers\V1\ScheduleController;
use App\Http\Controllers\V1\SessionController;
use App\Http\Controllers\V1\VideoController;
use App\Http\Controllers\V1\WorkHourController;
use App\Http\Controllers\V1\WorkHourExceptionController;
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

    Route::middleware('employee')->group(static function () {
        Route::apiResources([
            'equipments' => EquipmentController::class,
            'videos' => VideoController::class,
            'workouts' => WorkoutController::class,
        ]);

        Route::apiResource('work-hours', WorkHourController::class)
            ->only([ 'index', 'store', 'update' ]);

        Route::apiResource('work-hour-exceptions', WorkHourExceptionController::class)
            ->only([ 'index', 'store', 'update', 'destroy' ]);

        Route::controller(SessionController::class)
            ->prefix('sessions')
            ->group(static function () {
                Route::get('', 'index');
                Route::post('/group', 'storeGroup');
            });
    });

    Route::controller(SessionController::class)
        ->prefix('sessions')
        ->group(static function () {
            Route::post('/individual', 'storeIndividual');
            Route::post('/join-group', 'joinGroup');
        });

    Route::controller(ScheduleController::class)
        ->prefix('schedule')
        ->group(static function () {
            Route::get('/daily', 'getDailySchedule');
        });
});

Route::prefix('/v1')->group(static function () {
    Route::post('/register', [ RegisterController::class, 'register' ]);
    Route::post('/login', [ LoginController::class, 'login' ]);
});
