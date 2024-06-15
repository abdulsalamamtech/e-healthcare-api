<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
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
            'user_id' => ['nullable', 'integer'],
            'emergency_id' => ['nullable', 'integer'],
            'name' => ['required', 'string'],
            'allergies' => ['nullable', 'string'],
            'phone_number' => ['nullable', 'integer', 'min:11', 'max:14'],
            'nin' => ['nullable', 'integer', 'min:11', 'max:11'],
            'guidance_nin' => ['nullable', 'integer', 'min:11', 'max:11'],
            'guidance_phone_number' => ['nullable', 'integer', 'min:11', 'max:14'],
        ];
    }
}
