<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuestionResourceCollection;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class QuestionController extends Controller
{
    public function index()
{
    $questions = Question::with('user')
        ->withCount('answers')
        ->latest()
        ->paginate(15);

    // Add user vote for each question if authenticated
    if (auth()->check()) {
        foreach ($questions as $question) {
            $question->user_vote = $question->userVote();
        }
    }

    return response()->json([
        'success' => true,
        'message' => "Questions retrieved successfully",
        'data' => QuestionResource::collection($questions->items()),
        'current_page' => $questions->currentPage(),
        'last_page' => $questions->lastPage(),
        'per_page' => $questions->perPage(),
        'total' => $questions->total(),
    ]);
}

    public function store(StoreQuestionRequest $request){
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $question = Question::create($validated);
        return response()->json([
            'success'=>true,
           'message' => 'Question created successfully',
           'data' => new QuestionResource($question)
        ], 201);
    }


   public function show(Question $question)
    {
        $question->load('user');  // Load the user relationship

        return response()->json([
            'success' => true,
            'message' => 'Question retrieved successfully',
            'data' => new QuestionResource($question)
        ], 200);
    }

    public function update(UpdateQuestionRequest $request, Question $question){
        Gate::authorize('update-question', $question);
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        $question->update($validated);

        return response()->json([
            'success'=>true,
            'message'=> 'Question Updated Successfully',
            'data' => new QuestionResource($question)
        ], 200);
    }

    public function destroy(Question $question){
        Gate::authorize('delete-question', $question);
        $question->delete();
        return response()->json([
            'success' => true,
            'message'=> 'Question deleted successfully',

        ], 200);
    }
}
