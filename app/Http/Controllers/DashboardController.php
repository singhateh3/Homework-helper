<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Models\Question;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $questions = Question::latest()->paginate(5)->with('user')->get();

        return response()->json([
            'success' => true,
            'message' => "Questions retrieved successfully",
            'data' => QuestionResource::collection($questions),
        ]);
    }
}
