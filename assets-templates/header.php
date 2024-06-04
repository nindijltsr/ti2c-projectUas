<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    rel="stylesheet"
    href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css"
  />
  <script src="https://kit.fontawesome.com/e92cb405cc.js" crossorigin="anonymous"></script>
  
  <title>FoodGet</title>
  <style>
    .logo {
      width: 150px;
    }
    .custom-bg {
      background-color: #bb0a13;
      height: 72px;
    }
    .font {
      color: white;
      font-size: clamp(16px, 2vw, 18px);
    }
    .custom-font {
      font-family: 'Arial', sans-serif;
      font-size: 18px;
    }
    .custom-dropdown .dropdown-toggle {
      font-size: 16px;
      color: white;
    }
    .custom-dropdown .dropdown-menu {
      font-size: 14px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand navbar-dark custom-bg">
    <a class="navbar-brand px-3" href="../src/index.php">
      <img src="../assets-templates/img/logo.png" alt="Logo" class="logo">
    </a>
    <div class="navbar-nav w-100">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <div class="btn-group">
            <button type="button" class="nav-link btn dropdown-toggle dropdown-toggle-split font" data-bs-toggle="dropdown" aria-expanded="false">
              Menu
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="../src/listMakanan.php">Makanan</a></li>
              <li><a class="dropdown-item" href="../src/listMinuman.php">Minuman</a></li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link font" href="../src/promo.php">Penawaran Khusus</a>
        </li>
        <li class="nav-item nav-font">
          <a class="nav-link font" href="../src/TentangKami.php">Tentang Kami</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto">
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
          <li class="nav-item dropdown custom-dropdown">
            <a class="nav-link dropdown-toggle font cutom-font" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-regular fa-user"></i> <?= htmlspecialchars($_SESSION['email']) ?>
            </a>
            <ul class="dropdown-menu dropdown-menu-end custom" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
              <li><a class="dropdown-item" href="riwayatPesanan.php">Riwayat Pesanan</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li class="nav-item nav-font">
            <a class="nav-link font" href="halamanDaftar.php">Daftar</a>
          </li>
          <li class="nav-item nav-font">
            <a class="nav-link font" href="halamanMasuk.php">Masuk</a>
          </li>
        <?php endif; ?>
        <li class="nav-item nav-font">
          <a class="nav-link font px-3" href="keranjang.php"><i class="fas fa-cart-plus"></i></a>
        </li>
      </ul>
    </div>
  </nav>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
