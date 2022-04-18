<?php

use App\Http\Controllers\Api\IndonesiaRegionController;
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

// API Indonesia Region
Route::group(['prefix' => 'indonesia'], function () {
    Route::get('/cities/{province_id}', [IndonesiaRegionController::class, 'getCities'])->name('api.indonesia.cities');
    Route::get('/districts/{city_id}', [IndonesiaRegionController::class, 'getDistricts'])->name('api.indonesia.districts');
    Route::get('/villages/{district_id}', [IndonesiaRegionController::class, 'getVillages'])->name('api.indonesia.villages');
});
