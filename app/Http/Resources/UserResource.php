<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id' => (string) $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'updated_at' => $this->updated_at->format('Y-m-d h:i:s a'),
            'created_at' => $this->created_at->format('Y-m-d h:i:s a'),
            // Load user roles if available
            'roles' => $this->whenLoaded('roles')
        ];
    }
}
