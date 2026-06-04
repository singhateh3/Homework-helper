<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\API\StatsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/stats', [StatsController::class, 'index']);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('/questions', QuestionController::class);
    Route::apiResource('/answers', AnswerController::class);
    Route::get('/questions/{id}/answers', [AnswerController::class, 'getAnswers']);
    Route::get('/top-questions', [DashboardController::class, 'index']);

});
