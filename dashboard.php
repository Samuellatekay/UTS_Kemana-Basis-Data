<?php
    $siswa = mysqli_query($koneksi, "SELECT * FROM siswa");
    $jumlah_siswa = mysqli_num_rows($siswa);
    
    $siswa_lk = mysqli_query($koneksi, "SELECT * FROM siswa where jenis_kelamin='laki-laki'");
    $jumlah_siswa_lk = mysqli_num_rows($siswa_lk);
    
    $siswa_pr = mysqli_query($koneksi, "SELECT * FROM siswa where jenis_kelamin='perempuan'");
    $jumlah_siswa_pr = mysqli_num_rows($siswa_pr);
?>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-center bg-primary text-white mb-4">
                                <div class="card-body card-title"><h1><?php echo $jumlah_siswa; ?></h1></div>
                                <div class="card-footer ">
                                Jumlah Siswa
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-center bg-primary text-white mb-4">
                                <div class="card-body card-title"><h1><?php echo $jumlah_siswa_lk; ?></h1></div>
                                <div class="card-footer ">
                                Siswa Laki-laki
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card text-center bg-primary text-white mb-4">
                                <div class="card-body card-title"><h1><?php echo $jumlah_siswa_pr; ?></h1></div>
                                <div class="card-footer ">
                                Siswa Perempuan
                                </div>
                            </div>
                        </div>
                    </div>                        
                </div>