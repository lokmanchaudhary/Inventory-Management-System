<?php
//Protected Routes
Route::prefix('employee')->group(function () {
    //Authentication Routes
    require __DIR__ . '/Auth/auth.php';

    //Authorized Routes

    Route::middleware(['auth:sanctum'])->group(function () {

        //Product Management

        //Sales Management


    });
});
