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
            'slug' => $this->slug,
            'title' => $this->title,
            'content' => $this->content,
            'user' => $this->user->name ?? null,
            'images' => $this->getMedia('images')->map(fn($media) => $media->getFullUrl()),
            'comments' => CommentResource::collection(
                $this->comments()->whereNull('parent_id')->with(['user', 'replies.user'])->get()
            ),
            'created_at' => $this->created_at,
        ];
    }
}
