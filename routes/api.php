<?php

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

Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (){

    Route::get('status',function (){
        return response()->json([
            'status' => 'ok',
            'server_time' => \Carbon\Carbon::now()->timestamp
        ]);
    });

    Route::prefix('/inventory')->group(function (){
        Route::get('/',[\App\Http\Controllers\API\APIController::class,'inventoriesList']);
        Route::get('/list',[\App\Http\Controllers\API\APIController::class,'inventoriesList']);
        Route::get('/all-items',[\App\Http\Controllers\API\APIController::class,'allInventoryItems']);
        Route::get('/{inventory:id}/items',[\App\Http\Controllers\API\APIController::class,'inventoryItems']);
        Route::get('/{inventory:id}/vars',[\App\Http\Controllers\API\APIController::class,'inventoryVariables']);
    });

    Route::prefix('/playbook')->group(function (){
        Route::get('/',[\App\Http\Controllers\API\APIController::class,'playbooks']);
        Route::get('/list',[\App\Http\Controllers\API\APIController::class,'playbooks']);
    });

    Route::prefix('/create')->group(function (){
        Route::post('/full-play',[\App\Http\Controllers\API\APIController::class,'createFullPlay']);
        Route::post('/series',[\App\Http\Controllers\API\APIController::class,'createSeriesPlay']);
    });

});
