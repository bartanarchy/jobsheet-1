<?php
$page_title = "Member List";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftarAnggota = $_SESSION['members'] ?? [];
?>
        <section>
            <h2>Member List</h2>
            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['message']; ?></p>
            <?php endif; ?>
            <div class="search-box">
                <label for="search-input">Search Member Name</label>
                <input type="text" id="search-input" placeholder="Type a member name..." />
            </div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Member No.</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($daftarAnggota)): ?>
                        <tr>
                            <td colspan="5">There is no member data yet. Please add it via the "Add Member" menu.</td>
                        </tr>
                        <?php else: ?>
                            <?php foreach ($daftarAnggota as $anggota): ?>
                            <tr>
                                <td><?php echo $anggota['no_anggota']; ?></td>
                                <td><?php echo $anggota['nama']; ?></td>
                                <td><?php echo $anggota['alamat']; ?></td>
                                <td><?php echo $anggota['no_hp']; ?></td>
                                <td>
                                    <button type="button">Edit</button>
                                    <button type="button" class="btn-hapus">Delete</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>