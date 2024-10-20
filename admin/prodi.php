<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Prodi</h1>
      </div>
<?php 
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'list':
?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Manajemen Program Studi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Program Studi</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Daftar Program Studi
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="index.php?p=prodi&aksi=input" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Program Studi
                    </a>
                </div>
                <table id="tabelProdi" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Prodi</th>
                            <th>Jenjang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    include 'koneksi.php';
                    $ambil = mysqli_query($db, "SELECT * FROM prodi");
                    while ($data = mysqli_fetch_array($ambil)) {
                    ?>
                        <tr>
                            <td><?=$data['id']?></td>
                            <td><?=$data['nama_prodi']?></td>
                            <td><?=$data['jenjang']?></td>
                            <td>
                                <a href="index.php?p=prodi&aksi=edit&id=<?=$data['id']?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <a href="proses_prodi.php?proses=delete&id=<?=$data['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i> Hapus</a>
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
        <h1 class="mt-4">Tambah Program Studi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="index.php?p=prodi">Program Studi</a></li>
            <li class="breadcrumb-item active">Tambah Program Studi</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-plus me-1"></i>
                Form Tambah Program Studi
            </div>
            <div class="card-body">
                <form action="proses_prodi.php?proses=insert" method="post">
                    <div class="mb-3">
                        <label class="form-label">Nama Prodi</label>
                        <input type="text" class="form-control" name="nama_prodi" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenjang</label>
                        <select class="form-select" name="jenjang" required>
                            <option value="" disabled selected>~ Pilih Jenjang ~</option>
                            <?php
                                $jenjang = ['D3', 'D4', 'S1', 'S2'];
                                foreach ($jenjang as $jenjangprodi) {
                                    echo "<option value=".$jenjangprodi.">".$jenjangprodi."</option>";
                                }
                            ?>
                        </select> 
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
        include 'koneksi.php';
        $ambil = mysqli_query($db, "SELECT * FROM prodi WHERE id='$_GET[id]'");
        $data_prodi = mysqli_fetch_array($ambil);
?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Edit Program Studi</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="index.php?p=prodi">Program Studi</a></li>
            <li class="breadcrumb-item active">Edit Program Studi</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-edit me-1"></i>
                Form Edit Program Studi
            </div>
            <div class="card-body">
                <form action="proses_prodi.php?proses=edit" method="post">
                    <input type="hidden" name="id" value="<?=$data_prodi['id'] ?>">
                    <div class="mb-3">
                        <label class="form-label">Nama Prodi</label>
                        <input type="text" class="form-control" name="nama_prodi" value="<?=$data_prodi['nama_prodi'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenjang</label>
                        <select class="form-select" name="jenjang" required>
                            <option value="" disabled>~ Pilih Jenjang ~</option>
                            <?php
                                $jenjang = ['D3', 'D4', 'S1', 'S2'];
                                foreach ($jenjang as $jenjangprodi) {
                                    $selected = ($data_prodi['jenjang'] == $jenjangprodi) ? 'selected' : ''; 
                                    echo "<option value=".$jenjangprodi." $selected>".$jenjangprodi."</option>";
                                }
                            ?>
                        </select> 
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i> Update</button>
                        <a href="index.php?p=prodi" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
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
        $('#tabelProdi').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/id.json"
            }
        });
    });
</script>
