<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\TwoFactorController;

// Set the default route to redirect to frontend.home
Route::get('/', function () {
    return redirect()->route('frontend.home');
});

// web.php
Route::get('/', function () {
    return view('frontend.home');
})->name('home');

// Home route, accessible after login
Route::get('/home', function () {
    return view('frontend.home');
})->name('frontend.home');

Route::get('/booking', function () {
    return view('frontend.bview');
})->name('frontend.bview');

// Two-Factor Routes
//Show 2FA challenge page
Route::get('/two-factor-challenge', [TwoFactorController::class, 'index'])->name('two-factor.login');
//Handle submitted code
Route::post('/two-factor-challenge', [TwoFactorController::class, 'store'])->name('two-factor.store');

// Custom student authentication routes
Route::get('student/register', [StudentAuthController::class, 'showRegistrationForm'])->name('student.register');
Route::post('student/register', [StudentAuthController::class, 'register']);
Route::get('student/login', [StudentAuthController::class, 'showLoginForm'])->name('student.login');
Route::post('student/login', [StudentAuthController::class, 'login']);
Route::post('student/logout', [StudentAuthController::class, 'logout'])->name('student.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [BookingController::class, 'index'])->name('student.dashboard');
    Route::get('/bookings/create', [BookingController::class, 'create'])->name('booking.add');
    Route::post('/bookings', [BookingController::class, 'store'])->name('booking.store');
    Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('booking.destroy');
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::patch('users/{user}/toggle', [AdminController::class, 'toggleUser'])->name('users.toggle');
    Route::get('users/{user}/bookings', [AdminController::class, 'userBookings'])->name('bookings');
    Route::delete('users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
});
