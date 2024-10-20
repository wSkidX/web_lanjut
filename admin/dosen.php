<?php
include 'koneksi.php';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'list':
?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Manajemen Dosen</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Dosen</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Daftar Dosen
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="index.php?p=dosen&aksi=input" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Tambah Dosen
                    </a>
                </div>
                <table id="tabelDosen" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama Dosen</th>
                            <th>Email</th>
                            <th>Prodi</th>
                            <th>No Telp</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $ambil = mysqli_query($db, "SELECT dosen.*, prodi.nama_prodi FROM dosen JOIN prodi ON prodi.id = dosen.prodi_id");
                    $no = 1;
                    while ($data = mysqli_fetch_array($ambil)) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['nik'] ?></td>
                            <td><?= $data['nama_dosen'] ?></td>
                            <td><?= $data['email'] ?></td>
                            <td><?= $data['nama_prodi'] ?></td>
                            <td><?= $data['notelp'] ?></td>
                            <td><?= $data['alamat'] ?></td>
                            <td>
                                <a href="index.php?p=dosen&aksi=edit&id=<?= $data['id'] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <a href="proses_dosen.php?proses=delete&id=<?= $data['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i> Hapus</a>
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
        <h1 class="mt-4">Tambah Dosen</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="index.php?p=dosen">Dosen</a></li>
            <li class="breadcrumb-item active">Tambah Dosen</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user-plus me-1"></i>
                Form Tambah Dosen
            </div>
            <div class="card-body">
                <form action="proses_dosen.php?proses=insert" method="post">
                    <div class="mb-3">
                        <label class="form-label">NIP</label>
                        <input type="text" class="form-control" name="nik" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Dosen</label>
                        <input type="text" class="form-control" name="nama_dosen" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prodi</label>
                        <select name="prodi_id" class="form-select" required>
                            <option value="">-Pilih Prodi-</option>
                            <?php
                            $prodi = mysqli_query($db, "SELECT * FROM prodi");
                            while ($data_prodi = mysqli_fetch_array($prodi)) {
                                echo "<option value='" . $data_prodi['id'] . "'>" . $data_prodi['nama_prodi'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No Telp</label>
                        <input type="text" class="form-control" name="notelp" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i> Submit</button>
                        <button type="reset" class="btn btn-secondary" name="reset"><i class="fas fa-undo"></i> Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php
    break;

    case 'edit':
        $ambil = mysqli_query($db, "SELECT * FROM dosen WHERE id='$_GET[id]'");
        $data_dosen = mysqli_fetch_array($ambil);
?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Dosen</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="index.php?p=dosen">Dosen</a></li>
            <li class="breadcrumb-item active">Edit Dosen</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user-edit me-1"></i>
                Form Edit Dosen
            </div>
            <div class="card-body">
                <form action="proses_dosen.php?proses=edit" method="post">
                    <input type="hidden" name="id" value="<?= $data_dosen['id'] ?>">
                    <div class="mb-3">
                        <label class="form-label">NIP</label>
                        <input type="text" class="form-control" name="nik" value="<?= $data_dosen['nik'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Dosen</label>
                        <input type="text" class="form-control" name="nama_dosen" value="<?= $data_dosen['nama_dosen'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?= $data_dosen['email'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Prodi</label>
                        <select name="prodi_id" class="form-select" required>
                            <option value="">-Pilih Prodi-</option>
                            <?php
                            $prodi = mysqli_query($db, "SELECT * FROM prodi");
                            while ($data_prodi = mysqli_fetch_array($prodi)) {
                                $selected = ($data_prodi['id'] == $data_dosen['prodi_id']) ? 'selected' : '';
                                echo "<option value='" . $data_prodi['id'] . "' $selected>" . $data_prodi['nama_prodi'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No Telp</label>
                        <input type="text" class="form-control" name="notelp" value="<?= $data_dosen['notelp'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3" required><?= $data_dosen['alamat'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i> Update</button>
                        <a href="index.php?p=dosen" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
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
        $('#tabelDosen').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
            }
        });
    });
</script>
