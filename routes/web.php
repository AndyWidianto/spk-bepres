<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\ScoreController;

Route::resource('students', StudentController::class);
Route::resource('criterias', CriteriaController::class);
Route::resource('scores', ScoreController::class);

Route::get('/', function () {
    return view('alternatives.index');
});
