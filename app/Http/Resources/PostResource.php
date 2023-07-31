<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'body' => $this->body,
            'slug' => $this->slug,
            'image' => $this->image,
            'created_at' => $this->created_at->format('M d, Y'),
            'user' => $this->whenLoaded('user', UserResource::make($this->user)),
            'comments' => $this->whenLoaded('comments', CommentResource::collection($this->comments), null)
        ];
    }
}
