<?php
if (!isset($_GET['aksi'])) {
?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Anggota Perpustakaan</h1>
        <div class="card mb-4">
            <div class="card-header">
                <a type="button" class="btn btn-primary" href="index.php?page=anggota&aksi=tambah_anggota">Tambah Anggota</a>
            </div>
            <div class="card-body">
                <table class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Anggota</th>
                            <th>Nama</th>
                            <th>UserName</th>
                            <th>Password</th>
                            <th>Telp</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $anggota = mysqli_query($koneksi, "SELECT * FROM anggota");
                        $no = 1;
                        while ($data = mysqli_fetch_assoc($anggota)) {
                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $data['id_anggota']; ?></td>
                                <td><?php echo $data['nama']; ?></td>
                                <td><?php echo $data['username']; ?></td>
                                <td><?php echo str_repeat('*', strlen($data['password'])); ?></td>
                                <td><?php echo $data['telp']; ?></td>
                                <td>
                                    <a href="index.php?page=anggota&aksi=edit&id=<?php echo $data['id_anggota'] ?>">Edit</a> |
                                    <a href="index.php?page=anggota&aksi=hapus&id=<?php echo $data['id_anggota'] ?>">Hapus</a>
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
} elseif ($_GET['aksi'] == 'tambah_anggota') {
?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tambah Anggota</h1>
        <div class="card mb-4 col-md-8">
            <div class="card-header">
                <h5> Tambah Anggota </h5>
            </div>
            <div class="card-body">
                <form action='' method="POST">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="a">
                        <label>Id Anggota</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="b">
                        <label>Nama</label>
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
                    <div class="d-grid">
                        <button class="btn btn-primary btn-block" type="submit" name="simpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['simpan'])) {
        $dir_foto = 'foto/';
        $filename = basename($_FILES['']['name']);
        $uploadfile = $dir_foto . $filename;
        if ($filename != '') {
            if (move_uploaded_file($_FILES['e']['tmp_name'], $uploadfile)) {
                mysqli_query($koneksi, "INSERT INTO anggota (id_anggota, nama, username, password, telp)           
                                VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]')");

                echo "<script>window.alert('Sukses Menambahkan Anggota.');
                        window.location='anggota'</script>";
            } else {
                echo "<script>window.alert('Gagal Menambahkan Anggota.');
                        window.location='index.php?page=anggota&aksi=tambah'</script>";
            }
        } else {
            mysqli_query($koneksi, "INSERT INTO anggota (id_anggota, nama, username, password, telp)          
                VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$_POST[e]')");

            echo "<script>window.alert('Sukses Menambakan Anggota .');
                        window.location='anggota'</script>";
        }
    }
} elseif ($_GET['aksi'] == 'edit') {
    $anggota = mysqli_query($koneksi, "SELECT * FROM anggota where id_anggota='$_GET[id]'");
    $data = mysqli_fetch_array($anggota);
    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Anggota</h1>
        <div class="card mb-4 col-md-8">
            <div class="card-header">
                <h5> Update Anggota </h5>
            </div>
            <div class="card-body">
                <form action='' method="POST" enctype='multipart/form-data'>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="a" value="<?php echo $data['id_anggota']; ?>">
                        <label>Id Anggota</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="b" value="<?php echo $data['nama']; ?>">
                        <label>Nama</label>
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
        $id_anggota    = $_POST['a'];
        $nama          = $_POST['b'];
        $username      = $_POST['c'];
        $password      = $_POST['d'];
        $telp          = $_POST['e'];

        // Lakukan pembaruan data ke database
        $query = "UPDATE anggota SET
        nama                    = '$nama',
        username                = '$username',
        password                = '$password',
        telp                    = '$telp'
        WHERE id_anggota        = $id_anggota";

        $result = mysqli_query($koneksi, $query);

        if ($result) {
            echo "<script>window.alert('Sukses Update Data anggota.');
                window.location='anggota'</script>";
        } else {
            echo "<script>window.alert('Gagal Update Data anggota: " . mysqli_error($koneksi) . "');
                window.location='anggota'</script>";
        }
    }
} elseif ($_GET['aksi'] == 'hapus') {
    mysqli_query($koneksi, "DELETE FROM anggota where id_anggota='$_GET[id]'");
    echo "<script>window.alert('Data Anggota Berhasil Di Hapus.');
                                window.location='anggota'</script>";
}
?>