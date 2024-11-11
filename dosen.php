<h2>Data Dosen</h2>
<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama Dosen</th>
            <th>Email</th>
            <th>No Telp</th>
            <th>Alamat</th>
            <th>Prodi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include 'admin/koneksi.php';
            $dosen = mysqli_query($db, "SELECT dosen.*, prodi.nama_prodi FROM dosen JOIN prodi ON dosen.prodi_id = prodi.id");
            $no = 1;
            while($data_dosen = mysqli_fetch_array($dosen)){
        ?>
        <tr>
            <td><?=$no?></td>
            <td><?=$data_dosen['nik']?></td>
            <td><?=$data_dosen['nama_dosen']?></td>
            <td><?=$data_dosen['email']?></td>
            <td><?=$data_dosen['notelp']?></td>
            <td><?=$data_dosen['alamat']?></td>
            <td><?=$data_dosen['nama_prodi']?></td>
        </tr>
        <?php
            $no++;
            }
        ?>
    </tbody>
</table>

<script>
$(document).ready(function() {
    $('#example').DataTable();
});
</script>
