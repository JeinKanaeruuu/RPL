<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Proses Pesanan</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 20px;
    }
    .container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1, p, ul, li {
        margin: 0;
        padding: 0;
    }
    h1 {
        text-align: center;
        color: #343a40;
        margin-bottom: 20px;
    }
    p {
        margin-bottom: 10px;
    }
    ul {
        list-style-type: none;
    }
    li {
        margin-bottom: 10px;
    }
    strong {
        font-weight: bold;
    }
    a {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #007bff;
        color: #ffffff;
        text-decoration: none;
        border-radius: 4px;
        text-align: center;
    }
    a:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
    <div class="container">
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

            echo "<p>Pesanan untuk <strong>$nama</strong>:</p>";
            echo "<ul>";
            $total_semua = 0;
            for ($i = 0; $i < count($menu); $i++) {
                $menu_data = explode('|', $menu[$i]);
                $nama_menu = $menu_data[0];
                $harga = $menu_data[1];
                $total_harga = $harga * $jumlah[$i];
                $total_semua += $total_harga;

                echo "<li>Menu: <strong>$nama_menu</strong> | Jumlah: <strong>{$jumlah[$i]}</strong> | Total Harga: Rp " . number_format($total_harga, 0, ',', '.') . "</li>";
            }
            echo "</ul>";
            echo "<p><strong>Total Pesanan: Rp " . number_format($total_semua, 0, ',', '.') . "</strong></p>";

            // Simpan data pesanan ke dalam tabel database
            $sql_insert = "INSERT INTO tbltransactions (nama_pelanggan, total_harga, tanggal_transaksi)
                           VALUES ('$nama', $total_semua, CURRENT_DATE())";

            if ($conn->query($sql_insert) === TRUE) {
                echo "<p>Data pesanan berhasil disimpan ke database.</p>";
            } else {
                echo "<p>Error: " . $sql_insert . "<br>" . $conn->error . "</p>";
            }
        }

        // Tutup koneksi
        $conn->close();
        ?>
        <a href="kasir.php">Kembali ke Halaman Kasir</a>
    </div>
</body>
</html>
