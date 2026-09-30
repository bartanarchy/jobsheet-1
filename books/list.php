    <?php
    session_start();
    $page_title = "Book List";
    include __DIR__ . '/../includes/header.php';
    require __DIR__ . '/../includes/koneksi.php';

    $flash = $_SESSION['flash'] ?? null;
    unset($_SESSION['flash']);

    $perPage = 5;
    $page = max(1, (int) ($_GET['page'] ?? 1));
    $offset = ($page - 1) * $perPage;
    $keyword = trim($_GET['q'] ?? '');

    if ($keyword !== '') {
        $hitung = $pdo->prepare("SELECT COUNT(*) FROM books WHERE title ILIKE :kw");
        $hitung->execute(['kw' => '%' . $keyword . '%']);
        $totalRows = $hitung->fetchColumn();

        $stmt = $pdo->prepare("SELECT * FROM books WHERE title ILIKE :kw ORDER BY id DESC LIMIT :limit OFFSET :offset");
        $stmt->bindValue('kw', '%' . $keyword . '%');
    } else {
        $totalRows = $pdo->query("SELECT COUNT(*) FROM books")->fetchColumn();
        $stmt = $pdo->prepare("SELECT * FROM books ORDER BY id DESC LIMIT :limit OFFSET :offset");
    }
    $stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
    $stmt->bindValue('offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $bookList = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $totalPages = max(1, (int) ceil($totalRows / $perPage));
    ?>
    <section>
        <h2>Book List</h2>
        <?php if ($flash): ?>
            <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['message']; ?></p>
        <?php endif; ?>

        <div class="search-box">
            <form method="get" action="list.php">
                <label for="search-input">Search Book Title</label><br>
                <input type="text" id="search-input" name="q" value="<?php echo $keyword; ?>" placeholder="Type a book title...">
                <button type="submit">Search</button>
            </form>
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
                    <?php if (empty($bookList)): ?>
                        <tr>
                            <td colspan="5">No book data found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($bookList as $book): ?>
                            <tr>
                                <td><?php echo $book['title']; ?></td>
                                <td><?php echo $book['author']; ?></td>
                                <td><?php echo $book['year']; ?></td>
                                <td><?php echo $book['stock']; ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $book['id']; ?>" class="btn-edit">Edit</a>
                                    <a href="detail.php?id=<?php echo $book['id']; ?>" class="btn-detail">Detail</a>
                                    <form class="form-hapus" method="post" action="hapus.php">
                                        <input type="hidden" name="id" value="<?php echo $book['id']; ?>">
                                        <button type="submit" class="btn-hapus">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <nav class="pagination">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="list.php?page=<?php echo $i; ?><?php echo $keyword !== '' ? '&q=' . urlencode($keyword) : ''; ?>"
                    class="<?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
            <?php endfor; ?>
        </nav>
    </section>
    <?php include __DIR__ . '/../includes/footer.php'; ?>