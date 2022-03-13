<?php

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
Route::resource('criterias', App\Http\Controllers\CriteriaController::class);
Route::resource('sub-criterias', App\Http\Controllers\SubCriteriaController::class);
Route::resource('surveyors', App\Http\Controllers\SurveyorController::class);


Route::resource('waves', App\Http\Controllers\WaveController::class);








Route::resource('populations', App\Http\Controllers\PopulationController::class);


Route::resource('populationAssesments', App\Http\Controllers\PopulationAssesmentController::class);


Route::resource('receivers', App\Http\Controllers\ReceiverController::class);
