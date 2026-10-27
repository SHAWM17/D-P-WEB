<?php
$page_title = "Daftar Anggota";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$daftarAnggota = $_SESSION['anggota'] ?? [];
?>
<section>
    <h2>Daftar Anggota</h2>
    <?php if ($flash): ?>
        <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
    <?php endif; ?>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>NIM/ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php if (empty($daftarAnggota)): ?>
                <tr>
                    <td colspan="4">Belum ada data anggota. Silakan tambah lewat menu "Tambah Anggota".</td>
                </tr>
            <?php else: ?>
                <?php foreach ($daftarAnggota as $anggota): ?>
                <tr>
                    <td><?php echo htmlspecialchars($anggota['nim']); ?></td>
                    <td><?php echo htmlspecialchars($anggota['nama']); ?></td>
                    <td><?php echo htmlspecialchars($anggota['email']); ?></td>
                    <td>
                        <button type="button">Edit</button>
                        <button type="button" class="btn-hapus">Hapus</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>
<?php include __DIR__ . '/../includes/footer.php'; ?>