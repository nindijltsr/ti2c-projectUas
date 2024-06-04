<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
  <title>Tentang Kami - FoodGet</title>
  <style>
    html, body {
      height: 100%;
    }
    body {
      display: flex;
      flex-direction: column;
    }
    .content {
      flex: 1;
    }
    .custom-bg {
      background-color: #bb0a13;
      height: 72px;
    }
    .font {
      color: white;
      font-size: 20px;
    }
    .footer-bg {
      background-color: #bb0a13;
    }
    .highlight-container {
      background-color: #f8f9fa; 
      border: 1px solid #bb0a13; 
      padding: 10px;
      margin: 10px 0;
      border-radius: 8px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      height: 100%;
    }
    .equal-height {
      display: flex;
    }
  </style>
</head>
<body>
  <?php include '../assets-templates/header.php'; ?>
  
  <div class="content">
    <div class="container mt-5">
      <div class="row">
        <div class="col-lg-8 offset-lg-2">
          <h2 class="text-center mb-4">Tentang Kami</h2>
          <p class="text-center">Foodget adalah platform e-commerce yang dibuat untuk perdagangan makanan dan minuman, dirancang untuk menyediakan kemudahan dan kenyamanan bagi konsumen dalam memesan makanan secara online. Dengan teknologi terkini dan antarmuka yang user-friendly, Foodget memfasilitasi transaksi yang cepat, aman, dan efisien bagi semua penggunanya.</p>
        </div>
      </div>
      <div class="row mt-4 equal-height"> 
        <div class="col-md-6">
          <div class="highlight-container">
            <h2 class="text-center mb-4">Visi Kami</h2>
            <p class="text-center">Menjadi platform utama yang menghubungkan konsumen dengan penyedia makanan berkualitas, menciptakan ekosistem digital yang berkelanjutan bagi industri makanan, dan mendukung pertumbuhan usaha makanan lokal di seluruh Indonesia.</p>
          </div>
        </div>
        <div class="col-md-6"> 
          <div class="highlight-container">
            <h2 class="text-center mb-4">Misi Kami</h2>
            <p class="text-center">Memberikan pengalaman berbelanja makanan yang menyenangkan dan mudah diakses bagi konsumen. Dengan menyediakan berbagai pilihan makanan berkualitas dari berbagai restoran, kami memastikan bahwa pelanggan dapat menemukan apa yang mereka inginkan dengan mudah dan cepat.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include '../assets-templates/footer.php'; ?>
  <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
