<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'user_id' => $this->user_id, // ADD THIS LINE - Critical for ownership check
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => new UserResource($this->whenLoaded('user')),
            'votes_count' => $this->votes_count ?? $this->votes()->sum('type'),
            'user_vote' => $this->when(auth()->check(), function() {
                return $this->userVote();
            }),
            'answers_count' => $this->answers()->count(),
        ];
    }
}
