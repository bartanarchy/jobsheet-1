# Wireframe & User Flow — SIMPUS-Mini

This document contains the design plan for features that have not been
coded yet: Login, Dashboard, Borrowing, Returns, and History. These
features will start being implemented in upcoming jobsheets.

## 1. Wireframe: Login Page

```
+--------------------------------------+
|              SIMPUS-Mini             |
|----------------------------------------|
|                                        |
|         [ Officer Login ]             |
|                                        |
|   Username : [______________]         |
|   Password : [______________]         |
|                                        |
|             [ Log in ]                |
|                                        |
| Don't have an account yet? Sign up here |
+--------------------------------------+
```

Translation to HTML:
- "SIMPUS-Mini" → `<header><h1>` (same as every other page)
- "Officer Login" → section title, similar to `<h2>`
- `Username : [______________]` and `Password : [______________]` → a
  `<label>` + `<input>` pair, same pattern as the Add Book/Member form.
  Password uses `<input type="password">` (new, so typed characters
  are hidden as dots)
- `[ Log in ]` → `<button type="submit">`

## 2. Wireframe: Officer Dashboard

```
+-----------------------------------------------------+
| SIMPUS-Mini   Home | Books | Members | Borrowing | (Officer Name) Logout |
|-------------------------------------------------------|
| [Total Books] [Total Members] [On Loan]                |
|                                                         |
| Quick Action:                                          |
| [ + New Loan ] [ + Return ]                            |
|                                                         |
| Recent Transactions                                    |
| --------------------------------------------------     |
| Member | Book | Loan Date | Status                     |
+--------------------------------------------------------+
```

Note: this looks a lot like the navbar and stat cards already running
in `index.html`, just with one new menu item ("Borrowing") and a login
status indicator `(Officer Name) Logout` on the right side of the
header.

## 3. User Flow: Book Borrowing

```
[Officer Login] -> [Dashboard] -> [Select "New Loan" menu]
    -> [Select Member] -> [Select Book (stock > 0)]
    -> [Save] -> [Book stock decreases by 1] -> [Back to Dashboard]
```

Important note: books with 0 stock must not appear as an option in the
borrowing form. This rule is recorded at the design stage so it's not
forgotten later when coding.

## 4. User Flow: Book Return

```
[Dashboard] -> [Menu "Return"] -> [Search active transaction (member/book)]
    -> [Mark as "Returned"] -> [Stock increases by 1]
    -> [Back to Dashboard]
```

Difference from the Borrowing flow: it starts by searching for an
existing active transaction (not entering new data), and the side
effect is the opposite (stock increases instead of decreases).

## 5. Actors

- **Guest** — can view Home & Book List without logging in. These are
  all the pages already built in jobsheet 1-3.
- **Officer** — must log in to access Dashboard, Borrowing, Return,
  and History. This feature is newly designed in this jobsheet, not
  yet coded.

## 6. Consistency with the Existing Design

- Accent color, navbar typography, and table/card styles follow the
  `style.css` that has already been built since jobsheet 2-3.
- The navbar will get a Borrowing menu item and login status indicator
  added once implementation starts in a future jobsheet.
- Edge cases to handle during implementation:
  - Out-of-stock books must not be selectable in the borrowing form.
  - Members with overdue arrears (to be handled in a future
    self-study jobsheet).