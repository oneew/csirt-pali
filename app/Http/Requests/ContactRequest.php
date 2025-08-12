<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:2|max:255|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email:dns|max:255',
            'organization' => 'nullable|string|max:255',
            'subject' => 'required|string|min:5|max:255',
            'message' => 'required|string|min:10|max:5000',
            'g-recaptcha-response' => 'required|recaptcha', // If using reCAPTCHA
        ];
    }

    public function messages(): array
    {
        return [
            'name.regex' => 'Name may only contain letters and spaces.',
            'email.email' => 'Please provide a valid email address.',
            'subject.min' => 'Subject must be at least 5 characters.',
            'message.min' => 'Message must be at least 10 characters.',
            'g-recaptcha-response.required' => 'Please complete the reCAPTCHA.',
        ];
    }
}