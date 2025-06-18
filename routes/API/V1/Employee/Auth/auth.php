<?php

use App\Http\Controllers\API\V1\Employee\Auth\LoginController;

Route::prefix('auth')->group(function () {

    Route::post('login', LoginController::class);
});
