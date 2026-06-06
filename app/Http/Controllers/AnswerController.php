<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Http\Resources\AnswerResource;
use App\Http\Resources\AnswerResourceCollection;
use App\Models\Answer;
use App\Models\Question;
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

   public function getAnswers($questionId)
{
    $question = Question::findOrFail($questionId);
    $answers = $question->answers()->with('user')->get();

    // Add user vote information for each answer
    foreach ($answers as $answer) {
        // Get vote count
        $answer->votes_count = $answer->votes()->sum('type');

        // Get current user's vote
        if (auth()->check()) {
            $answer->user_vote = $answer->userVote();
        } else {
            $answer->user_vote = null;
        }
    }

    return response()->json([
        'success' => true,
        'data' => $answers
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
