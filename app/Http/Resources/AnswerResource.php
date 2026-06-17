<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

           'id' => $this->id,
            'question_id' => $this->question_id,
            'user_id' => $this->user_id,
            'body' => $this->body,
            'is_accepted' => (bool) $this->is_accepted,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => new UserResource($this->whenLoaded('user')),
            'votes_count' => $this->votes_count ?? 0,
            'user_vote' => $this->when(auth()->check(), $this->userVote()),
        ];
    }
}
