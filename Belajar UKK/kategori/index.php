<?php 
include '../config/db.php';
include '../navbar.php';

$result = mysqli_query($koneksi, "SELECT * FROM kategori");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Data Kategori</title>
  <link rel="stylesheet" href="../assets/bootstrap.min.css">
</head>
<body>
<div class="container">
  <h2>Data Kategori Barang</h2>
  
  <!-- Notifikasi -->
  <?php if (isset($_GET['pesan'])): ?>
    <div class="alert alert-success">
      <?= $_GET['pesan'] ?>
    </div>
  <?php endif; ?>
  
  <a href="tambah.php" class="btn btn-success mb-3">+ Tambah Kategori</a>
  <a href="../barang/index.php" class="btn btn-secondary mb-3">Kembali</a>

  
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama Kategori</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($kategori = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?= $kategori['id'] ?></td>
          <td><?= $kategori['nama_kategori'] ?></td>
          <td>
            <a href="edit.php?id=<?= $kategori['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="hapus.php?id=<?= $kategori['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus kategori ini?')">Hapus</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
</body>
</html>
