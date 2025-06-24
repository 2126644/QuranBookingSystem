<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Mail;
use App\Mail\TwoFactorCodeMail;
use Illuminate\Validation\Rules\Password;


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
            'password' => ['required', 'string', Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                'confirmed'],
            'gender' => ['required', 'string'],
            'age' => ['required','integer', 'min:1', 'max:100'],
        ]);

        $salt = Str::random(16); 

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'salt' => $salt,
            'password' => Hash::make($request->password . $salt),   //append the salt to the password before hashing in registration
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

    // Check if user is locked out
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

    $user = User::where('email', $request->email)->first();

    // Validate user existence and password
    if (!$user || !Hash::check($request->password . $user->salt, $user->password)) { //appending the stored salt before checking
        // Failed login attempt
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

    // Passed password check: reset attempts
    cache()->forget($attemptKey);
    cache()->forget($lockoutKey);

    Auth::login($user);

    // Generate 2FA code and expiry
    $user->two_factor_code = rand(100000, 999999);
    $user->two_factor_expires_at = now()->addMinutes(10);
    $user->save();

    // Send 2FA code email
    Mail::to($user->email)->send(new TwoFactorCodeMail($user));

    // Store user ID in session for 2FA
    $request->session()->put('login.id', $user->user_id);

    // Redirect to 2FA challenge page
    return redirect()->route('two-factor.login');
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); // Prevent CSRF reuse
        return redirect()->route('student.login');
    }
}

