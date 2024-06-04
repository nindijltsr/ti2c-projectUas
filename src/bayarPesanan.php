<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Anda harus login terlebih dahulu.");
}

include 'koneksiDB.php';

$user_id = $_SESSION['user_id'];

// Pastikan ada parameter order_id yang dikirimkan
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Perbarui status pesanan menjadi 'lunas' di database
    $sql_update_status = "UPDATE orders SET status = 'lunas' WHERE order_id = '$order_id'";
    // Tampilkan alert jika pembayaran selesai dilakukan
    if ($conn->query($sql_update_status) === TRUE) {
        echo "<script>
                alert('Pembayaran selesai dilakukan.');
                window.location.href = 'riwayatPesanan.php';
            </script>";
    } else {
        echo "<script>
                alert('Gagal melakukan pembayaran.');
                window.location.href = 'riwayatPesanan.php';
            </script>";
    }
} else {
    echo "Order ID tidak ditemukan.";
}
