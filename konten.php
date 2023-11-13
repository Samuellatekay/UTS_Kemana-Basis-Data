<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membuat Admin Template</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="js/all.js"></script>
</head>
<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Awal Header-->
        <?php
            include "header.php";
        ?>
        <!-- Akhir Header-->
    </nav>

    <div id="layoutSidenav">            
        <div id="layoutSidenav_nav">
        <!-- Awal Menu Sidebar-->
        <?php
            include "sidebar.php";
        ?>    
        <!-- Akhir Menu Sidebar-->
        </div>         

        <div id="layoutSidenav_content">
            <main>
<?php
if (!isset($_GET['page'])){
    include "pengenalan.php";
}elseif ($_GET['page'] == 'siswa'){
    include "siswa.php";
}elseif ($_GET['page'] == 'perpustakaan'){
    include "perpustakaan.php";
}elseif ($_GET['page'] == 'peminjaman'){
    include "peminjaman.php";
}elseif ($_GET['page'] == 'anggota'){
    include "anggota.php";
}elseif ($_GET['page'] == 'petugas'){
    include "petugas.php";
}elseif ($_GET['page'] == 'pengenalan'){
    include "pengenalan.php";
}else{
    echo "Maaf, halaman tidak ditemukan!";
}
?>
</main>

    <footer class="py-4 bg-light mt-auto">
    <!-- Awal Footer-->
        <?php
            include "footer.php";
        ?>    
    <!-- Akhir Footer-->
    </footer>
</div>
</div>

<script src="js/scripts.js"></script>
<script src="js/datatables-simple-demo.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/simple-datatables.js"></script>
<script src="js/Chart.min.js"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>   
</body>
</html>