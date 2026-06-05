<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index()
{
    $questions = Question::with('user')  // First, eager load the relationship
        ->latest()
        ->paginate(5);

    return response()->json([
        'success' => true,
        'message' => "Questions retrieved successfully",
        'data' => QuestionResource::collection($questions),
    ]);
}
}
