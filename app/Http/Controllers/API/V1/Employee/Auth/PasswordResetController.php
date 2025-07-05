<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\V1\Employee\Auth;

use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\API\V1\Employee\Auth\PasswordResetConfirmationRequest;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Throwable;

final class PasswordResetController extends APiBaseController
{
    /**
     * @throws Throwable
     */
    public function __invoke(PasswordResetConfirmationRequest $request)
    {
        DB::beginTransaction();
        try {
            $credentials = [
                'email' => $request->validated('payload.employee.email'),
                'password' => $request->validated('payload.employee.password'),
                'password_confirmation' => $request->validated('payload.employee.password_confirmation'),
                'token' => $request->validated('payload.employee.token'),
            ];
            $status = Password::reset($credentials, function (User $user, string $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->setRememberToken(Str::random(60));

                $user->save();
                event(new PasswordReset($user));
            });

            if ($status === Password::PASSWORD_RESET) {
                DB::commit();
                return $this->sendResponse([], 'Password reset successfully.');
            }
            DB::rollBack();

            $errorMessage = match ($status) {
                Password::INVALID_TOKEN => 'The password reset token is invalid or has expired.',
                Password::INVALID_USER => 'We could not find a user with this email address.',
                Password::RESET_THROTTLED => 'Too many attempts. Please try again later.',
                default => 'Password reset failed. Please try again.',
            };

            return $this->sendError('Failed to reset password.', [
                'error' => $errorMessage,
                'status_code' => $status,
            ], 422);
        }catch (Throwable $throwable){
            DB::rollBack();
            $errorMessage = [
                'error' => 'Something went wrong!',
                'exception' => $throwable->getMessage(),
            ];
            return $this->sendError('Failed to update new password.',$errorMessage,500);
        }
    }
}
