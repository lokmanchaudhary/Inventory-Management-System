<?php

namespace App\Http\Requests\API\V1\Employee\Auth;

use Illuminate\Foundation\Http\FormRequest;

class PasswordResetConfirmationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'payload.employee.email' => ['required','email','max:255'],
            'payload.employee.token' => ['required','string','max:255'],
            'payload.employee.password' => ['required','string','same:payload.employee.password_confirmation','min:8','max:16'],
            'payload.employee.password_confirmation' => ['required','string','same:payload.employee.password','min:8','max:16'],
        ];
    }

    public function messages(): array
    {
        return [
            'payload.employee.email.required' => 'Please enter your email address!',
            'payload.employee.email.email' => 'Please enter a valid email address!',
            'payload.employee.email.max' => 'This email address is too long!',

            'payload.employee.token.required' => 'Reset token is missing!',
            'payload.employee.token.string' => 'The token must be a valid string!',
            'payload.employee.token.max' => 'The token value is too long!',

            'payload.employee.password.required' => 'Please enter your new password!',
            'payload.employee.password.string' => 'Password must be in text format!',
            'payload.employee.password.same' => 'Password and confirmation do not match!',
            'payload.employee.password.min' => 'Password must be at least 8 characters!',
            'payload.employee.password.max' => 'Password must not exceed 16 characters!',

            'payload.employee.password_confirmation.required' => 'Please confirm your new password!',
            'payload.employee.password_confirmation.string' => 'Confirmation must be in text format!',
            'payload.employee.password_confirmation.same' => 'Password confirmation does not match the password!',
            'payload.employee.password_confirmation.min' => 'Confirmation password must be at least 8 characters!',
            'payload.employee.password_confirmation.max' => 'Confirmation password must not exceed 16 characters!',
        ];
    }
}
