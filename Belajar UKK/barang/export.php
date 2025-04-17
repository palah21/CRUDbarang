<?php
include '../config/db.php';

// Tangkap parameter pencarian
$keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
$filter_kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data_barang.csv');

// Buka output stream
$output = fopen('php://output', 'w');

// Tulis header kolom
fputcsv($output, array('Nama Barang', 'Kategori', 'Stok', 'Harga Barang', 'Tanggal Masuk'));

// Query data
$sql = "SELECT barang.*, kategori.nama_kategori FROM barang 
        LEFT JOIN kategori ON barang.kategori_id = kategori.id
        WHERE barang.nama_barang LIKE '%$keyword%'";
if ($filter_kategori != '') {
    $sql .= " AND barang.kategori_id = $filter_kategori";
}
$result = mysqli_query($koneksi, $sql);

// Tulis data tiap baris
while ($row = mysqli_fetch_assoc($result)) {
    fputcsv($output, array(
        $row['nama_barang'],
        $row['nama_kategori'],
        $row['jumlah_stok'],
        $row['harga_barang'],
        $row['tanggal_masuk']
    ));
}

fclose($output);
exit;
?>
