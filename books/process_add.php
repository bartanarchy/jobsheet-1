<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';

$title    = trim($_POST['title'] ?? '');
$author   = trim($_POST['author'] ?? '');
$year     = $_POST['year'] ?? '';
$isbn     = trim($_POST['isbn'] ?? '');
$stock    = $_POST['stock'] ?? '';
$category = trim($_POST['category'] ?? '');

$errors = [];
if ($title === '') $errors[] = "Title is required.";
if ($author === '') $errors[] = "Author is required.";
if (!is_numeric($year) || $year < 1900 || $year > 2026) $errors[] = "Year must be between 1900-2026.";
if (!is_numeric($stock) || $stock < 0) $errors[] = "Stock must not be negative.";

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => implode(' ', $errors)];
    header('Location: add.php');
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO books (title, author, year, isbn, stock, category)
     VALUES (:title, :author, :year, :isbn, :stock, :category)"
);
$stmt->execute([
    'title'    => $title,
    'author'   => $author,
    'year'     => (int) $year,
    'isbn'     => $isbn,
    'stock'    => (int) $stock,
    'category' => $category,
]);

$_SESSION['flash'] = ['type' => 'success', 'message' => 'Book successfully added.'];
header('Location: list.php');
exit;