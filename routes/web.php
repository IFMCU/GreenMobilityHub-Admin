<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\dashboard\Maps;
use App\Http\Controllers\dashboard\Merchants;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\dashboard\About;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\dashboard\CarbonCalculator;
use App\Http\Controllers\dashboard\Offer;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\FormController;

//
Route::get('/', function () {
    return redirect()->route('login');
});

Route::post('/set-session', [SessionController::class, 'setLogin'])->name('session.login');
Route::post('/register-session', [SessionController::class, 'setRegister'])->name('session.register');
Route::get('/clear-session', [App\Http\Controllers\SessionController::class, 'clearSession'])->name('session.clear');

Route::group([
    'middleware' => 'auth.guest',
], function ($router) {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::get('/login-password', [AuthController::class, 'indexPassword'])->name('login.password');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::get('/verify', [AuthController::class, 'verifyEmail'])->name('verify');
    Route::get('password/reset/email', [App\Http\Controllers\PasswordController::class, 'emailOTP'])->name('password.request');
    Route::get('password/reset/password', [App\Http\Controllers\PasswordController::class, 'inputReset'])->name('password.update');
});


Route::group([
    'middleware' => 'auth.token',
], function ($router) {
    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route::get('/maps', [DashboardController::class, 'maps'])->name('dashboard-maps');
    Route::get('/carbon-calculator', [CarbonCalculator::class, 'index'])->name('dashboard-carbon-calculator');

    Route::get('/user/profile', [ProfileController::class, 'index'])->name('user-profile');

    Route::get('auth/google/sync', [GoogleController::class, 'syncToGoogle'])->name('google-sync');
    Route::get('auth/google/call-back/sync', [GoogleController::class, 'handleCallbackSync']);

    Route::get('/form', [FormController::class, 'index'])->name('form');
    Route::get('/result', [FormController::class, 'result'])->name('result');
    Route::get('/about', [DashboardController::class, 'about'])->name('about');

    // Main Page Route
    // Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard-analytics');
    // Route::get('/maps', [Maps::class, 'index'])->name('dashboard-maps');
    Route::get('/about-us', [About::class, 'index'])->name('about-us');

    // admin section
    Route::get('/merchants', [Merchants::class, 'merchants'])->name('merchants');
    Route::get('/merchants/edit/{guid}', [Merchants::class, 'merchantsEdit'])->name('merchants');
    Route::get('/merchants/add', [Merchants::class, 'merchantsAdd'])->name('merchants');
    Route::get('/merchants/delete/{guid}', [Merchants::class, 'merchantsDelete'])->name('merchants');
    
    Route::get('/merchants_locations', [Merchants::class, 'merchantsLocations'])->name('merchants_locations');
    Route::get('/merchants_locations/edit/{guid}', [Merchants::class, 'merchantsLocationsEdit'])->name('merchants_locations');
    Route::get('/merchants_locations/add', [Merchants::class, 'merchantsLocationsAdd'])->name('merchants_locations');
    Route::get('/merchants_locations/delete/{guid}', [Merchants::class, 'merchantsLocationsDelete'])->name('merchants_locations');
    
    Route::get('/parking_lots', [Merchants::class, 'parkingLots'])->name('parking_lots');
    Route::get('/parking_lots/edit/{guid}', [Merchants::class, 'parkingLotsEdit'])->name('parking_lots');
    Route::get('/parking_lots/add', [Merchants::class, 'parkingLotsAdd'])->name('parking_lots');
    Route::get('/parking_lots/delete/{guid}', [Merchants::class, 'parkingLotsDelete'])->name('parking_lots');

    Route::get('/offer', [Offer::class, 'offer'])->name('offer');
    Route::get('/offer/edit/{guid}', [Offer::class, 'offerEdit'])->name('offer');
    Route::get('/offer/add', [Offer::class, 'offerAdd'])->name('offer');
    Route::get('/offer/delete/{guid}', [Offer::class, 'offerDelete'])->name('offer');
    
    Route::get('/users', [Merchants::class, 'users'])->name('users');
    Route::get('/users/edit/{guid}', [Merchants::class, 'usersEdit'])->name('usersE');
    Route::get('/users/add', [Merchants::class, 'usersAdd'])->name('usersA');
    Route::get('/users/delete/{guid}', [Merchants::class, 'usersDelete'])->name('usersD');
    
    Route::get('/maps', [DashboardController::class, 'maps'])->name('dashboard-maps');
    // Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard-analytics');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard-analytics');


    // pages
    Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
    Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
    Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('pages-misc-under-maintenance');

    // authentication
    Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
    Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
    Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-reset-password-basic');
});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleController::class, 'handleCallback']);

Route::get('auth/google/verify', [GoogleController::class, 'verifyToGoogle'])->name('google-verify');
Route::get('auth/google/call-back/verify', [GoogleController::class, 'handleCallbackVerify']);
Route::get('auth/otp/verify', [AuthController::class, 'verify'])->name('otp-verification');
Route::get('auth/otp/resend', [AuthController::class, 'resendOtp'])->name('otp-resend');
Route::get('verify/{guid}/{otp}', [AuthController::class, 'checkOtp'])->name('check-otp');
//