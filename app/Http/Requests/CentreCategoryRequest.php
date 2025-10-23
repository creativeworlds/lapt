<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CentreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|unique:centre_categories,name',
            'sort_order' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'This field is required.',
            '*.unique' => 'This category already exists.',
            '*.integer'=> 'Please enter numeric value.',
        ];
    }
}