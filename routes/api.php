<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IpManagementController;

Route::prefix('v1')->group(function () {

    Route::prefix('auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);

        Route::middleware('auth:api')->group(function () {
            Route::post('/logout', [AuthController::class, 'logout']);
            Route::post('/refresh', [AuthController::class, 'refresh']);
        });
    });

    Route::middleware('auth:api')->group(function () {

        Route::prefix('ip-management')->group(function () {
            Route::post('/store', [IpManagementController::class, 'store']);
            Route::put('/update/{ip}', [IpManagementController::class, 'update']);
            Route::get('/show/{ip}', [IpManagementController::class, 'show']);
            Route::get('/index', [IpManagementController::class, 'index']);
            Route::get('/index/audit', [IpManagementController::class, 'auditLog']);
            Route::delete('/destroy/{ip}', [IpManagementController::class, 'destroy']);
        });

        Route::prefix('ip-management')->group(function () {
            Route::post('/comment/store', [IpManagementController::class, 'store']);
            Route::put('/comment/update/{ip}', [IpManagementController::class, 'update']);
            Route::get('/comment/show/{ip}', [IpManagementController::class, 'show']);
            Route::get('/comment/index', [IpManagementController::class, 'index']);
            Route::delete('/comment/destroy/{ip}', [IpManagementController::class, 'destroy']);
        });

    });


});




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');
