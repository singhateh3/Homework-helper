<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index()
{
     $questions = Question::with('user')
        ->withCount('answers')
        ->latest()
        ->limit(5)
        ->get();

    // Add user vote for each question if authenticated
    if (auth()->check()) {
        foreach ($questions as $question) {
            $question->user_vote = $question->userVote();
        }
    }

    return response()->json([
        'success' => true,
        'data' => QuestionResource::collection($questions),
    ]);
}
}
