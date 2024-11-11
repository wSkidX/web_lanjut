<h2>Data Prodi</h2>
<table id="example" class="display" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>id Prodi</th>
            <th>Nama Prodi</th>
            <th>Jenjang</th>
        </tr>
    </thead>
    <tbody>
        <?php
            include 'admin/koneksi.php';
            $prodi = mysqli_query($db, "SELECT * FROM prodi");
            $no = 1;
            while($data_prodi = mysqli_fetch_array($prodi)){
        ?>
        <tr>
            <td><?=$no?></td>
            <td><?=$data_prodi['id']?></td>
            <td><?=$data_prodi['nama_prodi']?></td>
            <td><?=$data_prodi['jenjang']?></td>
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
