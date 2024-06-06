<?php

namespace App\Http\Resources;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TagResource extends JsonResource
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
            'name' => $this->name,
           'slug' => Str::slug($this->slug),
            'active' => $this->active,
            'author' => new AuthorResource($this->createdBy),
            'updated_at' => $this->updated_at->format('Y-m-d h:i:s a'),
            'created_at' => $this->created_at->format('Y-m-d h:i:s a'),
        ];
    }
}
