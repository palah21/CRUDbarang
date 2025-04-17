<?php 
include '../config/db.php';
include '../navbar.php';

// -- Proses Pencarian & Filter --
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$filter_kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

// Pagination
$limit = 5; // jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Hitung total data
$countQuery = "SELECT COUNT(*) as total FROM barang 
               WHERE nama_barang LIKE '%$keyword%'";
if ($filter_kategori != '') {
    $countQuery .= " AND kategori_id = $filter_kategori";
}
$countResult = mysqli_query($koneksi, $countQuery);
$totalData = mysqli_fetch_assoc($countResult)['total'];
$totalPages = ceil($totalData / $limit);

// Ambil data barang dengan limit
$sql = "SELECT barang.*, kategori.nama_kategori FROM barang 
        LEFT JOIN kategori ON barang.kategori_id = kategori.id
        WHERE barang.nama_barang LIKE '%$keyword%'";
if ($filter_kategori != '') {
    $sql .= " AND barang.kategori_id = $filter_kategori";
}
$sql .= " ORDER BY barang.id DESC LIMIT $limit OFFSET $offset";
$result = mysqli_query($koneksi, $sql);

// Ambil data kategori untuk filter dropdown
$kategori_result = mysqli_query($koneksi, "SELECT * FROM kategori");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Data Barang</title>
  <link rel="stylesheet" href="../assets/bootstrap.min.css">
</head>
<body>
<div class="container">
  <h2>Data Barang</h2>
  
  <!-- Notifikasi CRUD -->
  <?php if (isset($_GET['pesan'])): ?>
    <div class="alert alert-success">
      <?= $_GET['pesan'] ?>
    </div>
  <?php endif; ?>
  
  <!-- Form Pencarian & Filter -->
  <form method="get" class="row g-3 mb-3">
    <div class="col-md-4">
      <input type="text" name="keyword" class="form-control" placeholder="Cari nama barang..." value="<?= $keyword ?>">
    </div>
    <div class="col-md-4">
      <select name="kategori" class="form-select">
        <option value="">-- Semua Kategori --</option>
        <?php while ($row = mysqli_fetch_assoc($kategori_result)) { ?>
          <option value="<?= $row['id'] ?>" <?= ($row['id'] == $filter_kategori) ? 'selected' : '' ?>>
            <?= $row['nama_kategori'] ?>
          </option>
        <?php } ?>
      </select>
    </div>
    <div class="col-md-4">
      <button type="submit" class="btn btn-primary">Cari</button>
      <a href="tambah.php" class="btn btn-success">+ Tambah Barang</a>
      <a href="export.php?keyword=<?= $keyword ?>&kategori=<?= $filter_kategori ?>" class="btn btn-info">Export Data</a>
    </div>
  </form>
  
  <!-- Tabel Data Barang -->
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Stok</th>
        <th>Harga</th>
        <th>Tanggal Masuk</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($barang = mysqli_fetch_assoc($result)) { ?>
        <tr>
          <td><?= $barang['nama_barang'] ?></td>
          <td><?= $barang['nama_kategori'] ?></td>
          <td><?= $barang['jumlah_stok'] ?></td>
          <td>Rp<?= number_format($barang['harga_barang'],0,',','.') ?></td>
          <td><?= $barang['tanggal_masuk'] ?></td>
          <td>
            <a href="edit.php?id=<?= $barang['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="hapus.php?id=<?= $barang['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')">Hapus</a>
          </td>
        </tr>
      <?php } ?>
    </tbody>
  </table>
  
  <!-- Pagination -->
  <nav>
    <ul class="pagination">
      <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
      <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
        <a class="page-link" href="?keyword=<?= $keyword ?>&kategori=<?= $filter_kategori ?>&page=<?= $i ?>"><?= $i ?></a>
      </li>
      <?php endfor; ?>
    </ul>
  </nav>
</div>
</body>
</html>
