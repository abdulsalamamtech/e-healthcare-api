<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
           'tracking_no' => ['nullable','string'],
           'transaction_id' => ['nullable','string'],
           'session_id' => ['nullable','string'],
           'total_price' => ['required', 'string'],
           'payment_method' => ['nullable', 'string'],
           'status' => ['nullable', 'string'],
        ];
    }
}
