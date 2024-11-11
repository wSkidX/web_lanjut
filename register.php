<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="admin/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="admin/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="admin/AdminLTE-3.2.0/dist/css/adminlte.min.css?v=3.2.0">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="confirm_password" class="form-control" placeholder="Konfirmasi password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary required">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <?php
                        if (isset($_POST['submit'])) {
                            include 'admin/koneksi.php';
                            $nama = $_POST['nama'];
                            $user_email = $_POST['email'];
                            $user_pass = $_POST['password'];
                            $confirm_pass = $_POST['confirm_password'];

                            // Validasi password
                            if ($user_pass !== $confirm_pass) {
                                echo "<script>alert('Password tidak cocok'); window.location.href='register.php';</script>";
                                exit;
                            }

                            $user_pass = md5($user_pass); // Enkripsi password dengan md5

                            // Cek apakah email sudah terdaftar
                            $check_email = mysqli_query($db, "SELECT * FROM user WHERE email='$user_email'");
                            if (mysqli_num_rows($check_email) > 0) {
                                echo "<script>alert('Email sudah terdaftar'); window.location.href='register.php';</script>";
                            } else {
                                $register = mysqli_query($db, "INSERT INTO user (nama, email, password) VALUES ('$nama', '$user_email', '$user_pass')");
                                if ($register) {
                                    echo "<script>alert('Register berhasil'); window.location.href='login.php';</script>";
                                } else {
                                    echo "<script>alert('Register gagal'); window.location.href='register.php';</script>";
                                }
                            }
                        }
                        ?>

                    </div>
                </form>

                <a href="login.php" class="text-center">I already have a account</a>
            </div>

        </div>
    </div>


    <script src="admin/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>

    <script src="admin/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="admin/AdminLTE-3.2.0/dist/js/adminlte.min.js?v=3.2.0"></script>
</body>

</html>
