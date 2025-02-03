<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'edit') {
    $id = $_POST['id'];
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $gambar = 'gambar/' . basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $gambar);
    } else {
        $gambar = $_POST['gambar_lama'];
    }

    $sql = "UPDATE produk SET nama_produk='$nama_produk', deskripsi='$deskripsi', harga='$harga', stok='$stok', gambar='$gambar' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Produk berhasil diperbarui!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM produk WHERE id = $id";
$result = $conn->query($sql);
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>

    <h1>Edit Produk</h1>

    <h2>Form Edit Produk</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="edit">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <input type="hidden" name="gambar_lama" value="<?php echo $product['gambar']; ?>">

        <label for="nama_produk">Nama Produk:</label>
        <input type="text" name="nama_produk" value="<?php echo $product['nama_produk']; ?>" required><br>
        
        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi"><?php echo $product['deskripsi']; ?></textarea><br>
        
        <label for="harga">Harga:</label>
        <input type="number" step="0.01" name="harga" value="<?php echo $product['harga']; ?>" required><br>
        
        <label for="stok">Stok:</label>
        <input type="number" name="stok" value="<?php echo $product['stok']; ?>" required><br>
        
        <label for="gambar">Gambar Baru (Opsional):</label>
        <input type="file" name="gambar"><br>
        
        <label for="gambar_lama">Gambar Lama:</label>
        <img src="<?php echo $product['gambar']; ?>" width="100"><br>
        
        <button type="submit">Edit Produk</button>
        <button type="submit" name="back_to_index" value="true">Kembali ke Daftar Produk</button>
    </form>
    <?php
    if (isset($_POST['back_to_index']) && $_POST['back_to_index'] == 'true') {
        header("Location: index.php"); 
        exit();
    }
    ?>
</body>
</html>
