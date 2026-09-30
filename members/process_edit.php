<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';

$id            = $_POST['id'] ?? null;
$name          = trim($_POST['name'] ?? '');
$member_number = trim($_POST['member_number'] ?? '');
$address       = trim($_POST['address'] ?? '');
$phone_number  = trim($_POST['phone_number'] ?? '');

if (!$id) {
    header('Location: list.php');
    exit;
}

$errors = [];
if ($name === '') $errors[] = "Name is required.";
if ($member_number === '') $errors[] = "Member No. is required.";

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'message' => implode(' ', $errors)];
    header('Location: edit.php?id=' . urlencode($id));
    exit;
}

$stmt = $pdo->prepare(
    "UPDATE members SET name = :name, member_number = :member_number, address = :address,
     phone_number = :phone_number WHERE id = :id"
);
$stmt->execute([
    'name'          => $name,
    'member_number' => $member_number,
    'address'       => $address,
    'phone_number'  => $phone_number,
    'id'            => $id,
]);

$_SESSION['flash'] = ['type' => 'success', 'message' => 'Member successfully updated.'];
header('Location: list.php');
exit;