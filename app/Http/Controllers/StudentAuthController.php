<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;

class StudentAuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('student.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'gender' => ['required', 'string'],
            'age' => ['required','integer', 'min:1', 'max:100'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'age' => $request->age,
        ]);

        if ($user) {
            return redirect()->route('student.login')->with('success', 'Registration successful. Please login.');
        } else {
            return back()->with('error', 'Registration failed. Please try again.');
        }
    }

    public function showLoginForm()
    {
        return view('student.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255', 'regex:/^[^@\s]+@[^@\s]+\.[^@\s]+$/'],
            'password' => ['required', 'string', 'min:8'],
        ]);

    $key = Str::lower('login:' . $request->email);
    $attemptKey = $key . ':attempts';
    $lockoutKey = $key . ':lockout';
    $maxAttempts = 3;
    $lockoutSeconds = 60;

    // If locked out
    if (cache()->has($lockoutKey)) {
        $remaining = cache()->get($lockoutKey) - time();
        if ($remaining > 0) {
            return back()->withErrors([
                'email' => "Too many login attempts. Please try again in {$remaining} seconds.",
            ]);
        } else {
            cache()->forget($lockoutKey);
            cache()->forget($attemptKey);
        }
    }

    // Login success
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        cache()->forget($attemptKey);
        cache()->forget($lockoutKey);
        return redirect()->intended('dashboard');
    }

    // Failed login
    $attempts = cache()->get($attemptKey, 0) + 1;
    cache()->put($attemptKey, $attempts, $lockoutSeconds);

    if ($attempts >= $maxAttempts) {
        $lockUntil = time() + $lockoutSeconds;
        cache()->put($lockoutKey, $lockUntil, $lockoutSeconds);
        return back()->withErrors([
            'email' => "Too many login attempts. Please try again in {$lockoutSeconds} seconds.",
        ]);
    }

    return back()->withErrors([
        'email' => "Invalid credentials. You have " . ($maxAttempts - $attempts) . " attempt(s) left.",
    ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); // Prevent CSRF reuse
        return redirect()->route('student.login');
    }
}

