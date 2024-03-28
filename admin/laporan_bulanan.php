<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laporan Bulanan</title>
</head>
<body>
    <h1>Laporan Bulanan Transaksi</h1>
    <table border="1">
        <tr>
            <th>Bulan</th>
            <th>Total Transaksi</th>
        </tr>
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

        // Query untuk menghitung total transaksi per bulan
        $sql = "SELECT MONTH(tanggal_transaksi) AS bulan, SUM(total_harga) AS total_bulanan
                FROM tbltransactions
                GROUP BY MONTH(tanggal_transaksi)";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . date("F", mktime(0, 0, 0, $row['bulan'], 1)) . "</td>";
                echo "<td>Rp " . number_format($row['total_bulanan'], 0, ',', '.') . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='2'>Tidak ada data transaksi.</td></tr>";
        }

        // Tutup koneksi
        $conn->close();
        ?>
    </table>
    <a href="kasir.php">Kembali ke Halaman Kasir</a>
</body>
</html>
