<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            'path' => $this->path,
            'file_id' => $this->file_id,
            'url' => $this->url,
            'size' => $this->size,
            'hosted_at' => $this->hosted_at,
            'updated_at' => $this->updated_at->format('Y-m-d h:i:s a'),
            'created_at' => $this->created_at->format('Y-m-d h:i:s a'),
        ];
    }
}
