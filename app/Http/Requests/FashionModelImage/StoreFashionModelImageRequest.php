<?php

namespace App\Http\Requests\FashionModelImage;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;

class StoreFashionModelImageRequest extends FormRequest
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
            'altText' => ['nullable', 'string', 'max:255'],
            'images' => ['required', 'array'],
            'images.*' => [
                'file',
                'mimes:jpeg,png,jpg',
                'max:' . Config::get('entity_configurations.fashion_models.max_size'),
            ],
        ];
    }
}
