<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // $user = request()->user();
        // $user->roleHas('editor') || $post->user_id == $user->id;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'created_by' => ['nullable', 'integer', 'min:1'],
            'image_id' => ['nullable', 'integer', 'min:1'],
            'title' => ['nullable', 'string', 'min:1'],
            'slug' => ['nullable', 'string', 'min:1'],
            'content' => ['nullable', 'string', 'min:1'],
            'views' => ['nullable', 'string', 'min:0'],
            'published_at' => ['nullable', 'datetime'],
            'status' => ['nullable', 'string', 'min:1'],
            'active' => ['nullable', 'string|boolean'],
        ];
    }
}
