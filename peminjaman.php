<?php
if (!isset($_GET['aksi'])) {
?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Peminjaman Buku</h1>
        <div class="card mb-4">
            <div class="card-header">
                <a type="button" class="btn btn-primary" href="index.php?page=peminjaman&aksi=tambah_peminjaman">Peminjaman</a>
            </div>
            <div class="card-body">
                <table class="table" id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Id Peminjaman</th>
                            <th>Kode Buku</th>
                            <th>Id Anggota</th>
                            <th>Id Petugas</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $peminjaman = mysqli_query($koneksi, "SELECT * FROM peminjaman");
                        $no = 1;
                        while ($data = mysqli_fetch_assoc($peminjaman)) {
                        ?>
                            <tr>
                                <td><?php echo $no; ?></td>
                                <td><?php echo $data['id_peminjaman']; ?></td>
                                <td><?php echo $data['kode_buku']; ?></td>
                                <td><?php echo $data['id_anggota']; ?></td>
                                <td><?php echo $data['id_petugas']; ?></td>
                                <td><?php echo $data['tgl_pinjam']; ?></td>
                                <td><?php echo $data['tgl_kembali']; ?></td>
                                <td><?php echo $data['status']; ?></td>
                                <td>
                                    <a href="index.php?page=peminjaman&aksi=edit&id=<?php echo $data['id_peminjaman'] ?>">Edit</a> |
                                    <a href="index.php?page=peminjaman&aksi=hapus&id=<?php echo $data['id_peminjaman'] ?>">Hapus</a>
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
} elseif ($_GET['aksi'] == 'tambah_peminjaman') {
?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Tambah Peminjaman Buku</h1>
        <div class="card mb-4 col-md-8">
            <div class="card-header">
                <h5> Tambah Peminjaman Buku </h5>
            </div>
            <div class="card-body">
                <form action='' method="POST">
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="a">
                        <label>Id Peminjaman</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="b">
                        <label>Kode Buku</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="c">
                        <label>Id Anggota</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="d">
                        <label>Id Petugas</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="date" name="e">
                        <label>Tanggal Pinjam</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="date" name="f">
                        <label>Tanggal Kembali</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="g">
                            <option value="pengajuan">Pengajuan</option>
                            <option value="proses">Proses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                        <label>Status</label>
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
        $tanggal_pinjam = $_POST['e']; // Nilai tanggal peminjaman yang dipilih
        $tanggal_kembali = $_POST['f']; // Nilai tanggal kembali yang dipilih
        $status = $_POST['g']; // Nilai status yang dipilih
        if ($filename != '') {
            if (move_uploaded_file($_FILES['d']['tmp_name'], $uploadfile)) {
                mysqli_query($koneksi, "INSERT INTO peminjaman (id_peminjaman, Kode_Buku, id_anggota, id_petugas, tgl_pinjam, tgl_kembali, status)
                        VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$tanggal_pinjam','$tanggal_kembali','$status')");

                echo "<script>window.alert('Sukses Menambahkan Peminjaman Buku.');
                    window.location='peminjaman'</script>";
            } else {
                echo "<script>window.alert('Gagal Menambahkan Peminjaman Buku.');
                    window.location='index.php?page=peminjaman&aksi=tambah'</script>";
            }
        } else {
            mysqli_query($koneksi, "INSERT INTO peminjaman (id_peminjaman, Kode_Buku, id_anggota, id_petugas, tgl_pinjam, tgl_kembali, status)           
                    VALUES('$_POST[a]','$_POST[b]','$_POST[c]','$_POST[d]','$tanggal_pinjam','$tanggal_kembali','$_POST[g]')");

            echo "<script>window.alert('Sukses Menambahkan Peminjaman Buku.');
                window.location='peminjaman'</script>";
        }
    }
} elseif ($_GET['aksi'] == 'edit') {
    $peminjaman = mysqli_query($koneksi, "SELECT * FROM peminjaman where id_peminjaman='$_GET[id]'");
    $data = mysqli_fetch_array($peminjaman);
    ?>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Peminjaman Buku </h1>
        <div class="card mb-4 col-md-8">
            <div class="card-header">
                <h5> Update Data Peminjaman </h5>
            </div>
            <div class="card-body">
                <form action='' method="POST" enctype='multipart/form-data'>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="a" value="<?php echo $data['id_peminjaman']; ?>">
                        <label>Id Peminjaman</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="b" value="<?php echo $data['kode_buku']; ?>">
                        <label>Kode Buku</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="c" value="<?php echo $data['id_anggota']; ?>">
                        <label>Id Anggota</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="text" name="d" value="<?php echo $data['id_petugas']; ?>">
                        <label>Id Petugas</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="date" name="e" value="<?php echo $data['tgl_pinjam']; ?>">
                        <label>Tanggal Peminjaman</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" type="date" name="f" value="<?php echo $data['tgl_kembali']; ?>">
                        <label>Tanggal Kembali</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" name="g">
                            <option value="pengajuan">Pengajuan</option>
                            <option value="proses">Proses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                        <label>Status</label>
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
        $id_peminjaman       = $_POST['a'];
        $kode_buku           = $_POST['b'];
        $id_anggota          = $_POST['c'];
        $id_petugas          = $_POST['d'];
        $tgl_pinjam          = $_POST['e']; // Ambil tanggal peminjaman yang diubah
        $tgl_kembali         = $_POST['f']; // Ambil tanggal kembali yang diubah
        $status              = $_POST['g'];

        // Lakukan pembaruan data ke database
        $query = "UPDATE peminjaman SET
        kode_buku                 = '$kode_buku',
        id_anggota                = '$id_anggota',
        id_petugas                = '$id_petugas',
        tgl_pinjam                = '$tgl_pinjam',
        tgl_kembali               = '$tgl_kembali', 
        status                    = '$status'
        WHERE id_peminjaman       = '$id_peminjaman'";

        $result = mysqli_query($koneksi, $query);

        if ($result) {
            echo "<script>window.alert('Sukses Update Data Peminjaman.');
                window.location='peminjaman'</script>";
        } else {
            echo "<script>window.alert('Gagal Update Data Peminjaman: " . mysqli_error($koneksi) . "');
                window.location='Peminjaman'</script>";
        }
    }
} elseif ($_GET['aksi'] == 'hapus') {
    mysqli_query($koneksi, "DELETE FROM peminjaman where id_peminjaman='$_GET[id]'");
    echo "<script>window.alert('Data Peminjaman Berhasil Di Hapus.');
                                window.location='peminjaman'</script>";
}
?>