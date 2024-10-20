<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id_berita = mysqli_real_escape_string($db, $_GET['id']);
    $query = "SELECT berita.*, kategori.nama_kategori 
              FROM berita 
              JOIN kategori ON berita.kategori_id = kategori.id 
              WHERE berita.id = '$id_berita'";
    
    $result = mysqli_query($db, $query);
    
    if (!$result) {
        die("Query error: " . mysqli_error($db));
    }
    
    $berita = mysqli_fetch_assoc($result);

    if (!$berita) {
        echo "<script>alert('Berita tidak ditemukan.'); window.location='index.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID berita tidak valid.'); window.location='index.php';</script>";
    exit;
}
?>

<div class="container-fluid px-4 py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php?p=berita">Berita</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?= $berita['judul'] ?></li>
                </ol>
            </nav>

            <div class="card shadow-lg border-0">
                <img src="uploads/<?= $berita['file_upload'] ?>" class="card-img-top" alt="<?= $berita['judul'] ?>" style="max-height: 400px; object-fit: cover;">
                <div class="card-body">
                    <h1 class="card-title mb-3"><?= $berita['judul'] ?></h1>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <span class="badge bg-primary"><?= $berita['nama_kategori'] ?></span>
                        <small class="text-muted">
                            <i class="fas fa-calendar-alt me-2"></i><?= date('d F Y', strtotime($berita['created_at'])) ?>
                        </small>
                    </div>
                    <div class="card-text mb-4">
                        <?= nl2br($berita['isi_berita']) ?>
                    </div>
                    <a href="index.php" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar Berita
                    </a>
                </div>
            </div>

            <!-- Bagian komentar bisa ditambahkan di sini jika diperlukan -->

        </div>
    </div>
</div>

<script>
    // Tambahkan script untuk membuat gambar dapat di-zoom jika diklik
    document.querySelector('.card-img-top').addEventListener('click', function() {
        this.requestFullscreen();
    });
</script>
