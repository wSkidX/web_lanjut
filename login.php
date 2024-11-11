<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Log in (v2)</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="admin/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="admin/AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css">

    <link rel="stylesheet" href="admin/AdminLTE-3.2.0/dist/css/adminlte.min.css?v=3.2.0">
    <style>
        #loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div id="loading-screen" style="display: none;">
        <div class="spinner"></div>
    </div>

    <div class="login-box">

        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="admin/index.html" class="h1"><b>Admin</b>LTE</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="" method="post">
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
                   
                    
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>

                        <div class="col-4">
                            <button type="submit" name ="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
                <p class="mb-0">
                    <a href="register.php" class="text-center">Register</a>
                </p>
            </div>
            <?php
                   
                    if (isset($_POST['submit'])) {
                        include 'admin/koneksi.php';
                        $user_email = $_POST['email'];
                        $user_pass = md5($_POST['password']);

                        $login = mysqli_query($db, "SELECT * FROM user WHERE email='$user_email' AND password='$user_pass'");
                        $data_user = mysqli_fetch_assoc($login);

                        if ($data_user) {
                            // Simpan email di session
                            $_SESSION['email'] = $data_user['email'];
                            
                            // Simpan data user di session
                            $_SESSION['user'] = [
                                'id' => $data_user['id'],
                                'email' => $data_user['email'],
                                'nama' => $data_user['nama'],
                                'foto' => $data_user['foto'],
                                'level' => $data_user['level']
                            ];

                            header('location:admin/index.php');
                            exit;
                        } else {
                            echo "<script>alert('Username atau Password Salah'); window.location.href='login.php';</script>";
                        }
                    }
                    ?>

        </div>

    </div>


    <script src="admin/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>

    <script src="admin/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="admin/AdminLTE-3.2.0/dist/js/adminlte.min.js?v=3.2.0"></script>
</body>

</html>
