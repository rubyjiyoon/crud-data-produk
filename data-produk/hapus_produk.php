<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM produk WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?status=hapus_berhasil");
        exit();
    } else {
        header("Location: index.php?status=hapus_gagal");
        exit();
    }
}
?>
