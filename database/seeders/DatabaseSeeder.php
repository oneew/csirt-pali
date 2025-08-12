<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SecureContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'min:2',
                'max:255',
                'regex:/^[\p{L}\s\-\.\']+$/u', // Unicode letters, spaces, hyphens, dots, apostrophes
            ],
            'email' => [
                'required',
                'email:rfc,dns',
                'max:255',
                'not_regex:/[<>"\'\(\)\[\]\{\}\\\\/]/', // Prevent script injection
            ],
            'organization' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[\p{L}\p{N}\s\-\.\_\&]+$/u',
            ],
            'subject' => [
                'required',
                'string',
                'min:5',
                'max:255',
                'not_regex:/[<>"\'\(\)\[\]\{\}\\\\\/]/',
            ],
            'message' => [
                'required',
                'string',
                'min:10',
                'max:5000',
                'not_regex:/<script|<iframe|javascript:|on/i', // Prevent script injection
            ],
        ];
    }
}