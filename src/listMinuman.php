<?php
session_start();

$minuman = [
    [
        "name" => "Es Teh",
        "price" => 4000,
        "image" => "../assets-templates/img/minuman/esteh.png",
    ],
    [
        "name" => "Es Jeruk",
        "price" => 5000,
        "image" => "../assets-templates/img/minuman/esjeruk.png",
    ],
    [
        "name" => "Teh Tarik",
        "price" => 7000,
        "image" => "../assets-templates/img/minuman/tehtarik.png",
    ],
    [
        "name" => "Thai Tea",
        "price" => 7000,
        "image" => "../assets-templates/img/minuman/thaitea.jpg",
    ],
    [
        "name" => "Americano",
        "price" => 10000,
        "image" => "../assets-templates/img/minuman/coffe.jpg",
    ],
    [
        "name" => "cappucino",
        "price" => 5000,
        "image" => "../assets-templates/img/minuman/cappucino.png",
    ],
    [
        "name" => "Jus Jeruk",
        "price" => 8000,
        "image" => "../assets-templates/img/minuman/jus jeruk.jpg",
    ],
    [
        "name" => "Jus Alpukat",
        "price" => 12000,
        "image" => "../assets-templates/img/minuman/jus alpukat.jpg",
    ],
    [
        "name" => "Jus Jambu",
        "price" => 8000,
        "image" => "../assets-templates/img/minuman/jus jambu.jpg",
    ],
    [
        "name" => "Jus Mangga",
        "price" => 8000,
        "image" => "../assets-templates/img/minuman/jus mangga.jpg",
    ],
    [
        "name" => "Jus Melon",
        "price" => 8000,
        "image" => "../assets-templates/img/minuman/jus melon.jpg",
    ],
    [
        "name" => "Jus Semangka",
        "price" => 8000,
        "image" => "../assets-templates/img/minuman/jus semangka.jpg",
    ],
    [
        "name" => "Jus Sirsak",
        "price" => 10000,
        "image" => "../assets-templates/img/minuman/jus sirsak.jpg",
    ],
    [
        "name" => "Jus Stroberi",
        "price" => 15000,
        "image" => "../assets-templates/img/minuman/jus stroberi.jpg",
    ],
    [
        "name" => "Jus Tomat",
        "price" => 6000,
        "image" => "../assets-templates/img/minuman/justomat.jpg",
    ],
    [
        "name" => "Jus Wortel",
        "price" => 6000,
        "image" => "../assets-templates/img/minuman/juswortel.jpg",
    ],
    [
        "name" => "Coca Cola",
        "price" => 7000,
        "image" => "../assets-templates/img/minuman/cocacola.jpg",
    ],
    [
        "name" => "Fanta",
        "price" => 7000,
        "image" => "../assets-templates/img/minuman/fanta.jpg",
    ],
    [
        "name" => "Sprite",
        "price" => 7000,
        "image" => "../assets-templates/img/minuman/seprite.jpg",
    ],
    [
        "name" => "Air Mineral",
        "price" => 8000,
        "image" => "../assets-templates/img/minuman/air mineral.jpg",
    ],
];

// Function to format currency
function formatRupiah($number){
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
    p {
        font-weight: bold;
    }
    h2 {
            font-size: 11px;
            background-color: #EAD196;
            text-align: center;
            display: inline-block; /* Menyesuaikan ukuran background dengan isi */
            padding: 10px 15px; /* Menambah ruang di sekitar teks */
            border-radius: 15px; /* Membuat border melengkung */
        }
    </style>
</head>
<body style="background-color:#f5f4e6;">
    <?php include '../assets-templates/header.php'; ?>

    <div class="container mt-5">
        <h2 class="mb-4" style="color:black; font-size:22px;">Minuman</h2>
        <a href="listMakanan.php">
            <h2 class="mb-4" style="color:black; font-size:10px;"> -> list makanan</h2>
        </a>
        <div class="d-flex flex-wrap justify-content-between">
            <?php foreach ($minuman as $item): ?>
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