<h1>Berita Terkini</h1>

<div class="row">
    <?php
    include 'admin/koneksi.php';
    $status = isset($_GET['status']) ? $_GET['status'] : '';
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    if ($status == 'detail' && !empty($id)) {
        $ambil = mysqli_query($db, "SELECT * FROM berita WHERE id = '$id'");
        $berita = mysqli_fetch_array($ambil);
        if ($berita) {
    ?>
            <div class="col-12 mb-4">
                <div class="card">
                    <img src="admin/uploads/<?= $berita['file_upload'] ?>" class="card-img-top" alt="<?= $berita['judul'] ?>">
                    <div class="card-body">
                        <h2 class="card-title"><?= $berita['judul'] ?></h2>
                        <p class="card-text"><?= nl2br($berita['isi_berita']) ?></p>
                        <a href="index.php?p=home" class="btn btn-secondary">Kembali ke Daftar Berita</a>
                    </div>
                </div>
            </div>
    <?php
        } else {
            echo "<div class='col-12'><p class='alert alert-danger'>Berita tidak ditemukan.</p></div>";
        }
    } else {
        $sql = mysqli_query($db, "SELECT * FROM berita ORDER BY id DESC LIMIT 6");
        while ($berita = mysqli_fetch_array($sql)) {
    ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="admin/uploads/<?= $berita['file_upload'] ?>" class="card-img-top" alt="<?= $berita['judul'] ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= $berita['judul'] ?></h5>
                        <p class="card-text flex-grow-1"><?= mb_substr($berita['isi_berita'], 0, 100, 'UTF-8') ?>...</p>
                        <a href="index.php?p=home&status=detail&id=<?= $berita['id'] ?>" class="btn btn-primary btn-readmore mt-auto">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>
</div>

<style>
.btn-readmore {
    transition: all 0.3s ease;
}

.btn-readmore:hover {
    transform: translateX(5px);
}

.card-img-top {
    height: 200px;
    object-fit: cover;
}
</style>
