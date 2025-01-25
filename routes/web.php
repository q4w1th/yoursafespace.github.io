<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;

Route::get('/test', [SurveyController::class, 'show']);
Route::post('/test', [SurveyController::class, 'submit']);
