<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Proses Pesanan</title>
</head>
<body>
    <h1>Pesanan Diterima</h1>
    <?php
    // Koneksi ke database (sesuaikan dengan pengaturan database Anda)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "rtbsdb";

    // Buat koneksi
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nama = $_POST['nama'];
        $menu = $_POST['menu'];
        $jumlah = $_POST['jumlah'];

        echo "<p>Pesanan untuk $nama:</p>";
        echo "<ul>";
        $total_semua = 0;
        for ($i = 0; $i < count($menu); $i++) {
            $menu_data = explode('|', $menu[$i]);
            $nama_menu = $menu_data[0];
            $harga = $menu_data[1];
            $total_harga = $harga * $jumlah[$i];
            $total_semua += $total_harga;

            echo "<li>Menu: $nama_menu | Jumlah: {$jumlah[$i]} | Total Harga: Rp " . number_format($total_harga, 0, ',', '.') . "</li>";
        }
        echo "</ul>";
        echo "<p><strong>Total Pesanan: Rp " . number_format($total_semua, 0, ',', '.') . "</strong></p>";

        // Simpan data pesanan ke dalam tabel database
        $sql_insert = "INSERT INTO tbltransactions (nama_pelanggan, total_harga, tanggal_transaksi)
                       VALUES ('$nama', $total_semua, CURRENT_DATE())";

        if ($conn->query($sql_insert) === TRUE) {
            echo "Data pesanan berhasil disimpan ke database.";
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }

    // Tutup koneksi
    $conn->close();
    ?>
    <a href="kasir.php">Kembali ke Halaman Kasir</a>
</body>
</html>
