<?php
if (!isset($_GET['aksi'])) {
    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Petugas Perpustakaan</h1>
        <div class="card mb-4">
            <div class="card-header">
                <a type="button" class="btn btn-primary" href="index.php?page=petugas&aksi=tambah_petugas">Tambah Petugas</a>
            </div>
            <div class="card-body">
                <table class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Petugas</th>
                            <th>Nama Petugas</th>
                            <th>UserName</th>
                            <th>Password</th>
                            <th>Telp</th>
                            <th>Level</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $petugas = mysqli_query($koneksi, "SELECT * FROM petugas");
                    $no = 1;
                    while ($data = mysqli_fetch_assoc($petugas)) {
                        ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data['id_petugas']; ?></td>
                            <td><?php echo $data['nama_petugas']; ?></td>
                            <td><?php echo $data['username']; ?></td>
                            <td><?php echo str_repeat('*', strlen($data['password'])); ?></td>
                            <td><?php echo $data['telp']; ?></td>
                            <td><?php echo $data['level']; ?></td>
                            <td>
                                <a href="index.php?page=petugas&aksi=edit&id=<?php echo $data['id_petugas'] ?>">Edit</a> |
                                <a href="index.php?page=petugas&aksi=hapus&id=<?php echo $data['id_petugas'] ?>">Hapus</a>
                            </td>
                        </tr>
                        <?php
                        $no++;
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
} elseif ($_GET['aksi'] == 'tambah_petugas') {
    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tambah Petugas</h1>
        <div class="card mb-4 col-md-8">
            <div class="card-header">
                <h5> Tambah Petugas </h5>
            </div>
            <div class="card-body">
                <form action='' method="POST">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="a">
                        <label>Id Petugas</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="b">
                        <label>Nama Petugas</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="c">
                        <label>UserName</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="password" name="d">
                        <label>Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="e">
                        <label>Telp</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="f">
                            <option value="admin">Admin</option>
                            <option value="petugas">Petugas</option>
                        </select>
                        <label>Level</label>
                    </div>
                    <div class="d-grid">
                        <button class="btn btn-primary btn-block" type="submit" name="simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
if (isset($_POST['simpan'])){
    $dir_foto = 'foto/';
    $filename = basename($_FILES['']['name']);
    $uploadfile = $dir_foto . $filename;
    $level = $_POST['f'];
        if ($filename != ''){
            if (move_uploaded_file($_FILES['e']['tmp_name'], $uploadfile)) {            
                mysqli_query($koneksi,"INSERT INTO petugas (id_petugas, nama_petugas, username, password, telp, level)           
                                VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]','$level')");
                
                echo "<script>window.alert('Sukses Menambahkan Petugas.');
                        window.location='petugas'</script>";
            }else{
                echo "<script>window.alert('Gagal Menambahkan Petugas.');
                        window.location='index.php?page=petugas&aksi=tambah'</script>";
            }
        }else{
                mysqli_query($koneksi,"INSERT INTO petugas (id_petugas, nama_petugas, username, password, telp, level)          
                VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]','$_POST[f]')");
                            
                echo "<script>window.alert('Sukses Menambakan petugas .');
                        window.location='petugas'</script>";
        }
}
}elseif ($_GET['aksi']=='edit'){
    $petugas = mysqli_query($koneksi, "SELECT * FROM petugas where id_petugas='$_GET[id]'");
    $data = mysqli_fetch_array($petugas);       
?>
<div class="container-fluid px-4">
                <h1 class="mt-4">Petugas</h1>                      
                <div class="card mb-4 col-md-8">
                    <div class="card-header">
                <h5> Update Petugas</h5>
                    </div>
                    <div class="card-body">
                        <form action=''  method="POST" enctype='multipart/form-data'>      
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="a" value="<?php echo $data['id_petugas']; ?>">
                                <label>Id Petugas</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="b" value="<?php echo $data['nama_petugas']; ?>">
                                <label>Nama Petugas</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="c" value="<?php echo $data['username']; ?>">
                                <label>UserName</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="d" value="<?php echo $data['password']; ?>">
                                <label>Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="e" value="<?php echo $data['telp']; ?>">
                                <label>Telp</label>
                            </div>
                            <div class="form-floating mb-3">
                                <select class="form-select" name="f">
                                    <option value="admin">admin</option>
                                    <option value="petugas">petugas</option>
                                </select>
                                <label>Level</label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary btn-block" type="submit" name="update">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
</div>
<?php
if (isset($_POST['update'])) {
    include 'koneksi.php'; // Sertakan file koneksi ke database

    // Ambil data dari $_POST
    $id_petugas    = $_POST['a'];
    $nama_petugas  = $_POST['b'];
    $username      = $_POST['c'];
    $password      = $_POST['d'];
    $telp          = $_POST['e'];
    $level         = $_POST['f'];

    // Lakukan pembaruan data ke database
    $query = "UPDATE petugas SET
        nama_petugas = '$nama_petugas',
        username            = '$username',
        password            = '$password',
        telp                = '$telp',
        level               = '$level'
        WHERE id_petugas    = '$id_petugas'";  // Hapus tanda koma setelah $level

    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>window.alert('Sukses Update Data petugas.');
                window.location='petugas'</script>";
    } else {
        echo "<script>window.alert('Gagal Update Data petugas: " . mysqli_error($koneksi) . "');
                window.location='petugas'</script>";
    }
}
}elseif ($_GET['aksi']=='hapus'){ 
	mysqli_query($koneksi, "DELETE FROM petugas where id_petugas='$_GET[id]'");
	echo "<script>window.alert('Data Petugas Berhasil Di Hapus.');
                                window.location='petugas'</script>";
}
?>
