<?php

declare(strict_types=1);

namespace App\Http\Requests\API\V1\Employee\Auth;

use Illuminate\Foundation\Http\FormRequest;

final class LoginAttemptRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'payload.employee.email' => ['required', 'email', 'max:50'],
            'payload.employee.password' => ['required','string','max:50'],
        ];
    }

    public function messages(): array
    {
        return [
            'payload.employee.email.required' => 'Please enter your email address!',
            'payload.employee.password.required' => 'Please enter your password!',
            'payload.employee.email.email' => 'Please enter a valid email address!',
            'payload.employee.password.string' => 'Kindly, enter your password as text format!',
            'payload.employee.email.max' => 'This email address is too long!',
            'payload.employee.password.max' => 'This password is too long!',
        ];
    }
}
