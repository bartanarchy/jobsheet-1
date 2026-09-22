<?php
session_start();

$nama = trim($_POST['nama'] ?? '');
$no_anggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$no_hp = trim($_POST['no_hp'] ?? '');
$email = trim($_POST['email'] ?? '');

$errors = [];
if ($nama === '') {
    $errors[] = "Name is required.";
}
if ($no_anggota === '') {
    $errors[] = "Member No. is required.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

if (!isset($_SESSION['members'])) {
    $_SESSION['members'] = [];
}

$_SESSION['members'][] = [
    'nama' => $nama,
    'no_anggota' => $no_anggota,
    'alamat' => $alamat,
    'no_hp' => $no_hp,
    'email' => $email,
];

$_SESSION['flash'] = ['type' => 'success', 'message' => 'Member successfully added.'];
header('Location: list.php');
exit;