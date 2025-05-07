<?php
session_start();
require_once 'config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Get user from database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user) {
            // Debug information
            error_log("Login attempt for user: " . $username);
            error_log("Stored hash: " . $user['password']);
            error_log("Input password: " . $password);
            
            // Verify password
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: index.php");
                exit();
            } else {
                $error = "Password salah. Silakan coba lagi.";
            }
        } else {
            $error = "Username tidak ditemukan.";
        }
    } catch(PDOException $e) {
        $error = "Database error: " . $e->getMessage();
        error_log("Database error: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | CMS Sederhana</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="assets/css/custom.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo animate__animated animate__fadeInDown">
        <b>Login</b> CMS
        <div class="theme-selector mt-2" style="position:absolute;top:10px;right:10px;">
            <span class="theme-color theme-blue" data-theme="blue" title="Biru"></span>
            <span class="theme-color theme-green" data-theme="green" title="Hijau"></span>
            <span class="theme-color theme-purple" data-theme="purple" title="Ungu"></span>
            <span class="theme-color theme-red" data-theme="red" title="Merah"></span>
            <span class="theme-color theme-orange" data-theme="orange" title="Oranye"></span>
        </div>
    </div>
    <!-- /.login-logo -->
    <div class="card animate__animated animate__fadeInUp">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            <?php if (isset($error)): ?>
                <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>

            <form action="login.php" method="post" autocomplete="off">
                <div class="input-group mb-3">
                    <input type="text" name="username" class="form-control floating-input" placeholder="Username" required autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control floating-input" placeholder="Password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block animate__animated animate__pulse animate__infinite">Sign In</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
<script>
$(function() {
    // Theme color switcher
    function setTheme(theme) {
        $('body').removeClass('theme-blue theme-green theme-purple theme-red theme-orange').addClass('theme-' + theme);
        localStorage.setItem('loginTheme', theme);
    }
    // On click
    $('.theme-color').on('click', function() {
        setTheme($(this).data('theme'));
    });
    // On load
    var saved = localStorage.getItem('loginTheme') || 'blue';
    setTheme(saved);
});
</script>
</body>
</html> 