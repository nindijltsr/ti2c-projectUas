<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Anda harus login terlebih dahulu.");
}

include 'koneksiDB.php';

// cek status id dan order id
if (isset($_GET['status']) && isset($_GET['order_id'])) {
    $status = $_GET['status'];
    $order_id = $_GET['order_id'];
    $user_id = $_SESSION['user_id'];

    if ($status === 'pending') {
        $sql_update_status = "UPDATE orders SET status = 'pending' WHERE order_id = '$order_id' AND user_id = '$user_id'";
        $conn->query($sql_update_status);
    } elseif ($status === 'lunas') {
        $sql_update_status = "UPDATE orders SET status = 'lunas' WHERE order_id = '$order_id' AND user_id = '$user_id'";
        $conn->query($sql_update_status);
    }
}

//Get pesanan dari tabel orders
$user_id = $_SESSION['user_id'];
$sql = "SELECT order_id, item_name, item_price, quantity, order_date, status
        FROM orders 
        WHERE user_id = '$user_id' 
        ORDER BY order_id DESC, order_date DESC";
$result = $conn->query($sql);


function formatRupiah($number)
{
    return 'Rp ' . number_format($number, 2, ',', '.');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pesanan</title>
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">

    <?php include '../assets-templates/header.php'; ?>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #d40000;
            color: white;
            padding: 10px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        header .logo {
            font-size: 20px;
            font-weight: bold;
        }

        header nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        header nav ul li {
            margin: 0 10px;
        }

        header nav ul li a {
            color: white;
            text-decoration: none;
        }

        .container {
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border: 1px solid #ddd;
            width: 80%;
        }

        .order-history h2 {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .order-history table {
            width: 100%;
            border-collapse: collapse;
        }

        .order-history table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        .order-history th {
            background-color: #f7f7f7;
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="container order-history">
        <h2>Riwayat Pesanan</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Nama Pesanan</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Tanggal Pesanan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) :
                    $current_order_id = null;
                    while ($row = $result->fetch_assoc()) :
                        if ($row['order_id'] !== $current_order_id) :
                            $current_order_id = $row['order_id'];
                ?>
                            <tr>
                                <td><?= $row['order_id']; ?></td>
                                <td><?= $row['item_name']; ?></td>
                                <td><?= formatRupiah($row['item_price']); ?></td>
                                <td><?= $row['quantity']; ?></td>
                                <td><?= $row['order_date']; ?></td>
                                <td>
                                    <?php
                                    if ($row['status'] == 'pending') {
                                        echo '<a href="bayarPesanan.php?order_id=' . $row['order_id'] . '">Bayar</a>';
                                    } elseif ($row['status'] == 'lunas') {
                                        echo 'Selesai';
                                    } else {
                                        echo 'Unknown';
                                    }
                                    
                                    ?>
                                </td>

                            </tr>
                        <?php else : ?>
                            <tr>
                                <td></td>
                                <td><?= $row['item_name']; ?></td>
                                <td><?= formatRupiah($row['item_price']); ?></td>
                                <td><?= $row['quantity']; ?></td>
                                <td><?= $row['order_date']; ?></td>
                                <td></td>
                            </tr>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6">Belum ada pesanan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <?php include '../assets-templates/footer.php'; ?>

    <script>
    function bayar(order_id) {
        // Kirim permintaan asinkron ke bayar.php dengan menggunakan AJAX
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Perbarui status pembayaran di baris yang sesuai dengan order_id
                var statusCell = document.getElementById('status_' + order_id);
                if (statusCell) {
                    statusCell.innerHTML = xhr.responseText;
                }
            }
        };
        xhr.open("GET", "bayar.php?order_id=" + order_id, true);
        xhr.send();
    }
</script>

</body>

</html>