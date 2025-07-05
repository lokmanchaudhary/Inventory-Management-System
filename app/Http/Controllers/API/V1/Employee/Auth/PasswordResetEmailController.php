<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\Employee\Auth;

use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\PasswordResetRequest;
use App\Models\User;
use Illuminate\Support\Facades\Password;

final class PasswordResetEmailController extends ApiBaseController
{
    public function __invoke(PasswordResetRequest $request)
    {
        $user = User::where('email', $request->validated('payload.employee.email'))->first();
        if ($user)
        {
            // create token only if there is a user found.
            $token = Password::getRepository()->create($user);
            $user->sendPasswordResetNotification($token);
        }
        return $this->sendResponse([],"Your password reset link has been sent to your email.", 200);
    }
}
