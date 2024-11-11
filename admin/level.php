<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Level User</h1>
      </div>
<?php 
include 'koneksi.php';
$aksi = isset($_GET['aksi']) ? $_GET['aksi'] : 'list';
switch ($aksi) {
    case 'list':
?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Manajemen Level User</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Level User</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Daftar Level User
            </div>
            <div class="card-body">
                <table id="tabelLevel" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Level</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($db, "SELECT user.*, level.nama_level, level.keterangan 
                             FROM user 
                             LEFT JOIN level ON user.level_id = level.id 
                             WHERE user.level_id IN (0,1)
                             ORDER BY user.level_id ASC");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?=$no++?></td>
                            <td><?=$data['nama']?></td>
                            <td><?=$data['nama_level']?></td>
                            <td><?=$data['keterangan']?></td>
                            <td>
                                <a href="index.php?p=level&aksi=edit&id=<?=$data['id']?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
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

    case 'edit':
        $id = $_GET['id'];
        $query = mysqli_query($db, "SELECT user.*, level.nama_level, level.keterangan 
                 FROM user 
                 LEFT JOIN level ON user.level_id = level.id 
                 WHERE user.id='$id'");
        $data = mysqli_fetch_array($query);
?>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Edit Level User</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="index.php?p=level">Level User</a></li>
                <li class="breadcrumb-item active">Edit Level User</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-edit me-1"></i>
                    Form Edit Level User
                </div>
                <div class="card-body">
                    <form action="proses_level.php?proses=edit" method="post">
                        <div class="mb-3">
                            <label class="form-label">Nama User</label>
                            <input type="hidden" name="id" value="<?=$data['id']?>">
                            <input type="text" class="form-control" value="<?=$data['nama']?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Level</label>
                            <select class="form-control" name="level_id" required>
                                <option value="">-- Pilih Level --</option>
                                <?php
                                $query_level = mysqli_query($db, "SELECT * FROM level ORDER BY id ASC");
                                while($level = mysqli_fetch_array($query_level)) {
                                    $selected = ($data['level_id'] == $level['id']) ? 'selected' : '';
                                ?>
                                    <option value="<?=$level['id']?>" <?=$selected?>><?=$level['nama_level']?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea class="form-control" readonly><?=$data['keterangan']?></textarea>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary" name="submit"><i class="fas fa-save"></i> Update</button>
                            <a href="index.php?p=level" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php
        break;
}
?>
        

