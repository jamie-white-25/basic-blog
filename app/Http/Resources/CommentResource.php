<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'body' => $this->body,
            'created_at' => $this->created_at->format('M d, Y'),
            'user' => $this->whenLoaded('user', UserResource::make($this->user)),
            'canDelete' =>  $request->user()?->can('delete', Comment::find($this->id))
        ];
    }
}
