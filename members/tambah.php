<?php
$page_title = "Add Member";
include __DIR__ . '/../includes/header.php';
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
<section>
    <form id="form-tambah" method="post" action="proses_tambah.php" novalidate>
        <p>
            <label for="nama">Name</label><br />
            <input type="text" id="nama" name="nama" required />
        </p>
        <p>
        <label for="no_anggota">Member No.</label><br />
        <input type="text" id="no_anggota" name="no_anggota" required />
    </p>
    <p>
        <label for="alamat">Address</label><br />
        <input type="text" id="alamat" name="alamat" />
    </p>
    <p>
        <label for="no_hp">Phone</label><br />
        <input type="text" id="no_hp" name="no_hp" />
    </p>
    <p>
        <label for="email">Email</label><br />
        <input type="email" id="email" name="email" />
    </p>
    <p>
        <button type="submit">Save</button>
    </p>
</form>
<?php include __DIR__ . '/../includes/footer.php'; ?>