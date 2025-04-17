<?php
include '../config/db.php';
include '../navbar.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_kategori = trim($_POST['nama_kategori']);
    
    if (empty($nama_kategori)) {
        $errors[] = "Nama kategori tidak boleh kosong.";
    }
    
    if (empty($errors)) {
        $query = "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')";
        if (mysqli_query($koneksi, $query)) {
            header("Location: index.php?pesan=Kategori berhasil ditambahkan");
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
  <title>Tambah Kategori</title>
  <link rel="stylesheet" href="../assets/bootstrap.min.css">
</head>
<body>
<div class="container">
  <h2>Tambah Kategori Barang</h2>
  
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
      <label>Nama Kategori</label>
      <input type="text" name="nama_kategori" class="form-control" value="<?= isset($nama_kategori) ? $nama_kategori : '' ?>">
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
