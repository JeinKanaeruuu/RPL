<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Laporan Bulanan</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 20px;
    }
    h1 {
        text-align: center;
        color: #343a40;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    th, td {
        border: 1px solid #dee2e6;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #007bff;
        color: #ffffff;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #e2e6ea;
    }
    a {
        display: block;
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
    <h1>Laporan Bulanan Transaksi</h1>
    <table>
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
    <a href="javascript:window.print()">Cetak Laporan ke PDF</a>
    <a href="kasir.php">Kembali ke Halaman Kasir</a>
</body>
</html>
