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
use Illuminate\Support\Facades\Log;

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

    /**
     * Search questions with various filters
     */
    public function search(Request $request)
    {
        try {
            $query = Question::query()
                ->with('user')
                ->withCount('answers');

            // Search by title or body
            if ($request->has('q') && !empty($request->q)) {
                $searchTerm = $request->q;
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('title', 'LIKE', "%{$searchTerm}%")
                      ->orWhere('body', 'LIKE', "%{$searchTerm}%");
                });
            }

            // Filter by category if you add this column later
            if ($request->has('category') && !empty($request->category)) {
                // Only if category column exists
                if (\Illuminate\Support\Facades\Schema::hasColumn('questions', 'category')) {
                    $query->where('category', $request->category);
                }
            }

            // Sort options
            $sortBy = $request->get('sort_by', 'created_at');
            $sortOrder = $request->get('sort_order', 'desc');

            // Only allow safe sort columns that exist
            $allowedSorts = ['created_at', 'title', 'updated_at'];
            if (in_array($sortBy, $allowedSorts)) {
                $query->orderBy($sortBy, $sortOrder);
            } else {
                $query->latest();
            }

            // Pagination
            $perPage = $request->get('per_page', 15);
            $questions = $query->paginate($perPage);

            // Add user vote for each question if authenticated
            if (auth()->check()) {
                foreach ($questions as $question) {
                    if (method_exists($question, 'userVote')) {
                        $question->user_vote = $question->userVote();
                    }
                }
            }

            return response()->json([
                'success' => true,
                'message' => "Questions searched successfully",
                'data' => QuestionResource::collection($questions->items()),
                'current_page' => $questions->currentPage(),
                'last_page' => $questions->lastPage(),
                'per_page' => $questions->perPage(),
                'total' => $questions->total(),
                'search_meta' => [
                    'query' => $request->q,
                    'filters' => $request->except(['q', 'page', 'per_page', 'sort_by', 'sort_order']),
                    'sort_by' => $sortBy,
                    'sort_order' => $sortOrder
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Search error: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Search failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
