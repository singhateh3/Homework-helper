<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('/questions', QuestionController::class);
    Route::apiResource('/answers', AnswerController::class);
    Route::get('/questions/{id}/answers', [AnswerController::class, 'getAnswers']);


});
