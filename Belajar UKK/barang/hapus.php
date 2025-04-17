<?php
include '../config/db.php';

$id = isset($_GET['id']) ? $_GET['id'] : '';
if (empty($id)) {
    die("ID tidak ditemukan.");
}

$query = "DELETE FROM barang WHERE id = $id";
if (mysqli_query($koneksi, $query)) {
    header("Location: index.php?pesan=Data barang berhasil dihapus");
    exit;
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>
