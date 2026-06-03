<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionResource;
use App\Http\Resources\QuestionResourceCollection;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function index()
{
    $questions = Question::latest()->paginate(15);

    return response()->json([
        'success' => true,
        'message' => "Questions retrieved successfully",
        'data' => QuestionResource::collection($questions->items()),
        'current_page' => $questions->currentPage(),
        'last_page' => $questions->lastPage(),
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

    public function show(Question $question){
        return response()->json([
            'success'=> true,
            'message' => 'Question retrieved successfully',
            'data'=> new QuestionResource($question)
        ], 200);
    }

    public function update(UpdateQuestionRequest $request, Question $question){
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
        $question->delete();
        return response()->json([
            'success' => true,
            'message'=> 'Question deleted successfully',

        ], 200);
    }
}
