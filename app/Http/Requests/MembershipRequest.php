<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MembershipRequest extends FormRequest
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
            'starting_date' => ['required', 'date'],
            'completion_date' => ['required', 'date', 'after_or_equal:starting_date'],
        ];
    }

    public function messages()
    {
        return [
            '*.required' => 'This field is required.',
            'completion_date.after_or_equal' => 'Starting Date cannot be greater than completion date',
        ];
    }
}