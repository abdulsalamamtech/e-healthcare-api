<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrescriptionRequest extends FormRequest
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
            'patient_id' => ['nullable', 'integer'],
            'medical_officer_id' => ['nullable', 'integer'],
            'doctor_id' => ['nullable', 'integer'],
            'hospital_id' => ['nullable', 'integer'],
            'emergency_id' => ['nullable', 'integer'],
            'title' => ['required', 'integer'],
            'description' => ['required', 'integer'],
        ];
    }
}
