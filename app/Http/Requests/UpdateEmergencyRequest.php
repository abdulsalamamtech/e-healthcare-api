<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmergencyRequest extends FormRequest
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
            'patient_id' => ['nullable', 'integer'],
            'medical_officer_id' => ['nullable', 'integer'],
            'doctor_id' => ['nullable', 'integer'],
            'guidance_user_id' => ['nullable', 'integer'],
            'hospital_id' => ['nullable', 'integer'],
            'name' => ['nullable', 'string'],
            'sex' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'age' => ['nullable', 'string'],
            'allergies' => ['nullable', 'string'],
            'phone_number' => ['nullable', 'string'],
            'guidance_nin' => ['nullable', 'string'],
            'guidance_phone_number' => ['nullable', 'string'],
            'details' => ['nullable', 'string'],
        ];
    }
}
