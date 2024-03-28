<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Check Seat Availability</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- CSS styling for seat indicators -->
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    h1 {
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #f2f2f2;
    }
    .empty-seat {
        background-color: #28a745; /* green */
        color: white;
    }
    .occupied-seat {
        background-color: #dc3545; /* red */
        color: white;
    }
  </style>
</head>
<body>
    <div class="container">
        <h1>Check Seat Availability</h1>
        <p>Select available seats:</p>
        <!-- Table untuk menampilkan data meja -->
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th scope="col">Table Number</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database Connection
                include('admin/includes/config.php');
                session_start();
                error_reporting(0);

                if(strlen($_SESSION['aid']) == 0) { 
                    header('location:index.php');
                } else {
                    // Query untuk mengambil data meja dari database
                    $query = "SELECT * FROM tblrestables";
                    $result = mysqli_query($con, $query);
                }

                // Tampilkan pesan jika tidak ada meja yang ditemukan
                if(mysqli_num_rows($result) == 0) {
                    echo "<tr><td colspan='2'>Tidak ada meja yang tersedia.</td></tr>";
                } else {
                    // Loop through each row of table data
                    while($row = mysqli_fetch_assoc($result)) {
                        $seatStatus = $row['status']; // Ambil status meja dari database
                        $seatStatusClass = ($seatStatus == 'occupied') ? 'occupied-seat' : 'empty-seat';
                        echo "<tr>";
                        echo "<td>" . $row['tableNumber'] . "</td>";
                        echo "<td class='$seatStatusClass'>" . $seatStatus . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
