# Quran Booking System (group: The Jannah Seekers)

## Name and Matric No
1.  Nur Atiqah Batrisyia binti Azmi (2123218)
2.  Nur Fatihah Adawiyah binti Rusdi (2126644)

## Introduction of Web Application
Online Quran Tutor Registration and Booking System: i-Iqra'
* The "Online Quran Tutor Registration and Booking System" is a web-application that simplifies the process of enrolling for Quran tutor classes. This platform seeks to streamline student-tutor interactions by offering an efficient, user-friendly booking session management interface. By focusing on key capabilities like registration and booking, the system improves the educational experience by lowering administrative tasks.
* The system delivers a fully functional, user-friendly website for i-Iqra' Academy. This website will serve as a professional platform to promote the business, facilitate students' registrations and classes bookings, and provide information about the business' team (tutors, etc) and background information (feedbacks, etc).

## Objective of the Enhancements
* Address known web application vulnerabilities.
* Integrate robust security mechanisms based on OWASP standards.
* Protect user data and ensure integrity of the booking process.
* Implement fine-grained access control and session management.
* Ensure secure authentication using password policies and 2FA.

## Web Application Security Enhancements 

### 1. Vulnerability Report - Based on OWASP ZAP scanning and states the risk and confidence levels of the found vulnerability.

🔴 **High-Risk Vulnerabilities**
**1. Path Traversal**
**Description:** Allows attackers to access files or directories that are outside the intended web root by using ../, encoded slashes, etc.
**Risk:** Attackers could potentially read sensitive files or execute commands.
**Example Affected Endpoint:**
POST http://localhost/QuranBookingSystem/public/student/login

**2. SQL Injection**
**Description:** Input such as an email with ' caused a 500 Internal Server Error, which implies poor sanitization and vulnerability to SQL injection.
**Risk:** Could allow attackers to extract, manipulate, or destroy database contents.
**Example Affected Endpoint:**
POST http://localhost/QuranBookingSystem/public/student/register

**🟠 Medium-Risk Vulnerabilities**
**1. Absence of Anti-CSRF Tokens**
* Indicates that some forms or actions are missing CSRF tokens.

**2. Content Security Policy (CSP) Header Not Set**
* Weakens protection against XSS attacks if not properly implemented.

**3. Buffer Overflow**
* Indicates potential crash or overflow when handling large inputs.

**4. Cross-Domain Misconfiguration**
* Resources are loaded from domains that could introduce trust issues.

**5. Format String Error**
* May crash the app or be exploited for memory access.

**6. Missing Anti-clickjacking Header**
* No X-Frame-Options or Content-Security-Policy to prevent clickjacking.

**7. Vulnerable JavaScript Library**
* A third-party JS library in use has known vulnerabilities.

### 2. Web Security Fundamentals (Input Validation) 
* Implemented in `StudentAuthController`, `BookingController`, and other request handlers.
* Validates type, length, and format (whitelisting) using Laravel’s validation layer in regex format.
* All user inputs are filtered using `Request::validate()`.

### 3. Web Security Fundamentals (Error Handling & Information Disclosure)
* Laravel default handler used (`Handler.php`) which will only display 500 | SERVER ERROR to users.
* Internal logs stored in `storage/logs/laravel.log`; no sensitive error output shown to users.
  
### 4. Authentication (Password Storage) 
* Password stored using Argon2id with additional manual salting (`hashing.php`, `User.php`).
* `.env: HASH_DRIVER=argon`.
* `Hash::make($salt . $password)`.

### 5. Authentication (Password Policies) 
* Enforced in `PasswordValidationRules.php`.
* Minimum length set to 8, must have mixed characters, at least one number, letter, and symbol while disallow known weak passwords.

### 6. Authentication (2 Factor Authentication) 
* Implemented via `TwoFactorController.php`, `TwoFactorCodeMail.php`.
* One-time codes sent to verified emails using `Mail::to()->send(new TwoFactorCodeMail)`.
* Code will be expired within 10 minutes.

### 7. Authentication (Session Management) 
* Session tokens are regenerated on login and destroyed on logout.
* Cookies configured with `HttpOnly`, `Secure`, and `SameSite` flags.
  
### 8. Authorization (RBAC/Role-Based Access Control)
* Role definitions in `Role.php`, `User.php`.
* Enforced in `AdminController`, `StudentAuthController`.
* User roles scoped in DB and seeded via `RolesTableSeeder.php`.

### 9. Authorization (Default Permissions)
* All routes protected via role-check middleware.
* Least privilege by default using Laravel Policies.
* Admins and students have scoped abilities.
* DB `.env` user: `quranbookingsystem_user` has minimal privileges.
  
### 10. Browser Security Principles (Cross-Site Scripting (XSS) Prevention)
* All outputs escaped using Blade (`{{ }}`), no (`{{!! !!}}`) used.
* User-generated input never rendered as raw HTML.
  
### 11. Database Security Principles (SQL Injection Prevention)
* All queries use Laravel's Eloquent ORM or parameterized DB queries (`DB::table()->where(...)`).
* No raw SQL concatenation used.

### 12. Database Security Principles (Database Access Control)
* Application connects using `.env` credentials with minimum DB privileges.
* Minimal privileges for DB user: No DROP, ALTER privileges in production.
  
### 13. File Security Principles (File Access Control)
* Blade files (`login.blade.php`, `register.blade.php`, `dashboard.blade.php`, etc.) are not publicly accessible.
* File paths never include direct user input.
* No file path injection (no user-defined file path usage).

## References
* Laravel Official Documentation: [https://laravel.com/docs/12.x/](https://laravel.com/docs/12.x/)
* ChatGPT (OpenAI): [https://openai.com/chatgpt](https://openai.com/chatgpt)
* Sullivan, Bryan; Liu, Vincent. Web Application Security, A Beginner's Guide (Kindle Location 2382). McGraw-Hill Education. Kindle Edition.
