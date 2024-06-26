<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:1'],
            'slug' => ['nullable', 'string', 'min:1'],
            'active' => ['nullable', 'integer'],
        ];
    }
}
