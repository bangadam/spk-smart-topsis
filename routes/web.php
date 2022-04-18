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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('sub-criterias', App\Http\Controllers\SubCriteriaController::class);
Route::resource('populationAssesments', App\Http\Controllers\PopulationAssesmentController::class);
Route::resource('dashboards', App\Http\Controllers\DashboardController::class);

/** Dss */
Route::resource('dss', DssController::class);

Route::resource('criterias', App\Http\Controllers\CriteriaController::class);
Route::resource('subCriterias', App\Http\Controllers\SubCriteriaController::class);
Route::resource('populations', App\Http\Controllers\PopulationController::class);
