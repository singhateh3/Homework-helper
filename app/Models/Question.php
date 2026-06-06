<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    // Add the votes relationship
    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }

    // Helper method to get user's vote
    public function userVote($userId = null)
    {
        $userId = $userId ?? auth()->id();

        if (!$userId) return null;

        $vote = $this->votes()->where('user_id', $userId)->first();

        return $vote ? $vote->type : null;
    }

    // Helper method to upvote// In both Question.php and Answer.php

public function upvote($userId = null)
{
    $userId = $userId ?? auth()->id();

    if (!$userId) return false;

    $existingVote = $this->votes()->where('user_id', $userId)->first();

    if ($existingVote) {
        if ($existingVote->type === 1) {
            // Already upvoted - remove the vote (toggle off)
            $existingVote->delete();
            return 'removed';
        } else {
            // Was downvoted - change to upvote
            $existingVote->update(['type' => 1]);
            return 'changed_from_downvote';
        }
    } else {
        // No existing vote - create upvote
        $this->votes()->create([
            'user_id' => $userId,
            'type' => 1
        ]);
        return 'created';
    }
}

public function downvote($userId = null)
{
    $userId = $userId ?? auth()->id();

    if (!$userId) return false;

    $existingVote = $this->votes()->where('user_id', $userId)->first();

    if ($existingVote) {
        if ($existingVote->type === -1) {
            // Already downvoted - remove the vote (toggle off)
            $existingVote->delete();
            return 'removed';
        } else {
            // Was upvoted - change to downvote
            $existingVote->update(['type' => -1]);
            return 'changed_from_upvote';
        }
    } else {
        // No existing vote - create downvote
        $this->votes()->create([
            'user_id' => $userId,
            'type' => -1
        ]);
        return 'created';
    }
}

public function removeVote($userId = null)
{
    $userId = $userId ?? auth()->id();

    if (!$userId) return false;

    $vote = $this->votes()->where('user_id', $userId)->first();

    if ($vote) {
        $vote->delete();
        return 'removed';
    }

    return 'not_found';
}
}
