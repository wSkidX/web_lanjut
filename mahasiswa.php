<h2>Data Mahasiswa</h2>
<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>NIM</th>
            <th>Nama Mahasiswa</th>
            <th>Email</th>
            <th>No Telp</th>
            <th>Alamat</th>
            <th>Prodi</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include 'admin/koneksi.php';
            $mhs= mysqli_query($db, "SELECT mahasiswa.*, prodi.nama_prodi FROM mahasiswa JOIN prodi ON mahasiswa.prodi_id = prodi.id");
            $no = 1;
            while($data_mhs=mysqli_fetch_array($mhs)){
        ?>
        <tr>
            <td><?=$no?></td>
            <td><?=$data_mhs['nim']?></td>
            <td><?=$data_mhs['nama']?></td>
            <td><?=$data_mhs['email']?></td>
            <td><?=$data_mhs['no_telp']?></td>
            <td><?=$data_mhs['alamat']?></td>
            <td><?=$data_mhs['nama_prodi']?></td>
        </tr>
        <?php
            $no++;
            }
        ?>
    </tbody>
</table>

<button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahMahasiswaModal">
    Tambah Data Mahasiswa
</button>

<script>
$(document).ready(function() {
    $('#example').DataTable();
});
</script>