<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriberResource extends JsonResource
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
            'email' => $this->email,
            'active' => $this->active,
            'updated_at' => $this->updated_at->format('Y-m-d h:i:s a'),
            'created_at' => $this->created_at->format('Y-m-d h:i:s a'),
        ];
    }
}
