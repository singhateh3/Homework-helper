<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;
use Illuminate\Http\Request;

class StatsController extends Controller
{
    public function index()
    {
        $stats = [
            'total_questions' => Question::count(),
            'total_answers' => Answer::count(),
            'total_users' => User::count(),
            'today_questions' => Question::whereDate('created_at', today())->count(),
            'today_answers' => Answer::whereDate('created_at', today())->count(),
            'most_active_user' => $this->getMostActiveUser(),
            'popular_tags' => $this->getPopularTags(),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }

    private function getMostActiveUser()
    {
        $user = User::withCount(['questions', 'answers'])
            ->havingRaw('questions_count + answers_count > 0')
            ->orderByRaw('questions_count + answers_count DESC')
            ->first();

        if ($user) {
            return [
                'name' => $user->name,
                'total_contributions' => $user->questions_count + $user->answers_count
            ];
        }

        return null;
    }

    private function getPopularTags()
    {
        // If you have a tags system, implement it here
        // For now, returning sample data or empty array
        return [];
    }
}
