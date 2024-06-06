<?php

namespace App\Http\Resources;

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
        // return parent::toArray($request);
        return [
            'id' => $this->whenNotNull($this->id),
            'content' => $this->content,
            'active' => $this->active,
            'post_id' => $this->post_id,
            'user_id' => $this->user_id,
            'user' => new AuthorResource($this->user),
            'parent_comment_id' => $this->parent_comment_id,
            'sub_comments' => CommentResource::collection($this->whenLoaded('subComments')),
            'created_at' => $this->created_at->format('Y-m-d h:i:s a'),
            'updated_at' => $this->updated_at->format('Y-m-d h:i:s a'),
        ];
    }
}
