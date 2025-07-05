<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'payload.employee.email' => ['required','string','email','max:50']
        ];
    }

    public function messages(): array
    {
        return [
            'payload.employee.email.required' => 'Please enter your email address!',
            'payload.employee.email.string' => 'Email must be in text format!',
            'payload.employee.email.email' => 'Please enter a valid email address!',
            'payload.employee.email.max' => 'This email address is too long!',
        ];
    }
}
