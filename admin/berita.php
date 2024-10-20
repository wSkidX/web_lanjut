<?php
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'list':
?>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Manajemen Berita</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Berita</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Daftar Berita
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="index.php?p=berita&aksi=input" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Tambah Berita
                        </a>
                    </div>
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Penulis</th>
                                <th>Tanggal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        include 'koneksi.php';
                        $ambil = mysqli_query($db, "SELECT * FROM user,kategori,berita WHERE 
                        user_id=berita.user_id AND kategori.id=berita.kategori_id");
                        $no = 1;
                        while ($data = mysqli_fetch_array($ambil)) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['judul'] ?></td>
                                <td><?= $data['nama_kategori'] ?></td>
                                <td><?= $data['email'] ?></td>
                                <td><?= $data['created_at'] ?></td>
                                <td>
                                    <a href="index.php?p=berita&aksi=edit&id=<?= $data['id'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="proses_berita.php?proses=delete&id=<?= $data['id'] ?>&file=<?= $data['file_upload'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?')"> <i class="bi bi-x-circle"></i> Delete</a>
                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
<?php
        break;

    case 'input':
        ?>
            <div class="row">
                <div class="col-6 mx-auto">
                    <br>
                    <h2>Tambah Berita</h2>
                    <form action="proses_berita.php?proses=insert" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul">
                        </div>
                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="kategori_id" class="form-select">
                                    <option value="">Pilih Kategori</option>
                                    <?php
                                    include 'koneksi.php';
                                    $kategori = mysqli_query($db, "SELECT * FROM kategori");
                                    while ($data_kategori = mysqli_fetch_array($kategori)) {
                                        // Pastikan nama kolom sesuai dengan struktur database Anda
                                        echo "<option value='" . $data_kategori['id'] . "'>" . $data_kategori['nama_kategori'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">File Upload</label>
                            <input type="file" class="form-control" name="fileToUpload" id="file-upload">
                        </div>

                        <div class="row mb-3">
                        <label class="col-sm-2 col-form-label"> </label>    
                        <div class="col-sm-10">
                        <img src="#" alt="Preview Uploaded Image" id="file-preview" width="300">
                        </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Isi Berita</label>
                            <textarea class="form-control" name="isi_berita" rows="5"></textarea>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                            <button type="reset" class="btn btn-warning" name="reset">Reset</button>
                        </div>
                        <hr>
                    </form>
                </div>
            </div>

        <?php
        break;

    case 'edit':
        include 'koneksi.php';
        $ambil = mysqli_query($db, "SELECT * FROM berita WHERE id='$_GET[id]'");
        $data_berita = mysqli_fetch_array($ambil);
        ?>

            <div class="row">
                <div class="col-6 mx-auto">
                    <br>
                    <h2>Edit Berita</h2>
                    <form action="proses_berita.php?proses=edit" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $data_berita['id'] ?>">

                        <div class="mb-3">
                            <label class="form-label">Judul</label>
                            <input type="text" class="form-control" name="judul" value="<?= $data_berita['judul'] ?>">
                        </div>

                        <div class="mb-3">
                            <div class="mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="kategori_id" class="form-select">
                                    <option value="">Pilih Kategori</option>
                                    <?php
                                    include 'koneksi.php';
                                    $kategori = mysqli_query($db, "SELECT * FROM kategori");
                                    while ($data_kategori = mysqli_fetch_array($kategori)) {
                                        // Pastikan nama kolom sesuai dengan struktur database Anda
                                        echo "<option value='" . $data_kategori['id'] . "'>" . $data_kategori['nama_kategori'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">File Upload</label>
                            <input type="file" name="file_upload" class="form-control" value="<?= $data_berita['file_upload'] ?>" id="file-upload">
                        </div>

                        <img src="uploads/<?= $data_berita['file_upload'] ?>" alt="Preview Uploaded Image" id="file-preview" width="300">

                        <div class="mb-3">
                            <label class="form-label">Isi Berita</label>
                            <textarea class="form-control" name="isi_berita" rows="5"><?= $data_berita['isi_berita'] ?></textarea>
                        </div>

                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" name="submit">Update</button>
                        </div>
                        <hr>
                    </form>
                </div>
            </div>

    <?php
        break;
}
    ?>

<script>
        const input = document.getElementById('file-upload');
        const previewPhoto = () => {
            const file = input.files;
            if (file) {
                const fileReader = new FileReader();
                const preview = document.getElementById('file-preview');
                fileReader.onload = function(event) {
                    preview.setAttribute('src', event.target.result);
                }
                fileReader.readAsDataURL(file[0]);
            }
        }
        input.addEventListener("change", previewPhoto);
    </script>


</div>
<!-- Akhir dari div#layoutSidenav -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>

</body>
</html>
