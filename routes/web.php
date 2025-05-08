<?php

declare(strict_types = 1);

use App\Http\Controllers\Auth\MagicLinkController;
use App\Livewire\Pages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ------------------------------------------------
// Auth Routes
// ------------------------------------------------
Route::get('/login', Pages\Login::class)->name('login');
Route::get('/password-request', fn (): string => 'password-request')->name('password.request');
Route::get('/register', fn (): string => 'register')->name('register');
Route::get('/2fa/magic-link/{token}', MagicLinkController::class)->name('2fa.magic-link');
Route::match(['get', 'post'], '/logout', function () {
    session()->invalidate();
    session()->flush();

    Auth::logout();

    return redirect()->route('login');
})->name('logout');

// ------------------------------------------------
// Authenticated Routes
// ------------------------------------------------
Route::middleware(['auth'])->group(function (): void {
    Route::get('/', Pages\Dashboard::class)->name('dashboard');
    Route::get('/users', Pages\Users::class)->name('users');
});
