<?php

namespace App\Traits;

use App\Models\Vote;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasVotes
{
    public function votes(): MorphMany
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    public function upvotes()
    {
        return $this->votes()->where('type', 1);
    }

    public function downvotes()
    {
        return $this->votes()->where('type', -1);
    }

    public function getVotesCountAttribute()
    {
        return $this->votes()->sum('type');
    }

    public function userVote($userId = null)
    {
        $userId = $userId ?? auth()->id();

        if (!$userId) return null;

        $vote = $this->votes()->where('user_id', $userId)->first();

        return $vote ? $vote->type : null;
    }

    public function hasUserUpvoted($userId = null)
    {
        return $this->userVote($userId) === 1;
    }

    public function hasUserDownvoted($userId = null)
    {
        return $this->userVote($userId) === -1;
    }

    public function vote($type, $userId = null)
    {
        $userId = $userId ?? auth()->id();

        if (!$userId) return false;

        $existingVote = $this->votes()->where('user_id', $userId)->first();

        if ($existingVote) {
            if ($existingVote->type === $type) {
                // Remove vote if same type (toggle off)
                $existingVote->delete();
            } else {
                // Update vote type
                $existingVote->update(['type' => $type]);
            }
        } else {
            // Create new vote
            $this->votes()->create([
                'user_id' => $userId,
                'type' => $type
            ]);
        }

        return true;
    }

    public function upvote($userId = null)
    {
        return $this->vote(1, $userId);
    }

    public function downvote($userId = null)
    {
        return $this->vote(-1, $userId);
    }

    public function removeVote($userId = null)
    {
        $userId = $userId ?? auth()->id();

        if (!$userId) return false;

        return $this->votes()->where('user_id', $userId)->delete();
    }
}
