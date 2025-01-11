<?php

namespace App\Http\Requests\Booking;

use App\Rules\Customer\ValidCustomerNameRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'customerName' => ['required', 'string', 'max:255', new ValidCustomerNameRule],
            'modelId' => ['required', 'integer', 'exists:fashion_models,id'],
            'bookingDate' => ['required', 'date']
        ];
    }
}
