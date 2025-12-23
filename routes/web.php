<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\ScoreController;
use App\Http\Controllers\WeightedProductController;

Route::resource('students', StudentController::class);
Route::resource('criterias', CriteriaController::class);
Route::resource('scores', ScoreController::class);
Route::resource('calculations', WeightedProductController::class);

Route::get('/', function () {
    return view('alternatives.index');
});
