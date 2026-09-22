<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="assets/css/style.css" />
    <title>SIMPUS-Mini | Login</title>
  </head>
  <body>
    <header>
      <h1>SIMPUS-Mini</h1>
      <button type="button" id="nav-toggle-btn" class="nav-toggle-label" aria-label="Menu">&#9776;</button>
      <nav>
        <ul>
          <li><a href="index.html">Home</a></li>
          <li><a href="books/list.html">Book List</a></li>
          <li><a href="books/tambah.html">Add Book</a></li>
          <li><a href="members/list.html">Member List</a></li>
          <li><a href="members/tambah.html">Add Member</a></li>
        </ul>
      </nav>
    </header>

    <main>
      <section>
        <h2>Officer Login</h2>
        <form>
          <p>
            <label for="username">Username</label><br />
            <input type="text" id="username" name="username" required />
          </p>
          <p>
            <label for="password">Password</label><br />
            <input type="password" id="password" name="password" required />
          </p>
          <p>
            <button type="submit">Log in</button>
          </p>
        </form>
        <p>Don't have an account yet? <a href="#">Sign up here</a></p>
      </section>
    </main>

    <footer>
      <p>© 2026 SIMPUS-Mini - Jobsheet 4 (UI/UX Exercise)</p>
    </footer>

    <script src="assets/js/app.js"></script>
  </body>
</html>