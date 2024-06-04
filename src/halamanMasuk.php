<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'koneksiDB.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['email'] = $row['email']; 
            $_SESSION['loggedin'] = true; 
            header("Location: index.php");
            exit();
        } else {
            $error = "Password tidak cocok";
        }
    } else {
        $error = "Email tidak ditemukan";
    }

    $stmt->close();
    $conn->close();
}
?>

<?php include '../assets-templates/header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page Sederhana</title>
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f5f4e6;
            font-family: Arial, sans-serif;
        }
        .login-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            max-width: 400px;
        }
        .login-form h1 {
            text-align: center;
            margin-bottom: 10px;
            font-size: 24px;
            font-weight: bold;
        }
        .login-form h6 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .login-form label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .login-form input[type="email"],
        .login-form input[type="password"] {
            border: 1px solid #A52A2A;
            margin-bottom: 10px;
            border-radius: 5px;
            padding: 10px;
        }
        .btn-brown {
            background-color: #A52A2A;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-brown:hover {
            background-color: #7d2e0c;
        }
        .register-link {
            text-align: center;
            margin-top: 10px;
        }
        .register-link span {
            font-size: 16px;
            font-weight: bold;
            color: #bb0a13;
        }
        .register-link .btn {
            font-size: 14px;
            color: #fff;
            background-color: #A52A2A;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: inline-block;
        }
        .register-link .btn:hover {
            background-color: #7d2e0c;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 login-form">
                <h1>Selamat Datang!</h1>
                <h6>Masukkan Email dan Password untuk masuk</h6>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="login" class="btn btn-brown">Masuk</button>
                    </div>
                </form>
                <hr>
                <div class="register-link">
                    <span>Belum memiliki akun?</span>
                    <div>
                        <button onclick="window.location.href='halamanDaftar.php'" class="btn btn-sm btn-brown" style="float: right;">Daftar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include '../assets-templates/footer.php'; ?>
    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>