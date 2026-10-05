<?php
require_once __DIR__ . '/../includes/csrf.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit;
}

$page_title = "Officer Registration";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
        <section>
            <h2>Officer Registration</h2>
            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['message']; ?></p>
            <?php endif; ?>
            <form method="post" action="process_register.php" novalidate>
                  <?php echo csrf_field(); ?>
                <p>
                    <label for="name">Name</label><br>
                    <input type="text" id="name" name="name" required>
                </p>
                <p>
                    <label for="username">Username</label><br>
                    <input type="text" id="username" name="username" required>
                </p>
                <p>
                    <label for="password">Password</label><br>
                    <input type="password" id="password" name="password" minlength="6" required>
                </p>
                <p>
                    <button type="submit">Register</button>
                </p>
            </form>
            <p>Already have an account? <a href="login.php">Log in here</a></p>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>