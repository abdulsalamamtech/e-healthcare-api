<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
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
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => Str::slug($this->slug),
            'content' => $this->content,
            'views' => $this->views,
            'published_at' => $this->published_at,
            'status' => $this->status,
            'author' => new AuthorResource($this->createdBy),
            'image' => new ImageResource($this->image),
            'comments' => CommentResource::collection($this->comments),
            'updated_at' => $this->updated_at->format('Y-m-d h:i:s a'),
            'created_at' => $this->created_at->format('Y-m-d h:i:s a'),
        ];
    }
}
