<?php
session_start();

$makananRingan = [
    [
        "name" => "Cireng",
        "price" => 5000,
        "image" => "../assets-templates/img/makanan/makananRingan/cireng isi.jpg",
    ],
    [
        "name" => "Dimsum",
        "price" => 10000,
        "image" => "../assets-templates/img/makanan/makananRingan/dimsum.jpg",
    ],
    [
        "name" => "Bakwan Sayur",
        "price" => 2000,
        "image" => "../assets-templates/img/makanan/makananRingan/heci.jpg",
    ],
    [
        "name" => "Kentang Goreng",
        "price" => 12000,
        "image" => "../assets-templates/img/makanan/makananRingan/kentanggoreng.jpg",
    ],
    [
        "name" => "Risol Mayo",
        "price" => 7000,
        "image" => "../assets-templates/img/makanan/makananRingan/risol mayo.jpg",
    ],
    [
        "name" => "Samose",
        "price" => 8000,
        "image" => "../assets-templates/img/makanan/makananRingan/samose❤️.jpg",
    ],
    [
        "name" => "Tahu Isi",
        "price" => 5000,
        "image" => "../assets-templates/img/makanan/makananRingan/tahu isi.jpg",
    ],
    [
        "name" => "Tempe Goreng",
        "price" => 5000,
        "image" => "../assets-templates/img/makanan/makananRingan/tempe goreng.jpg",
    ],
];

$makananUtama = [
    [
        "name" => "Nasi Goreng",
        "price" => 12000,
        "image" => "../assets-templates/img/makanan/makananBerat/nasgor.jpg",
    ],
    [
        "name" => "Mie Goreng",
        "price" => 14000,
        "image" => "../assets-templates/img/makanan/makananBerat/miegoreng.jpg",
    ],
    [
        "name" => "Bakso",
        "price" => 12000,
        "image" => "../assets-templates/img/makanan/makananBerat/bakso.jpg",
    ],
    [
        "name" => "Soto Kudus",
        "price" => 15000,
        "image" => "../assets-templates/img/makanan/makananBerat/soto.jpg",
    ],
    [
        "name" => "Rawon",
        "price" => 15000,
        "image" => "../assets-templates/img/makanan/makananBerat/rawon.jpg",
    ],
    [
        "name" => "Ayam Goreng",
        "price" => 11000,
        "image" => "../assets-templates/img/makanan/makananBerat/ayamgoreng.jpg",
    ],
    [
        "name" => "Ayam Bakar",
        "price" => 15000,
        "image" => "../assets-templates/img/makanan/makananBerat/ayambakar.jpg",
    ],
    [
        "name" => "Ayam Geprek",
        "price" => 10000,
        "image" => "../assets-templates/img/makanan/makananBerat/ayamgeprek.jpg",
    ],
    [
        "name" => "Sate Ayam",
        "price" => 12000,
        "image" => "../assets-templates/img/makanan/makananBerat/sateayam.jpg",
    ],
    [
        "name" => "Nila Bakar",
        "price" => 18000,
        "image" => "../assets-templates/img/makanan/makananBerat/nilabakar.jpg",
    ],
    [
        "name" => "Beef Steak",
        "price" => 20000,
        "image" => "../assets-templates/img/makanan/makananBerat/steak.jpg",
    ],
    [
        "name" => "Lele Goreng",
        "price" => 8000,
        "image" => "../assets-templates/img/makanan/makananBerat/lelegoreng.jpg",
    ],
];

$makananPenutup = [
    [
        "name" => "Brownies",
        "price" => 12000,
        "image" => "../assets-templates/img/makanan/makananPenutup/brownies.jpg",
    ],
    [
        "name" => "Cheese Cake",
        "price" => 20000,
        "image" => "../assets-templates/img/makanan/makananPenutup/cheese cake.jpg",
    ],
    [
        "name" => "Churros",
        "price" => 12000,
        "image" => "../assets-templates/img/makanan/makananPenutup/churros.jpg",
    ],
    [
        "name" => "Lava Cake",
        "price" => 20000,
        "image" => "../assets-templates/img/makanan/makananPenutup/lava cake.jpg",
    ],
    [
        "name" => "Macarons",
        "price" => 18000,
        "image" => "../assets-templates/img/makanan/makananPenutup/macarons.jpg",
    ],
    [
        "name" => "Panna Cota",
        "price" => 18000,
        "image" => "../assets-templates/img/makanan/makananPenutup/panna cota.jpg",
    ],
    [
        "name" => "Waffle",
        "price" => 12000,
        "image" => "../assets-templates/img/makanan/makananPenutup/waffle.jpg",
    ],
    [
        "name" => "Mochi Mini",
        "price" => 12000,
        "image" => "../assets-templates/img/makanan/makananPenutup/mochi.jpg",
    ],
];

// Function to format currency
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
    <title>Food Get</title>

    <style>
        * {
            padding: 0;
            margin: 0;
        }

        h2 {
            font-size: 11px;
            background-color: #EAD196;
            text-align: center;
            display: inline-block;
            padding: 10px 15px;
            border-radius: 15px;
        }

        p {
            font-weight: bold;
        }
    </style>
</head>

<body style="background-color:#f5f4e6;">
    <?php include '../assets-templates/header.php'; ?>

    <div class="container mt-5">
        <h2 class="mb-4" style="color:black; font-size:22px;">Makanan Ringan</h2>
        <a href="listMinuman.php">
            <h2 class="mb-4" style="color:black; font-size:10px;"> -> list minuman</h2>
        </a>
        <div class="d-flex flex-wrap justify-content-between">
            <?php foreach ($makananRingan as $item) : ?>
                <div class="card mb-4" style="width: 15rem; background-color:whitesmoke;">
                    <div class="card-body d-flex flex-column align-items-center">
                        <img src="<?= $item['image']; ?>" class="card-img-top mb-2" alt="...">
                        <h4 class="card-text mb-0"><?= $item['name']; ?></h4>
                        <p class="card-text mt-1"><?= formatRupiah($item['price']); ?>
                        <form action="keranjang.php" method="get" class="d-flex flex-column align-items-center">
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="name" value="<?= urlencode($item['name']); ?>">
                            <input type="hidden" name="price" value="<?= $item['price']; ?>">
                            <div class="d-flex align-items-center mb-2">
                                <input type="number" name="quantity" value="1" min="1" class="form-control quantity-input text-center me-2" style="width: 60px;">
                                <button type="submit" class="btn btn-danger">Pesan</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <h2 class="mb-4" style="color:black; font-size:22px;">Makanan Utama</h2>
        <div class="d-flex flex-wrap justify-content-between">
            <?php foreach ($makananUtama as $item) : ?>
                <div class="card mb-4" style="width: 15rem; background-color:whitesmoke;">
                    <div class="card-body d-flex flex-column align-items-center">
                        <img src="<?= $item['image']; ?>" class="card-img-top mb-2" alt="...">
                        <h4 class="card-text mb-0"><?= $item['name']; ?></h4>
                        <p class="card-text mt-1"><?= formatRupiah($item['price']); ?>
                        <form action="keranjang.php" method="get" class="d-flex flex-column align-items-center">
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="name" value="<?= urlencode($item['name']); ?>">
                            <input type="hidden" name="price" value="<?= $item['price']; ?>">
                            <div class="d-flex align-items-center mb-2">
                                <input type="number" name="quantity" value="1" min="1" class="form-control quantity-input text-center me-2" style="width: 60px;">
                                <button type="submit" class="btn btn-danger">Pesan</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <h2 class="mb-4" style="color:black; font-size:22px;">Makanan Penutup</h2>
        <div class="d-flex flex-wrap justify-content-between">
            <?php foreach ($makananPenutup as $item) : ?>
                <div class="card mb-4" style="width: 15rem; background-color:whitesmoke;">
                    <div class="card-body d-flex flex-column align-items-center">
                        <img src="<?= $item['image']; ?>" class="card-img-top mb-2" alt="...">
                        <h4 class="card-text mb-0"><?= $item['name']; ?></h4>
                        <p class="card-text mt-1"><?= formatRupiah($item['price']); ?>
                        <form action="keranjang.php" method="get" class="d-flex flex-column align-items-center">
                            <input type="hidden" name="action" value="add">
                            <input type="hidden" name="name" value="<?= urlencode($item['name']); ?>">
                            <input type="hidden" name="price" value="<?= $item['price']; ?>">
                            <div class="d-flex align-items-center mb-2">
                                <input type="number" name="quantity" value="1" min="1" class="form-control quantity-input text-center me-2" style="width: 60px;">
                                <button type="submit" class="btn btn-danger">Pesan</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>