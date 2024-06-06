<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'created_by' => ['nullable', 'numeric', 'min:1'],
            'image_id' => ['required', 'numeric', 'min:1'],
            'title' => ['required', 'string', 'min:1'],
            'slug' => ['nullable', 'string', 'min:1', 'unique:posts'],
            'content' => ['required', 'string', 'min:1'],
            'published_at' => ['nullable', 'DateTime'],
            'status' => ['nullable', 'string', 'min:1'],
            'active' => ['nullable', 'numeric'],
        ];
    }
}
