# Quran Booking System

## Name and Matric No:
1.  Nur Atiqah Batrisyia binti Azmi 2123218
2.  Nur Fatihah Adawiyah binti Rusdi 2126644

## Introduction of Web Application:

## Objective of the Enhancements:

* Address known web application vulnerabilities.
* Integrate robust security mechanisms based on OWASP standards.
* Protect user data and ensure integrity of the booking process.
* Implement fine-grained access control and session management.
* Ensure secure authentication using password policies and 2FA.

## Web Application Security Enhancements: 

### 1. Vulnerability Report - Based on OWASP ZAP scanning and states the risk and confidence levels of the found vulnerability. 
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
* Laravel Official Documentation: [https://laravel.com/docs/12.x/)](https://laravel.com/docs/12.x/)
* ChatGPT (OpenAI): [https://openai.com/chatgpt](https://openai.com/chatgpt)
