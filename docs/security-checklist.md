# Security Checklist — Jobsheet 11

| # | Vulnerability | Found in | Before | After (fix + evidence) |
|---|---------------|----------|--------|------------------------|
| 1 | SQL Injection | books/, members/, auth/ | Already used prepared statements since jobsheet-08 | Re-audited, secure. No query concatenates `$_POST`/`$_GET`. Tested `' OR '1'='1` on login: rejected ("Username or password is wrong"). |
| 2 | XSS | books/list.php, books/edit.php, members/list.php, members/edit.php, includes/header.php | DB/`$_GET` output printed raw with `echo` | Added `e()` (`htmlspecialchars` + `ENT_QUOTES`) in `includes/helpers.php` and wrapped all text output. Tested title `<script>alert(1)</script>`: shown as plain text, no popup. |
| 3 | CSRF | All POST forms and process_*/delete.php | POST-only check was not enough | Added `csrf_token()`, `csrf_field()`, `csrf_verify()` in `includes/csrf.php`. Tested `curl -X POST .../books/process_add.php -d "judul=x"` without a token: HTTP 403. |
| 4 | Input Validation & Sanitation | process_*.php | `trim`, `=== ''` checks, `is_numeric()` already in place | Re-audited, secure. Added explicit `(int)` cast on hidden id in books/edit.php and members/edit.php. |
| 5 | Session Fixation | auth/process_login.php | Same session ID before and after login | Added `session_regenerate_id(true)` right after `password_verify()` succeeds, before filling `$_SESSION`. |

## Implementation Notes

- On process pages, `includes/auth.php` (login guard) is always required **before** `includes/csrf.php`, so non-logged-in users are redirected to login before any CSRF check.
- `session_regenerate_id(true)` is only called in `process_login.php`: registration does not log the user in, and logout calls `session_destroy()`.
- The search form (`method="get"`) intentionally has no CSRF token because it only reads data.

## How to Test

1. **XSS:** add a book titled `<script>alert(1)</script>`, open `books/list.php`: text is displayed, no popup.
2. **CSRF:** log in, then `curl -X POST http://localhost:8000/books/process_add.php -d "judul=x"` -> 403.
3. **Guard order:** log out, open `books/add.php` -> redirected to login.
4. **SQLi:** log in with username `' OR '1'='1` and any password -> rejected.