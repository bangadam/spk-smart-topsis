<?php

use App\Http\Controllers\DssController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

// Home
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'backoffice'], function() {
    Route::resource('dashboards', App\Http\Controllers\DashboardController::class);

    /** Master */
    Route::resource('sub-criterias', App\Http\Controllers\SubCriteriaController::class);
    Route::resource('populationAssesments', App\Http\Controllers\PopulationAssesmentController::class);
    Route::resource('criterias', App\Http\Controllers\CriteriaController::class);
    Route::resource('subCriterias', App\Http\Controllers\SubCriteriaController::class);
    Route::resource('populations', App\Http\Controllers\PopulationController::class);

    /** Dss */
    Route::resource('dss', DssController::class);

    /** Profile */
    Route::resource('profiles', App\Http\Controllers\ProfileController::class);
});




Route::resource('periods', App\Http\Controllers\PeriodController::class);
