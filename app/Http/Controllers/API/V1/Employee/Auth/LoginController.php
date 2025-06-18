<?php
declare(strict_types=1);

namespace App\Http\Controllers\API\V1\Employee\Auth;

use App\Http\Controllers\ApiBaseController;
use App\Http\Requests\API\V1\Employee\Auth\LoginAttemptRequest;
use Illuminate\Support\Facades\Auth;

final class LoginController extends ApiBaseController
{
    public function __invoke(LoginAttemptRequest $request)
    {
        $employee = Auth::guard('employee')->attempt([
            'email' => $request->validated("payload.employee.email"),
            'password' => $request->validated("payload.employee.password")
        ]);

        if(!$employee)
        {
            $errorMessages = [
                'email' => 'Wrong credentials. Please check your email',
                'password' => 'Wrong credentials. Please check your password'
            ];
            return $this->sendError('Unauthorized',$errorMessages,403);
        }

        $loginToken = Auth::guard('employee')->user()->createToken('api login token')->plainTextToken;
        return $this->sendResponse(['token' => $loginToken],'Login Attempt Success.',200);
    }
}
