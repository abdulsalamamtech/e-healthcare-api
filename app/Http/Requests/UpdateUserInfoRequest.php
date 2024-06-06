<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserInfoRequest extends FormRequest
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
            'user_id' => ['nullable', 'numeric', 'min:1'],
            'image_id' => ['nullable', 'numeric', 'min:1'],
            'first_name' => ['nullable', 'string', 'min:2', 'max:20'],
            'last_name' => ['nullable', 'string', 'min:2', 'max:20'],
            'phone_number' => ['nullable', 'string', 'min:10', 'max:14'],
            'address' => ['nullable', 'string', 'min:1', 'max:200'],
            'lga' => ['nullable', 'string', 'min:3', 'max:20'],
            'state' => ['nullable', 'string', 'min:3', 'max:20'],
            'country' => ['nullable', 'string', 'min:3', 'max:20'],
            'active' => ['nullable', 'string|boolean'],
        ];
    }
}
