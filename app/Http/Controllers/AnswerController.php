<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Http\Resources\AnswerResource;
use App\Http\Resources\AnswerResourceCollection;
use App\Models\Answer;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request; // Fix: Use proper Request class

class AnswerController extends Controller
{
    public function index(){
        $answer = Answer::with('user')->latest()->paginate(15);
        return response()->json([
            'success'=>true,
            'message'=> "Answers retrieved successfully",
            'data' => AnswerResource::collection($answer) // Use AnswerResource::collection
        ]);
    }

    // Updated getAnswers method with pagination
    public function getAnswers($questionId, Request $request)
    {
        $perPage = $request->get('per_page', 10);
        $page = $request->get('page', 1);

        $question = Question::findOrFail($questionId);

        // Get paginated answers with user relationship
        $answers = $question->answers()
            ->with('user') // Load user relationship
            ->orderBy('is_accepted', 'desc') // Show accepted answers first
            ->orderBy('created_at', 'desc')
            ->paginate($perPage, ['*'], 'page', $page);

        // Add user vote information for each answer
        if (auth()->check()) {
            foreach ($answers as $answer) {
                $answer->user_vote = $answer->userVote();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Answers retrieved successfully',
            'data' => AnswerResource::collection($answers), // Use Resource collection
            'current_page' => $answers->currentPage(),
            'last_page' => $answers->lastPage(),
            'per_page' => $answers->perPage(),
            'total' => $answers->total(),
        ]);
    }

    public function store(StoreAnswerRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();

        $answer = Answer::create($validated);
        $answer->load('user'); // Load user relationship

        return response()->json([
            'success' => true,
            'message' => 'Answer stored successfully',
            'data' => new AnswerResource($answer)
        ], 201);
    }

    public function show(Answer $answer){
        $answer->load('user'); // Load user relationship

        return response()->json([
            'success' => true,
            'message' => 'Answer retrieved successfully',
            'data' => new AnswerResource($answer)
        ], 200);
    }

    public function update(UpdateAnswerRequest $request, Answer $answer){
        // Check if user owns the answer
        if (Auth::id() !== $answer->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to update this answer'
            ], 403);
        }

        $validated = $request->validated();
        $answer->update($validated);
        $answer->load('user'); // Load user relationship

        return response()->json([
            'success' => true,
            'message' => 'Answer updated successfully',
            'data' => new AnswerResource($answer)
        ], 200); // Should be 200, not 201
    }

    public function destroy(Answer $answer){
        // Check if user owns the answer or is the question owner
        if (Auth::id() !== $answer->user_id && Auth::id() !== $answer->question->user_id) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to delete this answer'
            ], 403);
        }

        $answer->delete();

        return response()->json([
            'success' => true,
            'message' => 'Answer deleted successfully',
        ], 200);
    }

    /**
     * Accept an answer
     */
    public function accept(Answer $answer)
    {
        // Use Gate to check if user is the question owner
        if (Gate::denies('accept-answer', $answer)) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to accept this answer'
            ], 403);
        }

        try {
            $answer->accept();
            $answer->load('user'); // Load user relationship

            return response()->json([
                'success' => true,
                'message' => 'Answer accepted successfully',
                'data' => new AnswerResource($answer)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to accept answer: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Unaccept an answer
     */
    public function unaccept(Answer $answer)
    {
        // Use Gate to check if user is the question owner
        if (Gate::denies('unaccept-answer', $answer)) {
            return response()->json([
                'success' => false,
                'message' => 'You are not authorized to unaccept this answer'
            ], 403);
        }

        try {
            $answer->unaccept();
            $answer->load('user'); // Load user relationship

            return response()->json([
                'success' => true,
                'message' => 'Answer unaccepted successfully',
                'data' => new AnswerResource($answer)
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to unaccept answer: ' . $e->getMessage()
            ], 500);
        }
    }
}
