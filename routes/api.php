<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




// Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::POST('/loginOnboardingDashboard', [App\Http\Controllers\LoginController::class, 'loginOnboardingDashboard'])->name('loginOnboardingDashboard');
Route::POST('/editEmployeeProfile', [App\Http\Controllers\EmployeeDataEditController::class, 'editEmployeeProfile'])->name('editEmployeeProfile');

Route::middleware(['auth:api'])->group(function(){
    Route::get("/test-me", function () {
        return 'Hello from Laravel!';
    });
    Route::post('logout', [App\Http\Controllers\LoginController::class,'logout']);
    Route::post('refresh', [App\Http\Controllers\LoginController::class,'refresh']);
    Route::post('me', [App\Http\Controllers\LoginController::class,'me']);
    Route::post('getEmployeeData',[App\Http\Controllers\EmployeeDataController::class,'getEmployeeData']);
});
