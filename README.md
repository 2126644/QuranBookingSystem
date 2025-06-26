# Quran Booking System (Group: The Jannah Seekers)

## Name and Matric No
1.  Nur Atiqah Batrisyia binti Azmi (2123218)
2.  Nur Fatihah Adawiyah binti Rusdi (2126644)
------------------------------------------------
## Introduction of Web Application
_**Online Quran Tutor Registration and Booking System: i-Iqra'**_
* The "Online Quran Tutor Registration and Booking System" is a web-application that simplifies the process of enrolling for Quran tutor classes. This platform seeks to streamline student-tutor interactions by offering an efficient, user-friendly booking session management interface. By focusing on key capabilities like registration and booking, the system improves the educational experience by lowering administrative tasks.
* The system delivers a fully functional, user-friendly website for i-Iqra' Academy. This website will serve as a professional platform to promote the business, facilitate students' registrations and classes bookings, and provide information about the business' team (tutors, etc) and background information (feedbacks, etc).
------------------------------------------------
## Objective of the Enhancements
* Address known web application vulnerabilities.
* Integrate robust security mechanisms based on OWASP standards.
* Protect user data and ensure integrity of the booking process.
* Implement fine-grained access control and session management.
* Ensure secure authentication using password policies and 2FA.
------------------------------------------------
## Web Application Security Enhancements 

### 1. Vulnerability Report - Based on OWASP ZAP scanning and states the risk and confidence levels of the found vulnerability.

🔴 **High-Risk Vulnerabilities**

**1. Path Traversal**
- **Description:** Allows attackers to access files or directories that are outside the intended web root by using ../, encoded slashes, etc.
- **Risk:** Attackers could potentially read sensitive files or execute commands.
- **Example Affected Endpoint:** POST http://localhost/QuranBookingSystem/public/student/login

**2. SQL Injection**
- **Description:** Input such as an email with ' caused a 500 Internal Server Error, which implies poor sanitization and vulnerability to SQL injection.
- **Risk:** Could allow attackers to extract, manipulate, or destroy database contents.
- **Example Affected Endpoint:** POST http://localhost/QuranBookingSystem/public/student/register

  
**🟠 Medium-Risk Vulnerabilities**
 
- **Absence of Anti-CSRF Tokens:** Indicates that some forms or actions are missing CSRF tokens.
- **Content Security Policy (CSP) Header Not Set:** Weakens protection against XSS attacks if not properly implemented.
- **Buffer Overflow:** Indicates potential crash or overflow when handling large inputs.
- **Cross-Domain Misconfiguration:** Resources are loaded from domains that could introduce trust issues.
- **Format String Error:** May crash the app or be exploited for memory access.
- **Missing Anti-clickjacking Header:** No X-Frame-Options or Content-Security-Policy to prevent clickjacking.
- **Vulnerable JavaScript Library:** A third-party JS library in use has known vulnerabilities.
------------------------------------------------
### 2. Web Security Fundamentals (Input Validation) 
* Implemented in `StudentAuthController`, `BookingController`, and other request handlers.
* Validates type, length, and format (whitelisting) using Laravel’s validation layer in regex format.
* All user inputs are filtered using `Request::validate()`.

* `BookingController`:
```bash
public function store(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'session_day' => ['required', 'in:Monday,Tuesday,Wednesday,Thursday,Friday'], 
        'session_time' => ['required', 'in:9am - 10am with Ustaz Muazzam,2pm - 3pm with Ustazah Hanum,5pm - 6pm with Ustaz Zaid Muhammad,8pm - 9pm with Ustazah Ain Lily'], 
        'class_type' => ['required', 'in:Iqra,Al-Quran'], 
        'session_type' => ['required', 'in:Online,In-Person'], 
        'study_level' => ['required', 'in:Beginner,Intermediate,Advanced'], 
        'additional_info' => ['nullable', 'regex:/^[a-zA-Z0-9\s.,!?\'"-]*$/', 'max:1000'], 
    ]);
  ```

* `StudentAuthController`:
```bash
public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255', 'regex:/^[^@\s]+@[^@\s]+\.[^@\s]+$/'],
            'password' => ['required', 'string', 'min:8'],
        ]);
```

```bash
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
```
------------------------------------------------
### 3. Web Security Fundamentals (Error Handling & Information Disclosure)
* Laravel default handler used (`Handler.php`) which will only display 500 | SERVER ERROR to users:
```bash
public function render($request, Throwable $exception): Response
    {
        if (config('app.debug')) {
            return parent::render($request, $exception);
        }

        // In production, show generic error page
        return response()->view('errors.generic', [], 500);
    }
```
* Internal logs stored in `storage/logs/laravel.log`; no sensitive error output shown to users.
------------------------------------------------
### 4. Authentication (Password Storage) 
* Password stored using Argon2id with additional manual salting (`hashing.php`, `User.php`).
* `.env`:
```bash
HASH_DRIVER=argon
```

* `hashing.php`:
```bash
'default' => env('HASH_DRIVER', 'argon'),    //use the Argon algorithm for hashing (instead of the default bcrypt)

'argon' => [
    'memory'  => 65536,
    'threads' => 2,
    'time'    => 4,     //4 times hashing
    'type'    => PASSWORD_ARGON2ID,
    ],
```

* `StudentAuthController`:
```bash
$salt = Str::random(16); 

$user = User::create([
    'name' => $request->name,
    'email' => $request->email,
    'salt' => $salt,
    'password' => Hash::make($request->password . $salt), 
    'gender' => $request->gender,
    'age' => $request->age,
]);
```
------------------------------------------------
### 5. Authentication (Password Policies) 
* Enforced in `PasswordValidationRules.php`:
```bash
protected function passwordRules(): array
    {
        return ['required', 'string', Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
                'confirmed']; // checks against HaveIBeenPwned database
    }
```
* Minimum length set to 8, must have mixed characters, at least one number, letter, and symbol while disallow known weak passwords.
* `StudentAuthController`:
```bash
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
```
------------------------------------------------
### 6. Authentication (2 Factor Authentication) 
* Implemented via `TwoFactorController.php`, `TwoFactorCodeMail.php`.
* One-time codes sent to verified emails using `Mail::to()->send(new TwoFactorCodeMail)`.
* Code will be expired within 10 minutes.
* `StudentAuthController`:
```bash
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
```

* `TwoFactorController`:
```bash
class TwoFactorController extends Controller
{
    //Display the 2FA code input form
    public function index()
    {
        //User logged out and directed to 
        return view('auth.two-factor-challenge');
    }

    //Handle code submission
    public function store(Request $request)
    {
        //Validates 2FA code
        $request->validate([
            'two_factor_code' => ['required', 'digits:6'],
        ]);

        //Identify user from session (only accepts user stored in session)
        //User must already be partially verified
        $userId = $request->session()->get('login.id');

        if (!$userId) {
            return redirect()->route('login')->withErrors(['email' => 'Your session has expired. Please login again.']);
        }

        $user = User::find($userId);

        if ($user->two_factor_code !== $request->two_factor_code) {
            return back()->withErrors(['two_factor_code' => 'The code is incorrect.']);
        }

        if (Carbon::now()->greaterThan($user->two_factor_expires_at)) {
            return back()->withErrors(['two_factor_code' => 'The code has expired.']);
        }

        //If valid; 

        //Clear used 2FA code in database
        $user->two_factor_code = null;
        $user->two_factor_expires_at = null;
        $user->save();

        //Logs user in
        Auth::login($user);

        //Cleans login.id after successful login
        $request->session()->forget('login.id');
        $request->session()->regenerate();

        // 7) Finally, send them where they belong
        if (Auth::user()->role_id === 1) {
            // Admin
            return redirect()->route('frontend.home');
        }

        // Student (or any non-admin)
        return redirect()->intended('/home');
    }
}
```

* `TwoFactorCodeMail.php`:
```bash
class TwoFactorCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your Two-Factor Code')
                    ->view('emails.two-factor-code')
                    ->with(['code'=> $this->user->two_factor_code]);
    }
}
```
------------------------------------------------
### 7. Authentication (Session Management) 
* Session tokens are regenerated on login and destroyed on logout.
* `StudentAuthController`:
```bash
public function login(Request $request)
    {
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
```

```bash
public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); // Prevent CSRF reuse
        return redirect()->route('student.login');
}
```

* session.php:
```bash
'lifetime' => 15,
'expire_on_close' => false,
```
    
* Cookies configured with `HttpOnly`, `Secure`, and `SameSite` flags by default in `session.php`:
```bash
'http_only' => env('SESSION_HTTP_ONLY', true),
'secure' => env('SESSION_SECURE_COOKIE'),
'same_site' => env('SESSION_SAME_SITE', 'lax'),
```

* Users directed to login page after session ends:
`FortifyServiceProvider.php`
```bash
public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        Fortify::loginView(function () {
        return view('student.login');
        });
```

`auth.php`:
```bash
'defaults' => [
        'guard' =>  'web',
        'passwords' => 'users',
    ],

'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),
    'redirects' => [
    'login' => 'student.login',
    ]
```
------------------------------------------------
### 8. Authorization (RBAC/Role-Based Access Control)
* Role definitions in `Role.php`, `User.php`.
* Admins can:
  * View all users (with user's information)
  * All bookings
  * Delete any booking
  * Inactivate/activate any user
  * Delete any user
  * Add booking
  * Delete booking
* Users can:
  * Add booking
  * Delete booking
* Enforced in `AdminController`:
```bash
// at the top of every admin action check the logged-in user’s role_id. 
// if it isn’t 1 (Admin), abort with a 403
protected function ensureIsAdmin()
    {
        if (Auth::user()->role_id !== 1) {
            abort(403, 'Unauthorized');
        }
    }

public function dashboard()
    {
        $this->ensureIsAdmin();
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

public function toggleUser($user_id)
    {
        $this->ensureIsAdmin();
        $user = User::where('user_id', $user_id)->firstOrFail();
        $user->status = ! $user->status;
        $user->save();
        return back();
    }

public function userBookings($user_id)
    {
        $this->ensureIsAdmin();
        $user = User::where('user_id', $user_id)->firstOrFail();
        $bookings = $user->bookings;
        return view('admin.bookings', compact('user', 'bookings'));
    }

public function destroyUser($user_id)
    {
        $this->ensureIsAdmin();
        $user = User::where('user_id', $user_id)->firstOrFail();
        $user->delete();
        return back()->with('status', 'User deleted.');
    }
  ```

* `BookingController.php`:
  ```bash
  public function __construct()
    {
        $this->middleware('auth');

        // block inactive accounts
        $this->middleware(function($request, $next) {
            if (! Auth::user()->status) {
                abort(403, 'Your account has been deactivated.');
            }
            return $next($request);
        });
    }
  ```
* User roles scoped in DB and seeded via `RolesTableSeeder.php`.
* `RolesTableSeeder.php`:
```bash
public function run()
    {
        DB::table('roles')->insert([
            ['role_id' => 1, 'role_name' => 'Admin', 'permissions' => 'full access'], // full permissions
            ['role_id' => 2, 'role_name' => 'User', 'permissions' => 'create, view, update booking'], // example permissions
        ]);
    }
  ```
* `DatabaseSeeder.php`:
```bash
  public function run(): void
    {
        $this->call(RolesTableSeeder::class);
    }
```
------------------------------------------------
### 9. Authorization (Default Permissions)
* All routes protected via role-check middleware.
* `web.php`:
```bash
Route::middleware(['auth'])->group(function () {
Route::get('/dashboard', [BookingController::class, 'index'])->name('student.dashboard');
Route::get('/bookings/create', [BookingController::class, 'create'])->name('booking.create');
Route::post('/bookings', [BookingController::class, 'store'])->name('booking.store');
Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])->name('booking.destroy');
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::patch('users/{user_id}/toggle', [AdminController::class, 'toggleUser'])->name('users.toggle');
Route::get('users/{user_id}/bookings', [AdminController::class, 'userBookings'])->name('bookings');
Route::delete('users/{user_id}', [AdminController::class, 'destroyUser'])->name('users.destroy');
});
```
* Least privilege by default using Laravel Policies.
* Admins and students have scoped abilities.
* DB `.env` user: `quranbookingsystem_user` has minimal privileges.
------------------------------------------------
### 10. Browser Security Principles (Cross-Site Scripting (XSS) Prevention)
* All outputs escaped using Blade (`{{ }}`), no (`{{!! !!}}`) used.
* Example: `dashboard.blade.php`
  ```bash
  @foreach ($bookings as $booking)
  <tr class="bg-gray-100">
  <td class="border px-4 py-2">{{ $booking->user->name ?? 'N/A' }}</td>
  <td class="border px-4 py-2">{{ $booking->user->email ?? 'N/A' }}</td>
  <td class="border px-4 py-2">{{ $booking->user->phone ?? 'N/A' }}</td>
  <td class="border px-4 py-2">{{ $booking->session_day }}</td>
  <td class="border px-4 py-2">{{ $booking->session_time }}</td>
  <td class="border px-4 py-2">{{ $booking->class_type }}</td>
  <td class="border px-4 py-2">{{ $booking->session_type }}</td>
  <td class="border px-4 py-2">{{ $booking->study_level }}</td>
  <td class="border px-4 py-2">{{ $booking->additional_info }}</td>
  <td class="border px-4 py-2">
  <form action="{{ route('booking.destroy', $booking->booking_id) }}" method="POST">
  @csrf
   @method('DELETE')
  <button type="submit" class="bg-red-600 text-white p-2 rounded hover:bg-red-700" action="{{ route('booking.destroy', $booking->booking_id) }}" method="POST">Drop</button>
  </form>
  </tr>
  @endforeach
  ```
* User-generated input never rendered as raw HTML.
------------------------------------------------
### 11. Web Security Fundamentals (Cross-Site Request Forgery (CSRF) Protection)
* All POST, PUT, PATCH, and DELETE forms include the @csrf directive in Blade templates.
* Example: `add.blade.php`
```bash
<form class="custom-form booking-form" action="{{ route('booking.store') }}" method="POST">
@csrf
    <div class="text-center mb-4 pb-lg-2">
    <em class="text-white">Fill out the booking form</em>
    <h2 class="text-white">Book a class</h2>
    </div>
```
* `student\dashboard.blade.php`:
```bash
<form action="{{ route('booking.destroy', $booking->booking_id) }}" method="POST">
@csrf
@method('DELETE')
    <button type="submit" class="bg-red-600 text-white p-2 rounded hover:bg-red-700" action="{{ route('booking.destroy', $booking->booking_id) }}" method="POST">Drop</button>
</form>
```

* `admin\dashboard.blade.php`:
```bash
<form method="POST" action="{{ route('admin.users.toggle', $u->user_id) }}">
@csrf
@method('PATCH')
<div class="form check form-switch">
    <input class="form-check-input" type="checkbox" name="status" id="active-switch-{{ $u->user_id }}" onchange="this.form.submit()"
    {{ $u->status ? 'checked' : '' }}>
<label class="form-check-label" for="active-switch-{{ $u->user_id }}">
    {{ $u->status ? 'Active' : 'Inactive' }}
</label>
</div>
</form>
```

* Laravel automatically verifies the CSRF token on each request through the VerifyCsrfToken middleware.
* `Kernel.php`:
```bash
use Illuminate\Foundation\Http\Kernel as HttpKernel;

// All middleware used directly from Laravel framework namespaces
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

protected $middlewareGroups = [
        'web' => [
            EncryptCookies::class,
            AddQueuedCookiesToResponse::class,
            StartSession::class,
            AuthenticateSession::class,
            ShareErrorsFromSession::class,
            VerifyCsrfToken::class, // CSRF protection middleware
            SubstituteBindings::class,
        ],
```

* Meta tag is included in the layout file `app.blade.php`:
```bash
<meta name="csrf-token" content="{{ csrf_token() }}">
```
------------------------------------------------
### 12. Database Security Principles (SQL Injection Prevention)
* All queries use Laravel's Eloquent ORM or parameterized DB queries (`DB::table()->where(...)`).
* Example: `RolesTableSeeder.php`
  ```bash
  public function run()
    {
        DB::table('roles')->insert([
            ['role_id' => 1, 'role_name' => 'Admin', 'permissions' => 'full access'], // full permissions
            ['role_id' => 2, 'role_name' => 'User', 'permissions' => 'create, view, update booking'], // example permissions
        ]);
    }
  ```
* No raw SQL concatenation used.
------------------------------------------------
### 13. Database Security Principles (Database Access Control)
* Application connects using `.env` credentials with minimum DB privileges.
```bash
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=quranbookingsystem
  DB_USERNAME=quranbookingsystem_user
  DB_PASSWORD=quranbookingsystem_user20232025
```
  
* Minimal privileges for DB user: No DROP, ALTER privileges in production.
  <img width="701" alt="Screenshot 2025-06-26 114808" src="https://github.com/user-attachments/assets/e1347d26-363e-4160-bd23-0a60b6da1ff1" />
------------------------------------------------
### 14. File Security Principles (File Access Control)
* Blade files (`login.blade.php`, `register.blade.php`, `dashboard.blade.php`, etc.) are not publicly accessible.
* File paths never include direct user input.
* No file path injection (no user-defined file path usage).
------------------------------------------------
## References
* Laravel Official Documentation: [https://laravel.com/docs/12.x/](https://laravel.com/docs/12.x/)
* ChatGPT (OpenAI): [https://openai.com/chatgpt](https://openai.com/chatgpt)
* Sullivan, Bryan; Liu, Vincent. Web Application Security, A Beginner's Guide (Kindle Location 2382). McGraw-Hill Education. Kindle Edition.
