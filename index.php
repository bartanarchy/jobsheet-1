<?php
$page_title = "Home";
include __DIR__ . '/includes/header.php';

$totalBuku = count($_SESSION['books'] ?? []);
$totalAnggota = count($_SESSION['members'] ?? []);
?>
        <section>
            <h2>Welcome to the Mini Library System</h2>
            <p>A simple application to manage library books and members.</p>
        </section>

        <section>
            <h2>Summary</h2>
            <article>
                <h3>Total Books</h3>
                <p><?php echo $totalBuku; ?></p>
            </article>
            <article>
                <h3>Total Members</h3>
                <p><?php echo $totalAnggota; ?></p>
            </article>
            <article>
                <h3>Currently Borrowed</h3>
                <p>0</p>
            </article>
            <article>
                <h3>Overdue Books</h3>
                <p>0</p>
            </article>
        </section>
<?php include __DIR__ . '/includes/footer.php'; ?>