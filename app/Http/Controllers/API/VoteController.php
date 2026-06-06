<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function voteQuestion(Request $request, Question $question)
    {
        $userId = auth()->id();

        // If it's a DELETE request or has 'remove' parameter
        if ($request->isMethod('delete') || $request->input('remove')) {
            $vote = $question->votes()->where('user_id', $userId)->first();
            if ($vote) {
                $vote->delete();
            }

            $question->refresh();

            return response()->json([
                'success' => true,
                'message' => 'Vote removed successfully',
                'votes_count' => $question->votes()->sum('type'),
                'user_vote' => null
            ]);
        }

        // POST request - add or change vote
        $request->validate([
            'type' => 'required|in:upvote,downvote'
        ]);

        if ($request->type === 'upvote') {
            $question->upvote($userId);
        } else {
            $question->downvote($userId);
        }

        $question->refresh();

        $votesCount = $question->votes()->sum('type');
        $userVote = $question->userVote($userId);

        return response()->json([
            'success' => true,
            'message' => 'Vote recorded successfully',
            'votes_count' => $votesCount,
            'user_vote' => $userVote
        ]);
    }

    public function voteAnswer(Request $request, Answer $answer)
    {
        $userId = auth()->id();

        // If it's a DELETE request or has 'remove' parameter
        if ($request->isMethod('delete') || $request->input('remove')) {
            $vote = $answer->votes()->where('user_id', $userId)->first();
            if ($vote) {
                $vote->delete();
            }

            $answer->refresh();

            return response()->json([
                'success' => true,
                'message' => 'Vote removed successfully',
                'votes_count' => $answer->votes()->sum('type'),
                'user_vote' => null
            ]);
        }

        // POST request - add or change vote
        $request->validate([
            'type' => 'required|in:upvote,downvote'
        ]);

        if ($request->type === 'upvote') {
            $answer->upvote($userId);
        } else {
            $answer->downvote($userId);
        }

        $answer->refresh();

        $votesCount = $answer->votes()->sum('type');
        $userVote = $answer->userVote($userId);

        return response()->json([
            'success' => true,
            'message' => 'Vote recorded successfully',
            'votes_count' => $votesCount,
            'user_vote' => $userVote
        ]);
    }
}
