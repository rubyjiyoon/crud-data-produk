<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'tambah') {
    $nama_produk = $_POST['nama_produk'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $gambar = 'gambar/' . basename($_FILES['gambar']['name']);
        move_uploaded_file($_FILES['gambar']['tmp_name'], $gambar);
    } else {
        $gambar = null;
    }

    $sql = "INSERT INTO produk (nama_produk, deskripsi, harga, stok, gambar) 
            VALUES ('$nama_produk', '$deskripsi', '$harga', '$stok', '$gambar')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Produk berhasil ditambahkan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'hapus_berhasil') {
            echo "<p style='color: green;'>Produk berhasil dihapus.</p>";
        } elseif ($_GET['status'] == 'hapus_gagal') {
            echo "<p style='color: red;'>Gagal menghapus produk.</p>";
        }
    }
}
$sql = "SELECT * FROM produk";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk Toko</title>
    <link rel="stylesheet" href="index.css">
    <script type="text/javascript">
        function confirmDelete(url) {
            if (confirm("Apakah Anda ingin menghapus produk ini?")) {
                window.location.href = url;
            }
        }
    </script>
</head>
<body>
    <h1>Daftar Produk Toko</h1>
    <h2>Tambah Produk Baru</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="tambah">
        <label for="nama_produk">Nama Produk:</label>
        <input type="text" name="nama_produk" required><br>
        
        <label for="deskripsi">Deskripsi:</label>
        <textarea name="deskripsi"></textarea><br>
        
        <label for="harga">Harga:</label>
        <input type="number" step="0.01" name="harga" required><br>
        
        <label for="stok">Stok:</label>
        <input type="number" name="stok" required><br>
        
        <label for="gambar">Gambar:</label>
        <input type="file" name="gambar"><br>
        
        <button type="submit">Tambah Produk</button>
    </form>

    <h2>Daftar Produk</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama Produk</th>
            <th>Deskripsi</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Gambar</th>
            <th>Aksi</th>
        </tr>

        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['nama_produk'] . "</td>
                    <td>" . $row['deskripsi'] . "</td>
                    <td>" . $row['harga'] . "</td>
                    <td>" . $row['stok'] . "</td>
                    <td><img src='" . $row['gambar'] . "' width='50'></td>
                    <td>
                        <a href='edit_produk.php?id=" . $row['id'] . "'>Edit</a> | 
                        <a href='hapus_produk.php?id=" . $row['id'] . "'>Hapus</a>
                    </td>
                </tr>";
        }
        ?>
    </table>
</body>
</html>
