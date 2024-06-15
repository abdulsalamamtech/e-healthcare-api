<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
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
            'created_by' => ['nullable', 'integer', 'min:1'],
            'name' => ['required', 'string', 'min:50'],
            'slug' => ['nullable', 'string', 'min:50'],
            'active' => ['nullable', 'integer'],
        ];
    }
}
