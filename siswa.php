<?php 
if (!isset($_GET['aksi'])){
?>
    <div class="container-fluid px-4">
                <h1 class="mt-4">Data Siswa</h1>                      
                <div class="card mb-4">
                    <div class="card-header">
                        <a type="button" class="btn btn-primary" href="index.php?page=siswa&aksi=tambah">Tambah Siswa</a>
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $siswa=mysqli_query($koneksi, "SELECT * FROM siswa");
                            $no = 1;
                            while ($data = mysqli_fetch_array($siswa)){
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $data['nis']; ?></td>
                                    <td><?php echo $data['nama_siswa']; ?></td>
                                    <td><?php echo $data['jenis_kelamin']; ?></td>
                                    <td><?php echo $data['alamat']; ?></td>
                                    <td><a href="index.php?page=siswa&aksi=edit&id=<?php echo $data['id_siswa'] ?>">Edit</a> | 
                                        <a href="index.php?page=siswa&aksi=hapus&id=<?php echo $data['id_siswa'] ?>">Hapus</a></td>
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
}elseif ($_GET['aksi']=='tambah'){     
?>
<div class="container-fluid px-4">
                <h1 class="mt-4">Data Siswa</h1>                      
                <div class="card mb-4 col-md-8">
                    <div class="card-header">
                       <h5> Tambah Siswa </h5>
                    </div>
                    <div class="card-body">
                        <form action=''  method="POST" enctype='multipart/form-data'>                        
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" name="a">
                                    <label>NIS</label>                                
                                </div>                            
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" name="b">
                                    <label>Nama Siswa</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" name="c">
                                    <label>Jenis Kelamin</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="text" name="d">
                                    <label>Alamat</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input class="form-control" type="file" name="e">
                                    <label>Foto Siswa</label>
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
    $filename = basename($_FILES['e']['name']);
    $uploadfile = $dir_foto . $filename;
        if ($filename != ''){
            if (move_uploaded_file($_FILES['e']['tmp_name'], $uploadfile)) {            
                mysqli_query($koneksi,"INSERT INTO siswa (nis, nama_siswa, jenis_kelamin, alamat, foto_siswa)           
                                VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$filename')");
                
                echo "<script>window.alert('Sukses Menambahkan Data Siswa.');
                        window.location='siswa'</script>";
            }else{
                echo "<script>window.alert('Gagal Menambahkan Data Siswa.');
                        window.location='index.php?page=siswa&aksi=tambah'</script>";
            }
        }else{
                mysqli_query($koneksi,"INSERT INTO siswa (nis, nama_siswa, jenis_kelamin, alamat)           
                VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]')");
                            
                echo "<script>window.alert('Sukses Menambahkan Data Siswa .');
                        window.location='siswa'</script>";
        }
}
}elseif ($_GET['aksi']=='edit'){
    $siswa = mysqli_query($koneksi, "SELECT * FROM siswa where id_siswa='$_GET[id]'");
    $data = mysqli_fetch_array($siswa);       
?>
<div class="container-fluid px-4">
                <h1 class="mt-4">Data Siswa</h1>                      
                <div class="card mb-4 col-md-8">
                    <div class="card-header">
                       <h5> Update Siswa </h5>
                    </div>
                    <div class="card-body">
                        <form action=''  method="POST" enctype='multipart/form-data'>      
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="a" value="<?php echo $data['nis']; ?>">
                                <label>NIS</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="b" value="<?php echo $data['nama_siswa']; ?>">
                                <label>Nama Siswa</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="c" value="<?php echo $data['jenis_kelamin']; ?>">
                                <label>Jenis Kelamin</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="text" name="d" value="<?php echo $data['alamat']; ?>">
                                <label>Alamat</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" type="file" name="e">
                                <label>Foto Siswa</label>
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-primary btn-block" type="submit" name="update">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
</div>
<?php
if (isset($_POST['update'])){
    $dir_foto = 'foto/';
    $filename = basename($_FILES['e']['name']);
    $uploadfile = $dir_foto . $filename;
        if ($filename != ''){
            if (move_uploaded_file($_FILES['e']['tmp_name'], $uploadfile)) {            
                mysqli_query($koneksi,"UPDATE siswa SET nis             = '$_POST[a]',
                                                        nama_siswa      = '$_POST[b]',
                                                        jenis_kelamin   = '$_POST[c]',
                                                        alamat          = '$_POST[d]',
                                                        foto_siswa      = '$filename' where id_siswa = '$_GET[id]'");           
                echo "<script>window.alert('Sukses Update Data Siswa.');
                        window.location='siswa'</script>";
            }else{
                echo "<script>window.alert('Gagal Update Data Siswa.');
                        window.location='index.php?page=siswa&aksi=tambah'</script>";
            }
        }else{
                mysqli_query($koneksi,"UPDATE siswa SET nis             = '$_POST[a]',
                                                        nama_siswa      = '$_POST[b]',
                                                        jenis_kelamin   = '$_POST[c]',
                                                        alamat          = '$_POST[d]',
                                                        foto_siswa      = '$filename' where id_siswa = '$_GET[id]'");                               
                echo "<script>window.alert('Sukses Update Data Siswa .');
                        window.location='siswa'</script>";
        }
}
}elseif ($_GET['aksi']=='hapus'){ 
	mysqli_query($koneksi, "DELETE FROM siswa where id_siswa='$_GET[id]'");
	echo "<script>window.alert('Data Siswa Berhasil Di Hapus.');
                                window.location='siswa'</script>";
}
?>