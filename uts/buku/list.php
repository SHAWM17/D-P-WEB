<?php
$page_title = "Daftar Buku";
include __DIR__ . '/../includes/header.php';
require __DIR__ . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$perPage = 5;
$page    = max(1, (int) ($_GET['page'] ?? 1));
$offset  = ($page - 1) * $perPage;

$keyword  = trim($_GET['q'] ?? '');
$kategori = trim($_GET['kategori'] ?? '');

// Menyusun Klausa WHERE Dinamis
$whereClauses = [];
$params       = [];

if ($keyword !== '') {
    $whereClauses[] = "judul ILIKE :kw";
    $params['kw']   = '%' . $keyword . '%';
}

if ($kategori !== '') {
    $whereClauses[] = "kategori = :kategori";
    $params['kategori'] = $kategori;
}

$whereSql = "";
if (!empty($whereClauses)) {
    $whereSql = "WHERE " . implode(" AND ", $whereClauses);
}

// Hitung total baris untuk pagination
$hitung = $pdo->prepare("SELECT COUNT(*) FROM buku $whereSql");
$hitung->execute($params);
$totalRows = $hitung->fetchColumn();

// Ambil data buku
$sql  = "SELECT * FROM buku $whereSql ORDER BY id DESC LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);

foreach ($params as $key => $val) {
    $stmt->bindValue($key, $val);
}
$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$daftarBuku = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalPages = max(1, (int) ceil($totalRows / $perPage));
?>

<section>
    <h2>Daftar Buku</h2>
    <?php if ($flash): ?>
        <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
    <?php endif; ?>

    <!-- Form Pencarian + Filter Kategori -->
    <div class="search-box">
        <form method="get" action="list.php" style="display: flex; gap: 0.5rem; align-items: center; margin-bottom: 1rem;">
            <input type="text" id="search-input" name="q" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Ketik judul buku...">
            
            <select name="kategori" style="padding: 0.55rem; border-radius: 4px; border: 1px solid #ccc;">
                <option value="">-- Semua Kategori --</option>
                <option value="fiksi" <?php echo $kategori === 'fiksi' ? 'selected' : ''; ?>>Fiksi</option>
                <option value="non-fiksi" <?php echo $kategori === 'non-fiksi' ? 'selected' : ''; ?>>Non-Fiksi</option>
                <option value="referensi" <?php echo $kategori === 'referensi' ? 'selected' : ''; ?>>Referensi</option>
            </select>

            <button type="submit">Cari & Filter</button>
        </form>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Kategori</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <th>Aksi</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($daftarBuku)): ?>
                <tr>
                    <td colspan="6">Data buku tidak ditemukan.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($daftarBuku as $buku): ?>
                <tr>
                    <td><?php echo htmlspecialchars($buku['judul']); ?></td>
                    <td><?php echo htmlspecialchars($buku['pengarang']); ?></td>
                    <td><span class="badge"><?php echo htmlspecialchars(ucfirst($buku['kategori'] ?? '-')); ?></span></td>
                    <td><?php echo htmlspecialchars($buku['tahun']); ?></td>
                    <td><?php echo htmlspecialchars($buku['stok']); ?></td>
                    <?php if (isset($_SESSION['user_id'])): ?>
                    <td>
                        <a href="edit.php?id=<?php echo $buku['id']; ?>" class="btn-edit">Edit</a>
                        <form class="form-hapus" method="post" action="hapus.php" style="display:inline;">
                            <input type="hidden" name="id" value="<?php echo $buku['id']; ?>">
                            <button type="submit" class="btn-hapus">Hapus</button>
                        </form>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <nav class="pagination" style="margin-top: 1rem; display: flex; gap: 0.5rem;">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php 
                $linkParam = "?page=$i";
                if ($keyword !== '') $linkParam .= "&q=" . urlencode($keyword);
                if ($kategori !== '') $linkParam .= "&kategori=" . urlencode($kategori);
            ?>
            <a href="list.php<?php echo $linkParam; ?>" class="<?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </nav>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>