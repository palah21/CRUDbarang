<?php
include '../config/db.php';
include '../navbar.php';

// Ambil data kategori untuk dropdown
$kategori_result = mysqli_query($koneksi, "SELECT * FROM kategori");

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_barang   = trim($_POST['nama_barang']);
    $kategori_id   = $_POST['kategori_id'];
    $jumlah_stok   = $_POST['jumlah_stok'];
    $harga_barang  = $_POST['harga_barang'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    
    // Validasi input
    if (empty($nama_barang)) {
        $errors[] = "Nama barang tidak boleh kosong.";
    }
    if (!is_numeric($jumlah_stok) || $jumlah_stok < 0) {
        $errors[] = "Jumlah stok harus berupa angka positif.";
    }
    if (!is_numeric($harga_barang) || $harga_barang < 0) {
        $errors[] = "Harga barang harus berupa angka positif.";
    }
    
    // Insert data jika validasi lolos
    if (empty($errors)) {
        $query = "INSERT INTO barang (nama_barang, kategori_id, jumlah_stok, harga_barang, tanggal_masuk)
                  VALUES ('$nama_barang', '$kategori_id', '$jumlah_stok', '$harga_barang', '$tanggal_masuk')";
        if (mysqli_query($koneksi, $query)) {
            header("Location: index.php?pesan=Data barang berhasil ditambahkan");
            exit;
        } else {
            $errors[] = "Gagal menyimpan data: " . mysqli_error($koneksi);
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Tambah Barang</title>
  <link rel="stylesheet" href="../assets/bootstrap.min.css">
</head>
<body>
<div class="container">
  <h2>Tambah Barang</h2>
  
  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
      <ul>
      <?php foreach($errors as $error): ?>
        <li><?= $error ?></li>
      <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>
  
  <form method="post">
    <div class="mb-3">
      <label>Nama Barang</label>
      <input type="text" name="nama_barang" class="form-control" value="<?= isset($nama_barang) ? $nama_barang : '' ?>">
    </div>
    <div class="mb-3">
      <label>Kategori</label>
      <select name="kategori_id" class="form-select">
        <?php while ($row = mysqli_fetch_assoc($kategori_result)) { ?>
          <option value="<?= $row['id'] ?>" <?= (isset($kategori_id) && $kategori_id == $row['id']) ? 'selected' : '' ?>>
            <?= $row['nama_kategori'] ?>
          </option>
        <?php } ?>
      </select>
    </div>
    <div class="mb-3">
      <label>Jumlah Stok</label>
      <input type="number" name="jumlah_stok" class="form-control" value="<?= isset($jumlah_stok) ? $jumlah_stok : '' ?>">
    </div>
    <div class="mb-3">
      <label>Harga Barang</label>
      <input type="number" step="0.01" name="harga_barang" class="form-control" value="<?= isset($harga_barang) ? $harga_barang : '' ?>">
    </div>
    <div class="mb-3">
      <label>Tanggal Masuk</label>
      <input type="date" name="tanggal_masuk" class="form-control" value="<?= isset($tanggal_masuk) ? $tanggal_masuk : '' ?>">
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
    <a href="../kategori/tambah.php" class="btn btn-info">+ Tambah kategori</a>

  </form>
</div>
</body>
</html>
