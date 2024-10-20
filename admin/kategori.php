<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Kategori</h1>
      </div>
<?php 
include 'koneksi.php';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'list':
?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Manajemen Kategori</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Kategori</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Daftar Kategori
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <a href="index.php?p=kategori&aksi=input" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Kategori
                    </a>
                </div>
                <table id="tabelKategori" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Kategori</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $ambil = mysqli_query($db, "SELECT * FROM kategori");
                    while ($data = mysqli_fetch_array($ambil)) {
                    ?>
                        <tr>
                            <td><?=$data['id']?></td>
                            <td><?=$data['nama_kategori']?></td>
                            <td><?=$data['keterangan']?></td>
                            <td>
                                <a href="index.php?p=kategori&aksi=edit&id=<?=$data['id']?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <a href="proses_kategori.php?proses=delete&id=<?=$data['id']?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i> Hapus</a>
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
        <h1 class="mt-4">Tambah Kategori</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="index.php?p=kategori">Kategori</a></li>
            <li class="breadcrumb-item active">Tambah Kategori</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-plus me-1"></i>
                Form Tambah Kategori
            </div>
            <div class="card-body">
                <form action="proses_kategori.php?proses=insert" method="post">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control" name="nama_kategori" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="5" required></textarea>  
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
        $ambil=mysqli_query($db,"SELECT * FROM kategori WHERE id='$_GET[id]'");
        $data_prodi=mysqli_fetch_array($ambil);
?>

        <div class="row">
            <div class="col-6 mx-auto">
                <br>
                <h2>Data Kategori</h2>
                <form action="proses_kategori.php?proses=edit" method="post">
                <div class="mb-3">
                    <label class="form-label">Nama Kategori</label>
                    <input type="hidden" class="form-control" name="id" value="<?=$data_kategori['id'] ?>">
                    <input type="text" class="form-control" name="nama_kategori" value="<?=$data_kategori['nama_kategori'] ?>">
                </div>
                
              
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="10"></textarea>     
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
        

