<?php
// Guard clause: included on the very first line of every page that requires
// login (before header.php prints any output), so that header('Location: ...')
// can still be called.

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}