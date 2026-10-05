<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';
require __DIR__ . '/../includes/csrf.php';

csrf_verify();

$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    // Regenerate session ID after successful login to prevent session fixation.
    session_regenerate_id(true);

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['name']    = $user['name'];   // raw value; escape with e() only when printing
    $_SESSION['role']    = $user['role'];

    header('Location: ../index.php');
    exit;
}

$_SESSION['flash'] = ['type' => 'error', 'message' => 'Username or password incorrect.'];
header('Location: login.php');
exit;