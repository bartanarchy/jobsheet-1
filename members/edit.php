<?php
session_start();
$page_title = "Edit Member";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM members WHERE id = :id");
$stmt->execute(['id' => $id]);
$member = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$member) {
    header('Location: list.php');
    exit;
}
?>
<section>
    <h2>Edit Member</h2>
    <?php if ($flash): ?>
        <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['message']; ?></p>
    <?php endif; ?>
    <form id="form-edit" method="post" action="proses_edit.php" novalidate>
        <input type="hidden" name="id" value="<?php echo $member['id']; ?>">
        <p>
            <label for="name">Name</label><br />
            <input type="text" id="name" name="name" value="<?php echo $member['name']; ?>" required />
        </p>
        <p>
            <label for="member_number">Member No.</label><br />
            <input type="text" id="member_number" name="member_number" value="<?php echo $member['member_number']; ?>" required />
        </p>
        <p>
            <label for="address">Address</label><br />
            <input type="text" id="address" name="address" value="<?php echo $member['address']; ?>" />
        </p>
        <p>
            <label for="phone_number">Phone</label><br />
            <input type="text" id="phone_number" name="phone_number" value="<?php echo $member['phone_number']; ?>" />
        </p>
        <p>
            <button type="submit">Save Changes</button>
        </p>
    </form>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
