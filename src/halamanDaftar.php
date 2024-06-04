<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'koneksiDB.php';

    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $hashed_password);

    try {
        $stmt->execute();
        $success = "Registrasi sukses!";
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) { // Duplicate entry error code for MySQL
            $error = "Email sudah terdaftar. Silakan gunakan email lain.";
        } else {
            $error = "Error: " . $stmt->error;
        }
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
        .register-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            max-width: 400px;
        }
        .register-form h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 24px;
            font-weight: bold;
        }
        .register-form label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .register-form input[type="email"],
        .register-form input[type="password"] {
            border: 1px solid #A52A2A;
            margin-bottom: 10px;
        }
        .register-form button[type="submit"] {
            background-color: #A52A2A;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .register-form button[type="submit"]:hover {
            background-color: #8B0000;
        }
        .login-link {
            text-align: center;
            margin-top: 10px;
        }
        .login-link a {
            color: #A52A2A;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
<div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 register-form">
                <h1>Form Daftar</h1>
                <?php if (!empty($success)): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $success; ?>
    </div>
<?php elseif (!empty($error)): ?>
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
                        <button type="submit" name="register" class="btn btn-primary btn-lg">Daftar</button>
                    </div>
                </form>
                <hr>
                <div class="login-link">
                    <p>Kamu sudah memiliki akun? <a href="halamanMasuk.php">Masuk sekarang</a></p>
                </div>
            </div>
        </div>
    </div>
    <?php include '../assets-templates/footer.php'; ?>
    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>