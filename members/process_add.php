<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';

$name          = trim($_POST['name'] ?? '');
$member_number = trim($_POST['member_number'] ?? '');
$address       = trim($_POST['address'] ?? '');
$phone_number  = trim($_POST['phone_number'] ?? '');

$errors = [];
if ($name === '') $errors[] = "Name is required.";
if ($member_number === '') $errors[] = "Member No. is required.";

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => implode(' ', $errors)];
    header('Location: add.php');
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO members (name, member_number, address, phone_number)
     VALUES (:name, :member_number, :address, :phone_number)"
);
$stmt->execute([
    'name'          => $name,
    'member_number' => $member_number,
    'address'       => $address,
    'phone_number'  => $phone_number,
]);

$_SESSION['flash'] = ['type' => 'success', 'message' => 'Member successfully added.'];
header('Location: list.php');
exit;