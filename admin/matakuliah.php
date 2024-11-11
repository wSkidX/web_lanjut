<?php 
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'list': 
?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Manajemen Matakuliah</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Matakuliah</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Daftar Matakuliah
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="index.php?p=matakuliah&aksi=input" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Matakuliah
                    </a>
                </div>
                <table id="dataMatakuliah" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Matakuliah</th>
                            <th>Nama Matakuliah</th>
                            <th>Semester</th>
                            <th>Jenis Matakuliah</th>
                            <th>SKS</th>
                            <th>Jam</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    include 'koneksi.php';
                    $ambil = mysqli_query($db, "SELECT * FROM matakuliah");
                    $no = 1;
                    while ($data = mysqli_fetch_array($ambil)) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['kode_matakuliah'] ?></td>
                            <td><?= $data['nama_matakuliah'] ?></td>
                            <td><?= $data['semester'] ?></td>
                            <td><?= $data['jenis_matakuliah'] ?></td>
                            <td><?= $data['sks'] ?></td>
                            <td><?= $data['jam'] ?></td>
                            <td><?= $data['keterangan'] ?></td>
                            <td>
                                <a href="index.php?p=matakuliah&aksi=edit&id=<?= $data['id'] ?>" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i> Edit</a>
                                <a href="proses_matakuliah.php?proses=delete&id=<?= $data['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php
    break;

    case 'input':
?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tambah Matakuliah</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="index.php?p=matakuliah">Matakuliah</a></li>
            <li class="breadcrumb-item active">Tambah Matakuliah</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-plus me-1"></i>
                Form Tambah Matakuliah
            </div>
            <div class="card-body">
                <form action="proses_matakuliah.php?proses=insert" method="post">
                    <div class="mb-3">
                        <label class="form-label">Kode Matakuliah</label>
                        <input type="text" class="form-control" name="kode_matakuliah" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Matakuliah</label>
                        <input type="text" class="form-control" name="nama_matakuliah" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Semester</label>
                        <input type="number" class="form-control" name="semester" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Matakuliah</label>
                        <select class="form-select" name="jenis_matakuliah" required>
                            <option value="" disabled>~ Pilih Jenis Matakuliah ~</option>
                            <option value="Teori">Teori</option>
                            <option value="Praktek">Praktek</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">SKS</label>
                        <input type="number" class="form-control" name="sks" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jam</label>
                        <input type="text" class="form-control" name="jam" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" rows="3" name="keterangan" required></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i> Simpan</button>
                        <button type="reset" class="btn btn-secondary" name="reset"><i class="fas fa-undo"></i> Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
    break;

    case 'edit' :
        include 'koneksi.php';
        $ambil = mysqli_query($db, "SELECT * FROM matakuliah WHERE id='$_GET[id]'");
        $data_matakuliah = mysqli_fetch_array($ambil);
?>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Matakuliah</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="index.php?p=matakuliah">Matakuliah</a></li>
                <li class="breadcrumb-item active">Edit Matakuliah</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-edit me-1"></i>
                    Form Edit Matakuliah
                </div>
                <div class="card-body">
                    <form action="proses_matakuliah.php?proses=edit" method="post">
                        <div class="mb-3">
                            <label class="form-label">ID</label>
                            <input type="number" class="form-control" name="id" value="<?= $data_matakuliah['id'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kode Matakuliah</label>
                            <input type="text" class="form-control" name="kode_matakuliah" value="<?= $data_matakuliah['kode_matakuliah'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Matakuliah</label>
                            <input type="text" class="form-control" name="nama_matakuliah" value="<?= $data_matakuliah['nama_matakuliah'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Semester</label>
                            <input type="number" class="form-control" name="semester" value="<?= $data_matakuliah['semester'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Matakuliah</label>
                            <input type="text" class="form-control" name="jenis_matakuliah" value="<?= $data_matakuliah['jenis_matakuliah'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">SKS</label>
                            <input type="number" class="form-control" name="sks" value="<?= $data_matakuliah['sks'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jam</label>
                            <input type="text" class="form-control" name="jam" value="<?= $data_matakuliah['jam'] ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea class="form-control" rows="3" name="keterangan" required><?= htmlspecialchars($data_matakuliah['keterangan']) ?></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i> Update</button>
                            <a href="index.php?p=matakuliah" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php 
    break;
}
?>

<script>
    $(document).ready(function() {
        $('#dataMatakuliah').DataTable();
    });
</script>
