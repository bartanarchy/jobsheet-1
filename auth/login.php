<?php
require_once __DIR__ . '/../includes/csrf.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

$page_title = "Login";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
        <section>
            <h2>Officer Login</h2>
            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['message']; ?></p>
            <?php endif; ?>
            <form method="post" action="process_login.php" novalidate>
                  <?php echo csrf_field(); ?>
                <p>
                    <label for="username">Username</label><br>
                    <input type="text" id="username" name="username" required>
                </p>
                <p>
                    <label for="password">Password</label><br>
                    <input type="password" id="password" name="password" required>
                </p>
                <p>
                    <button type="submit">Log in</button>
                </p>
            </form>
            <p>Don't have an account yet? <a href="register.php">Register here</a></p>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>