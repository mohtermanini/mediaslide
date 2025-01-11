<?php

namespace App\Http\Requests\FashionModel;

use App\Rules\FashionModel\ValidFashionModelName;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Config;

class StoreFashionModelRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:fashion_models,name', new ValidFashionModelName],
            'description' => ['nullable', 'string', 'max:500'],
            'dateOfBirth' => ['required', 'date', 'before:today'],
            'height' => ['required', 'numeric', 'min:50', 'max:300'],
            'shoeSize' => ['required', 'numeric', 'min:1', 'max:50'],
            'gender' => ['required', 'integer', 'in:0,1'],
            'categoryId' => ['nullable', 'integer', 'exists:categories,id']
        ];
    }
}
