<?php
$page_title = "Add Member";
include __DIR__ . '/../includes/header.php';
?>
<section>
    <h2>Add Member</h2>
    <form id="form-tambah" method="post" action="proses_tambah.php" novalidate>
        <p>
            <label for="name">Name</label><br />
            <input type="text" id="name" name="name" required />
        </p>
        <p>
            <label for="member_number">Member No.</label><br />
            <input type="text" id="member_number" name="member_number" required />
        </p>
        <p>
            <label for="address">Address</label><br />
            <input type="text" id="address" name="address" />
        </p>
        <p>
            <label for="phone_number">Phone</label><br />
            <input type="text" id="phone_number" name="phone_number" />
        </p>
        <p>
            <button type="submit">Save</button>
        </p>
    </form>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>
