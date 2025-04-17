<?php
include '../config/db.php';
include '../navbar.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';
if (empty($id)) {
    die("ID tidak ditemukan.");
}

$query = "SELECT * FROM kategori WHERE id = $id";
$result = mysqli_query($koneksi, $query);
if (mysqli_num_rows($result) == 0) {
    die("Data kategori tidak ditemukan.");
}
$data = mysqli_fetch_assoc($result);

$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_kategori = trim($_POST['nama_kategori']);
    
    if (empty($nama_kategori)) {
        $errors[] = "Nama kategori tidak boleh kosong.";
    }
    
    if (empty($errors)) {
        $updateQuery = "UPDATE kategori SET nama_kategori = '$nama_kategori' WHERE id = $id";
        if (mysqli_query($koneksi, $updateQuery)) {
            header("Location: index.php?pesan=Kategori berhasil diperbarui");
            exit;
        } else {
            $errors[] = "Gagal memperbarui data: " . mysqli_error($koneksi);
        }
    }
} else {
    $nama_kategori = $data['nama_kategori'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Edit Kategori</title>
  <link rel="stylesheet" href="../assets/bootstrap.min.css">
</head>
<body>
<div class="container">
  <h2>Edit Kategori Barang</h2>
  
  <?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
      <ul>
      <?php foreach ($errors as $error): ?>
        <li><?= $error ?></li>
      <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>
  
  <form method="post">
    <div class="mb-3">
      <label>Nama Kategori</label>
      <input type="text" name="nama_kategori" class="form-control" value="<?= $nama_kategori ?>">
    </div>
    <button type="submit" class="btn btn-success">Perbarui</button>
    <a href="index.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
