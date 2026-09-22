<?php
$page_title = "Book List";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$daftarBuku = $_SESSION['books'] ?? [];
?>
        <section>
            <h2>Book List</h2>
            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['message']; ?></p>
            <?php endif; ?>
            <div class="search-box">
                <label for="search-input">Search Book Title</label>
                <input type="text" id="search-input" placeholder="Type a book title..." />
            </div>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Year</th>
                            <th>Stock</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($daftarBuku)): ?>
                        <tr>
                            <td colspan="5">There is no book data yet. Please add it via the "Add Book" menu.</td>
                        </tr>
                        <?php else: ?>
                            <?php foreach ($daftarBuku as $buku): ?>
                            <tr>
                                <td><?php echo $buku['judul']; ?></td>
                                <td><?php echo $buku['author']; ?></td>
                                <td><?php echo $buku['year']; ?></td>
                                <td><?php echo $buku['stock']; ?></td>
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