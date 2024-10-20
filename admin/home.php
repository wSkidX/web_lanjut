<div class="container mt-4">
    <h1 class="mb-4 text-center">Berita Terkini</h1>

    <div class="row">
        <?php
        include 'koneksi.php';
        $status = isset($_GET['status']) ? $_GET['status'] : '';
        switch ($status) {
            default:
                $sql = mysqli_query($db, "SELECT * FROM berita ORDER BY id DESC LIMIT 6");
                while ($berita = mysqli_fetch_array($sql)) {
        ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="uploads/<?= $berita['file_upload'] ?>" class="card-img-top" alt="<?= $berita['judul'] ?>" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= $berita['judul'] ?></h5>
                                <p class="card-text flex-grow-1"><?= substr($berita['isi_berita'], 0, 100) ?>...</p>
                                <a href="index.php?p=detail&id=<?= $berita['id'] ?>" class="btn btn-primary mt-auto">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
        <?php
                }
                break;
            case "detail":
                if (isset($_GET['id'])) {
                    $ambil = mysqli_query($db, "SELECT * FROM berita WHERE id= '$_GET[id]'");
                    $berita = mysqli_fetch_array($ambil);
                }
        ?>
                <div class="col-md-8 mx-auto mb-4">
                    <div class="card shadow">
                        <img src="uploads/<?= $berita['file_upload'] ?>" class="card-img-top" alt="<?= $berita['judul'] ?>" style="max-height: 400px; object-fit: cover;">
                        <div class="card-body">
                            <h2 class="card-title mb-3"><?= $berita['judul'] ?></h2>
                            <p class="card-text"><?= nl2br($berita['isi_berita']) ?></p>
                            <a href="index.php" class="btn btn-secondary mt-3">Kembali ke Daftar Berita</a>
                        </div>
                    </div>
                </div>
        <?php
                break;
        }
        ?>
    </div>
</div>
