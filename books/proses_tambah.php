<?php
require __DIR__ . '/../includes/koneksi.php';
session_start();

$judul = trim($_POST['title'] ?? '');
$pengarang = trim($_POST['author'] ?? '');
$tahun = $_POST['year'] ?? '';
$isbn = trim($_POST['isbn'] ?? '');
$stok = $_POST['stock'] ?? '';
$kategori = trim($_POST['category'] ?? '');

$errors = [];

if ($judul === '') {
    $errors[] = "Judul wajib diisi.";
}
if ($pengarang === '') {
    $errors[] = "Pengarang wajib diisi.";
}
if (!is_numeric($tahun) || $tahun < 1900 || $tahun > 2026) {
    $errors[] = "Tahun harus di antara 1900-2026.";
}
if (!is_numeric($stok) || $stok < 0) {
    $errors[] = "Stok tidak boleh negatif.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO books (title, author, year, isbn, stock, category)
     VALUES (:title, :author, :year, :isbn, :stock, :category)
     RETURNING id"
);
$stmt->execute([
    'title' => $judul,
    'author' => $pengarang,
    'year' => (int) $tahun,
    'isbn' => $isbn,
    'stock' => (int) $stok,
    'category' => $kategori,
]);

$_SESSION['flash'] = ['type' => 'success', 'message' => 'Buku berhasil ditambahkan.'];
header('Location: list.php');
exit;
