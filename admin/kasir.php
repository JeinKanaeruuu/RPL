<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Kasir Restaurant</title>
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
    a {
        display: inline-block;
        margin: 10px 0;
        color: #007bff;
        text-decoration: none;
    }
    a:hover {
        text-decoration: underline;
    }
    form {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    label {
        display: block;
        margin-bottom: 5px;
        color: #495057;
    }
    input[type="text"], select, input[type="number"] {
        width: calc(100% - 22px);
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }
    .pesananItem {
        border-top: 1px solid #ced4da;
        padding-top: 10px;
        margin-top: 10px;
    }
    button {
        padding: 5px 10px;
        margin: 5px 0;
        border: none;
        border-radius: 4px;
        background-color: #007bff;
        color: #ffffff;
        cursor: pointer;
    }
    button:hover {
        background-color: #0056b3;
    }
    .btn-remove {
        background-color: #dc3545;
    }
    .btn-remove:hover {
        background-color: #c82333;
    }
</style>
</head>
<body>
    <a href="dashboard.php">Dashboard</a>
    <a href="laporan_bulanan.php">Laporan Bulanan</a>
    <h1>Kasir Restaurant</h1>
    <form id="pesananForm" action="proses_pesanan.php" method="post">
        <label for="nama">Nama Pelanggan:</label>
        <input type="text" id="nama" name="nama"><br><br>

        <div id="pesananContainer">
            <div class="pesananItem">
                <label for="menu1">Menu:</label>
                <select id="menu1" name="menu[]" class="menu">
                    <option value="Nasi Goreng|15000">Nasi Goreng - Rp 15,000</option>
                    <option value="Mie Ayam|12000">Mie Ayam - Rp 12,000</option>
                    <option value="Soto Ayam|18000">Soto Ayam - Rp 18,000</option>
                    <!-- Tambahkan menu lainnya sesuai kebutuhan -->
                </select>
                <label for="jumlah1">Jumlah:</label>
                <button type="button" onclick="kurangi(1)">-</button>
                <input type="number" id="jumlah1" name="jumlah[]" value="1">
                <button type="button" onclick="tambah(1)">+</button>
                <button type="button" class="btn-remove" onclick="hapus(1)">Hapus</button><br><br>
            </div>
        </div>

        <button type="button" onclick="tambahPesanan()">Tambah Menu</button><br><br>

        <input type="submit" value="Proses Pesanan">
    </form>

    <script>
        let pesananCount = 1;

        function tambahPesanan() {
            pesananCount++;
            const container = document.getElementById('pesananContainer');
            const newDiv = document.createElement('div');
            newDiv.className = 'pesananItem';
            newDiv.innerHTML = `
                <label for="menu${pesananCount}">Menu:</label>
                <select id="menu${pesananCount}" name="menu[]" class="menu">
                    <option value="Nasi Goreng|15000">Nasi Goreng - Rp 15,000</option>
                    <option value="Mie Ayam|12000">Mie Ayam - Rp 12,000</option>
                    <option value="Soto Ayam|18000">Soto Ayam - Rp 18,000</option>
                    <!-- Tambahkan menu lainnya sesuai kebutuhan -->
                </select>
                <label for="jumlah${pesananCount}">Jumlah:</label>
                <button type="button" onclick="kurangi(${pesananCount})">-</button>
                <input type="number" id="jumlah${pesananCount}" name="jumlah[]" value="1">
                <button type="button" onclick="tambah(${pesananCount})">+</button>
                <button type="button" class="btn-remove" onclick="hapus(${pesananCount})">Hapus</button><br><br>
            `;
            container.appendChild(newDiv);
        }

        function tambah(index) {
            const inputJumlah = document.getElementById('jumlah' + index);
            inputJumlah.value++;
        }

        function kurangi(index) {
            const inputJumlah = document.getElementById('jumlah' + index);
            if (inputJumlah.value > 1) {
                inputJumlah.value--;
            }
        }

        function hapus(index) {
            const itemToRemove = document.querySelector('.pesananItem:nth-child(' + (index + 1) + ')');
            itemToRemove.parentNode.removeChild(itemToRemove);
        }
    </script>
</body>
</html>
