<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/* [CONTROLLERS] */
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HangoutController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group(['middleware' => ['json.response']], function () {
    /* [ USER ] */
    Route::post('register', [PassportAuthController::class, 'register']);
    Route::post('login', [PassportAuthController::class, 'login'])->name('login');
    Route::post('google/sign-in', [PassportAuthController::class, 'googleSignIn']);
    /* [ EMAIL VERIFY ] */
    Route::get('email/verify/{id}/{hash}', [PassportAuthController::class, 'verifyEmail'])->name('verification.verify');
    Route::get('email/resend/{id}', [PassportAuthController::class, 'resendEmail'])->name('verification.send');
    /* [ PASSWORD RESET ] */
    Route::post('forgot-password', [PassportAuthController::class, 'forgotPassword'])->name('password.email');
    Route::get('reset-password/{token}', function ($token) {
        return Redirect::to('http://localhost:3000/reset-password/' . $token);
    })->name('password.reset');
    Route::post('reset-password', [PassportAuthController::class, 'resetPassword'])->name('password.update');
    /* [ REQUEST EVENT FROM OPEN AGENDA API ] */
    Route::post('events', [HangoutController::class, 'requestEvents'])->name('openAgenda');
});
/* [ PROTECTED ROUTES ] */
Route::middleware('auth:api')->group(function () {
    /* [ USER ] */
    Route::get('logout', [PassportAuthController::class, 'logout'])->name('logout');
    Route::get('users/me', [UserController::class, 'showCurrent']);
    Route::get('user/{id}/hangouts', [UserController::class, 'showHangouts']);
    Route::resource('users', UserController::class);
    /* [ HANGOUT ] */
    Route::resource('hangouts', HangoutController::class);
    Route::get('hangouts/{id}/join', [HangoutController::class, 'join']);
    Route::get('hangouts/{hangout_id}/invite/{user_id}', [HangoutController::class, 'invite']);
    Route::get('hangouts/{id}/leave', [HangoutController::class, 'leave']);
    Route::get('hangouts/{id}/users', [HangoutController::class, 'showUsers']);
});
