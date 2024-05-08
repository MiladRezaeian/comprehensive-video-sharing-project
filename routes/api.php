<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\VideoController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('videos/{video:slug}', [VideoController::class, 'show']);
    Route::get('videos', [VideoController::class, 'index']);
    Route::post('videos', [VideoController::class, 'store'])->middleware('auth:sanctum');
    Route::put('videos/{video:slug}', [VideoController::class, 'update'])->middleware('auth:sanctum');
    Route::delete('videos/{video:slug}', [VideoController::class, 'destroy'])->middleware('auth:sanctum');

    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::get('me', [AuthController::class, 'me'])->middleware('auth:sanctum');
        Route::get('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
    });
});
