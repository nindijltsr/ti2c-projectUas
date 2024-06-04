<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css" />
    <title>Penawaran Khusus</title>
    <?php include '../assets-templates/header.php'; ?>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #F5F4E6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            padding: 0px;
        }

        header, footer {
            width: 100%;
            padding: 10px; 
            background-color: #333; 
            color: #fff; 
            text-align: center; 
        }

        .container-wrapper {
            margin-top: 40px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            position: relative; 
            z-index: 1; 
        }

        .container {
            text-align: center;
            width: calc(50% - 24px);
            max-width: 600px; 
            margin: 8px;
            padding: 80px; 
            background-color: #BB0A13;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-size: cover;
            background-position: center;
            position: relative;
            overflow: hidden;
            z-index: 2; 
            height: 200px;
        }

        .container img {
            width: 80%;
            max-width: 100px;
            border-radius: 50%;
            margin-bottom: 15px;
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .container .btn {
            padding: 7px 8px;
            background-color: #969A36;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .container .btn:hover {
            background-color: #7a7e29;
        }

        .container:nth-child(1) {
            background-image: url("../assets-templates/img/promo/diskon25.png");
        }

        .container:nth-child(2) {
            background-image: url("../assets-templates/img/promo/diskon50.png");
        }

        .container:nth-child(3) {
            background-image: url("../assets-templates/img/promo/diskon75.png");
        }

        .container:nth-child(4) {
            background-image: url("../assets-templates/img/promo/diskon90.png");
        }


        .promo-code {
            font-weight: bold;
            font-size: 20px;
            display: none;
            color: white;
            position: absolute;
            background-color: rgba(0, 0, 0, 0.4);
            top: 50%; 
            left: 50%;
            transform: translate(-50%, -50%); 
        }
        @media (max-width: 768px) {
    .container {
        width: 100%; 
    }
}
    </style>
</head>
<body>
<div class="container-wrapper">
        <div class="container" data-promo="25%">
            <a href="#" class="btn" onclick="showPromoCode('DISC25')">Kode Promo</a>
            <div class="promo-code" id="promo-disc25">Kode Promo: DISC25</div>
        </div>
        <div class="container" data-promo="50%">
            <a href="#" class="btn" onclick="showPromoCode('DISC50')">Kode Promo</a>
            <div class="promo-code" id="promo-disc50">Kode Promo: DISC50</div>
        </div>
        <div class="container" data-promo="75%">
            <a href="#" class="btn" onclick="showPromoCode('DISC75')">Kode Promo</a>
            <div class="promo-code" id="promo-disc75">Kode Promo: DISC75</div>
        </div>
        <div class="container" data-promo="90%">
            <a href="#" class="btn" onclick="showPromoCode('DISC90')">Kode Promo</a>
            <div class="promo-code" id="promo-disc90">Kode Promo: DISC90</div>
        </div>
        <!-- <div class="container" data-promo="Buy 1 Get 1">
            <a href="#" class="btn" onclick="showPromoCode('KTG11')">Kode Promo</a>
            <div class="promo-code" id="promo-ktg11">Kode Promo: KTG11</div>
        </div>
        <div class="container" data-promo="Buy 1 Get 1">
            <a href="#" class="btn" onclick="showPromoCode('AMRC11')">Kode Promo</a>
            <div class="promo-code" id="promo-amrc11">Kode Promo: AMRC11</div>
        </div>
        <div class="container-wrapper"> -->
    </div>
    </div>

    <script>
  document.addEventListener('DOMContentLoaded', function() {
    var promoButtons = document.querySelectorAll('.btn');


    promoButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault(); 

            var promoCode = this.getAttribute('onclick').match(/'([^']+)'/)[1];

            showPromoCode(promoCode);
        });
    });
});

    function showPromoCode(promoCode) {
        document.querySelectorAll('.promo-code').forEach(function(promo) {
            promo.style.display = 'none';
        });

        var promoId = 'promo-' + promoCode.toLowerCase();
        var promoElement = document.getElementById(promoId);
        if (promoElement) {
            promoElement.style.display = 'block';
        } else {
            console.error("Promo tidak tersedia!");
        }
    }
    </script>
    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <?php include '../assets-templates/footer.php'; ?>
</body>
</html>
