<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Http\Resources\AnswerResource;
use App\Http\Resources\AnswerResourceCollection;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function index(){
        $answer = Answer::latest()->paginate(15);
        return response()->json([
            'success'=>true,
            'message'=> "Answers retrieved successfully",
            'data' => new AnswerResourceCollection($answer)
        ]);
    }

   public function getAnswers($id){
    $answers = Answer::where('question_id', $id)
        ->with('user')  // Load the user relationship
        ->get();

    if($answers->isEmpty()){
        return response()->json([
            'success' => false,
            'message'=> 'No answers found for this question',
        ],404);
    }

    return response()->json([
        'success'=>true,
        'message' => 'Answers retrieved successfully',
        'data' => AnswerResource::collection($answers)
    ]);
}

    public function store(StoreAnswerRequest $request)
    {
    $validated = $request->validated();

    $validated['user_id'] = Auth::id();
    // $validated['question_id'] = $question->id;

    $answer = Answer::create($validated);

    return response()->json([
        'success' => true,
        'message' => 'Answer stored successfully',
        'data' => new AnswerResource($answer)
    ], 201);
    }


    public function show(Answer $answer){
        return response()->json([
            'success' =>true,
            'message'=> 'Answer retrieved successfuly',
            'data' => new AnswerResource($answer)
        ],200);
    }

    public function update(UpdateAnswerRequest $request, Answer $answer){

        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        $answer->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Answer updated successfully',
            'data' => new AnswerResource($answer)
        ],201);
    }

    public function destroy(Answer $answer){
        $answer->delete();
        return response()->json([
            'success' => true,
            'message'=> 'Answer deleted successfully',

        ], 200);
    }
}
