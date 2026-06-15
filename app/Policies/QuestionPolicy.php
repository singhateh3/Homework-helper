<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Question;

class QuestionPolicy
{
    /**
     * Determine if the user can update the question.
     */
    public function update(User $user, Question $question): bool
    {
        // Only the owner can update their question
        return $user->id === $question->user_id;
    }

    /**
     * Determine if the user can delete the question.
     */
    public function delete(User $user, Question $question): bool
    {
        // Only the owner can delete their question
        return $user->id === $question->user_id;
    }

    /**
     * Determine if the user can view the question.
     */
    public function view(User $user, Question $question): bool
    {
        // Everyone can view questions
        return true;
    }
}
