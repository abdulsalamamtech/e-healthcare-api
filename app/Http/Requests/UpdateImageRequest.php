<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImageRequest extends FormRequest
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
            'image' => ['required', 'image', 'mimes:png,jpg,jpeg','max:50000'],
            'file_id' => ['nullable', 'string', 'max:20'],
            'url' => ['nullable', 'string', 'max:20'],
            'size' => ['nullable', 'numeric', 'max:20'],
            'hosted_at' => ['nullable', 'string', 'max:20'],
            'active' => ['nullable', 'string|boolean'],
        ];
    }
}
