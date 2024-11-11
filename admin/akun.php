<?php

if (!isset($_SESSION['email'])) {
    header('location:../login.php');
    exit();
}

include 'koneksi.php';

$email = $_SESSION['email'];
$query = mysqli_query($db, "SELECT * FROM user WHERE email='$email'");
$user = mysqli_fetch_assoc($query);

$error = '';
$success = '';

// Jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = isset($_POST['nama']) ? mysqli_real_escape_string($db, $_POST['nama']) : $user['nama'];
    $new_email = isset($_POST['email']) ? mysqli_real_escape_string($db, $_POST['email']) : $user['email'];
    $current_password = isset($_POST['current_password']) ? $_POST['current_password'] : '';
    $new_password = isset($_POST['new_password']) ? $_POST['new_password'] : '';
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

    $update_fields = [];

    if ($nama != $user['nama']) {
        $update_fields[] = "nama='$nama'";
    }

    if ($new_email != $user['email']) {
        if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
            $error = "Format email tidak valid.";
        } else {
            $update_fields[] = "email='$new_email'";
        }
    }

    if (!empty($new_password)) {
        if ($new_password != $confirm_password) {
            $error = "Password baru dan konfirmasi password tidak cocok.";
        } else {
            $hashed_current_password = md5($current_password);
            $verify_query = "SELECT * FROM user WHERE id='$user[id]' AND password='$hashed_current_password'";
            $verify_result = mysqli_query($db, $verify_query);

            if (mysqli_num_rows($verify_result) == 1) {
                $hashed_new_password = md5($new_password);
                $update_fields[] = "password='$hashed_new_password'";
            } else {
                $error = "Password lama tidak sesuai.";
            }
        }
    }

    // Proses upload foto profil
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["foto"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if($check !== false) {
            if ($_FILES["foto"]["size"] <= 500000) {
                if(in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
                    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                        $update_fields[] = "foto='$target_file'";
                    } else {
                        $error = "Maaf, terjadi kesalahan saat mengupload file.";
                    }
                } else {
                    $error = "Hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
                }
            } else {
                $error = "Ukuran file terlalu besar.";
            }
        } else {
            $error = "File bukan gambar.";
        }
    }

    if (!empty($update_fields) && empty($error)) {
        $update_query = "UPDATE user SET " . implode(", ", $update_fields) . " WHERE id='$user[id]'";
        if (mysqli_query($db, $update_query)) {
            $success = "Perubahan berhasil disimpan.";
            if ($new_email != $email) {
                $_SESSION['email'] = $new_email;
            }
            // Refresh data user
            $query = mysqli_query($db, "SELECT * FROM user WHERE id='$user[id]'");
            $user = mysqli_fetch_assoc($query);
        } else {
            $error = "Terjadi kesalahan saat menyimpan perubahan.";
        }
    }
}

?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Pengaturan Akun</h1>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <?php if($error != ''): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $error; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <?php if($success != ''): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo $success; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Akun</h3>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $user['nama']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="current_password">Password Lama</label>
                                <input type="password" class="form-control" id="current_password" name="current_password">
                            </div>
                            <div class="form-group">
                                <label for="new_password">Password Baru</label>
                                <input type="password" class="form-control" id="new_password" name="new_password">
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                            </div>
                            <div class="form-group">
                                <label for="foto">Foto Profil</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="foto" name="foto" onchange="previewImage(this);">
                                        <label class="custom-file-label" for="foto">Pilih file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <img id="preview" src="#" alt="Preview" class="img-thumbnail" style="max-width: 200px; display: none;">
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function previewImage(input) {
    var preview = document.getElementById('preview');
    var file = input.files[0];
    var reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
        preview.style.display = 'block';
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
}
</script>
