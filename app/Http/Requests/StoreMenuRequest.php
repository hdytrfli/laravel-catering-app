<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:1000'],
            'calories' => ['required', 'integer', 'min:0'],
            'carbs' => ['required', 'integer', 'min:0'],
            'protein' => ['required', 'integer', 'min:0'],
            'fat' => ['required', 'integer', 'min:0'],
            'price' => ['required', 'integer', 'min:0']
        ];
    }
}
