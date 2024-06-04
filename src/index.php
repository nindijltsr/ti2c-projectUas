
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
  <title>FoodGet</title>
  <style>
    * {
      padding: 0;
      margin: 0;
    }

    /* SLIDE */
    .carousel-item {
      width: 100%;
    }
    .carousel-item img {
      margin-top: -190px;
      padding-top: 130px;
    }
    .carousel-caption {
      position: absolute;
      top: 78%;
      transform: translateY(-50%);
      text-align: center;
    }
    .slide {
      width: 100%;
    }
    .font{
        color: white;
        font-size: clamp(16px, 2vw, 20px);
    }
  </style>
  
</head>
<body>
  <?php include '../assets-templates/header.php'; ?>

  <div id="carouselExampleIndicators" class="carousel slide img-fluid">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="../assets-templates/img/Slide1.png" class="d-block w-100" alt="...">
        <div class="carousel-caption d-blok">
          <a href="keranjang.php">
            <button type="button" class="btn btn-danger">Pesan Sekarang</button>
          </a>
        </div>
      </div>
      <div class="carousel-item">
        <img src="../assets-templates/img/Second.png" class="d-block w-100" alt="...">
        <div class="carousel-caption  d-md-block img-fluid">
          <h5 class="capt">Berbagai menu makanan tersedia</h5>
          <p class="capt">Mulai dari Makanan Ringan, Makanan Utama dan Makanan Penutup  </p>
          <a href="listMakanan.php">
            <button type="button" class="btn btn-danger">Makanan</button>
          </a>
        </div>
      </div>
      <div class="carousel-item ">
        <img src="../assets-templates/img/Slide3.png" class="d-block w-100" alt="...">
        <div class="carousel-caption capt img-fluid">
          <h5 class="capt">Banyak minuman tersedia</h5>
          <p class="capt">Tersedia berbagai minuman segar, minuman manis dan soda</p>
          <a href="listMinuman.php">
            <button type="button" class="btn btn-danger"> Minuman</button>
          </a>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden bg-dark">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  


  <?php include '../assets-templates/footer.php'; ?>
  <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
