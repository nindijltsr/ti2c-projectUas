<?php
session_start();

include 'koneksiDB.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Anda harus login terlebih dahulu.');
        window.location = 'halamanDaftar.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$promoCode = $_POST['promo_code'] ?? null;
if ($promoCode) {
    $_SESSION['promo_code'] = $promoCode;
}

$discount_rate = 0;

// Tentukan diskon berdasarkan kode promo
if (isset($_SESSION['promo_code'])) {
    $promoCode = $_SESSION['promo_code'];
    if ($promoCode === 'DISC25') {
        $_SESSION['discount'] = 0.25;
    } elseif ($promoCode === 'DISC50') {
        $_SESSION['discount'] = 0.50;
    } elseif ($promoCode === 'DISC75') {
        $_SESSION['discount'] = 0.75;
    } elseif ($promoCode === 'DISC90') {
        $_SESSION['discount'] = 0.90;
    } else {
        $_SESSION['discount'] = 0;
    }
}



// Simpan pesanan ke database
if (isset($_POST['place_order'])) {
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        $order_id = uniqid();
        $stmt = $conn->prepare("INSERT INTO orders (order_id, user_id, item_name, item_price, quantity, discount, promo_code, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");


        $discount_rate = $_SESSION['discount'] ?? 0; // Ambil diskon dari session

        foreach ($_SESSION['cart'] as $item) {
            $item_price_original = $item['price'];
            $item_price_with_discount = $item['price'] * (1 - $discount_rate);
            $promo_code = $_SESSION['promo_code'] ?? '';
            $stmt->bind_param("sisddss", $order_id, $user_id, $item['name'], $item_price_original, $item['quantity'], $discount_rate, $promo_code);

            $stmt->execute();
        }

        $stmt->close();
        unset($_SESSION['cart']);

        $_SESSION['discount'] = $discount_rate; // Set the discount rate here
        echo "<script>alert('Order placed successfully');
        window.location = 'invoice.php';</script>";
        unset($_SESSION['discount']); // Bersihkan diskon setelah pesanan disimpan
        unset($_SESSION['promo_code']); // Bersihkan kode promo setelah pesanan disimpan
        header("Location: invoice.php");
        exit();
    }
}



// Tambahkan item ke keranjang
if (isset($_GET['action']) && $_GET['action'] == 'add') {
    $name = urldecode($_GET['name']);
    $price = $_GET['price'];
    $quantity = isset($_GET['quantity']) ? intval($_GET['quantity']) : 1;

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (!isset($_SESSION['cart'][$name])) {
        $_SESSION['cart'][$name] = ['name' => $name, 'price' => $price, 'quantity' => $quantity];
    } else {
        $_SESSION['cart'][$name]['quantity'] += $quantity;
    }

    header('Location: keranjang.php');
    exit;
}

// Hapus item dari keranjang
if (isset($_GET['action']) && $_GET['action'] == 'remove') {
    $name = $_GET['name'];
    unset($_SESSION['cart'][$name]);
    header('Location: keranjang.php');
    exit;
}

// Kurangi jumlah item di keranjang
if (isset($_GET['action']) && $_GET['action'] == 'decrease') {
    $name = $_GET['name'];
    if (isset($_SESSION['cart'][$name])) {
        $_SESSION['cart'][$name]['quantity']--;
        if ($_SESSION['cart'][$name]['quantity'] <= 0) {
            unset($_SESSION['cart'][$name]);
        }
    }
    header('Location: keranjang.php');
    exit;
}

// Hapus semua item di keranjang
if (isset($_GET['action']) && $_GET['action'] == 'clear') {
    unset($_SESSION['cart']);
    header('Location: keranjang.php');
    exit;
}

// Terapkan kode promo
if (isset($_GET['action']) && $_GET['action'] == 'apply_promo') {
    $promo_code = $_GET['promo_code'];
    $stmt = $conn->prepare("SELECT discount_rate FROM promo WHERE kode_promo = ?");
    $stmt->bind_param("s", $promo_code);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $promo_row = $result->fetch_assoc();
        $_SESSION['discount'] = $promo_row['discount_rate'];
    } else {
        $_SESSION['discount'] = 0;
    }
    $stmt->close();
    header('Location: keranjang.php');
    exit;
}

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
    <title>Order Summary</title>
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">

    <?php include '../assets-templates/header.php'; ?>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            height: 100vh;

        }

        .container {
            display: flex;
            justify-content: space-between;
            padding-top: 30px;
            padding: 50px;
            background-color: white;
            margin: 20px auto;
            width: 80%;
            border: 1px solid #ddd;
        }

        .order-summary,
        .order-action {
            width: 45%;
        }

        .order-summary h2 {
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .order-summary .item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .order-summary .summary {
            padding: 10px 0;
        }

        .order-summary .summary .total {
            display: flex;
            justify-content: space-between;
            padding: 5px 0;
            font-weight: bold;
            color: #d40000;
        }

        .order-action {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            justify-content: space-between;
        }

        .order-action input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
        }

        .order-action .total-amount {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-top: 10px;
        }

        .button-group a.btn,
        .button-group button {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #d40000;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 5px;
            width: auto;
            white-space: nowrap;
            text-decoration: none;
            margin-right: 10px;
        }

        .button-group a.btn:last-child,
        .button-group button:last-child {
            margin-right: 0;
        }

        #cancel-order {
            background-color: #d40000;
        }

        .alert {
            position: fixed;
            top: 50px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: none;
            animation: slideIn 0.5s ease-in-out forwards;
        }

        .alert.show {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="order-summary">
            <h2>Ringkasan Pesanan</h2>
            <div class="item">
                <span>Nama Pesanan</span>
                <span>Jumlah</span>
                <span>Total</span>
            </div>
            <?php
            $totalPrice = 0; // Initialize total price outside the conditional block

            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) :
                $discount_rate = $_SESSION['discount'] ?? 0;

                foreach ($_SESSION['cart'] as $item) :
            ?>
                    <div class="item">
                        <span><?= $item['name']; ?></span>
                        <span>
                            <a href="keranjang.php?action=decrease&name=<?= urlencode($item['name']); ?>">-</a>
                            <?= $item['quantity']; ?>
                            <a href="keranjang.php?action=add&name=<?= urlencode($item['name']); ?>&price=<?= $item['price']; ?>">+</a>
                        </span>
                        <span><?= formatRupiah($item['price'] * $item['quantity']); ?></span>

                        <?php
                        $item_price_with_discount = $item['price'] * (1 - $discount_rate);

                        $totalPrice += $item_price_with_discount * $item['quantity'];
                        ?>
                    </div>
                <?php endforeach; ?>

                <div class="summary">
                    <div class="total">
                        <span>Total</span>
                        <span><?= formatRupiah($totalPrice); ?></span>
                    </div>
                </div>
            <?php else : ?>
                <p>Keranjang kosong</p>
            <?php endif; ?>

        </div>
        <div class="order-action">
            <input type="text" name="promo_code" placeholder="Masukkan Kupon/Kode Promo">
            <button id="apply-promo">Terapkan Kode Promo</button>
            <div class="total-amount" data-total-price="<?= $totalPrice; ?>">Total: <?= formatRupiah($totalPrice); ?></div>
            <form method="post" action="keranjang.php">
                <div class="button-group">
                    <a href="listMakanan.php" id="cancel-order" class="btn btn-danger">Tambah Pesanan</a>
                    <button type="submit" name="place_order" id="place-order" class="btn btn-danger">Pesan Sekarang</button>
                    <a href="keranjang.php?action=clear" id="cancel-order" class="btn btn-danger">Batal</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var applyPromoButton = document.querySelector('#apply-promo');
            applyPromoButton.addEventListener('click', function() {
                var promoCode = document.querySelector('input[name="promo_code"]').value.trim();
                if (promoCode) {
                    var form = document.createElement('form');
                    form.method = 'post';
                    form.action = 'keranjang.php';
                    var input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'promo_code';
                    input.value = promoCode;
                    form.appendChild(input);
                    document.body.appendChild(form);
                    form.submit();
                } else {
                    alert('Kode promo tidak valid!');
                }
            });

            function applyPromo(discountRate) {
                var totalPriceElement = document.querySelector('.total-amount');
                var totalPrice = parseFloat(totalPriceElement.dataset.totalPrice);
                var discount = totalPrice * discountRate;
                var discountedPrice = totalPrice - discount;
                totalPriceElement.textContent = 'Total: ' + formatRupiah(discountedPrice);
            }

            function formatRupiah(number) {
                return 'Rp ' + number.toLocaleString('id-ID');
            }
        });
    </script>
    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
<?php include '../assets-templates/footer.php'; ?>

</html>