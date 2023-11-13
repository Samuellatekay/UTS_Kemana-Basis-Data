<style>
    body {
        background-image: linear-gradient(to bottom, #007BFF, #0056b3);
        background-repeat: no-repeat;
        background-attachment: fixed;
    }
</style>
<div class="container-fluid px-4">
    <h1 class="mt-4">Selamat Datang di Perpustakaan</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card text-center mb-2">
                <div class="card-body">
                    <img src="sam.png" alt="Samuel Latekay" width="400" height="400">
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h2>Nama    : Samuel Latekay</h2>
            <h2>NIM     : 8803202210</h2>
            <p>Di Perpustakaan, Saya mengundang Anda untuk menjelajahi dunia buku. Dengan koleksi buku yang beragam, Saya siap memenuhi kebutuhan membaca Anda.</p>
            <p>Saya menyediakan tempat yang nyaman dan ramah bagi pencinta buku dari segala usia. Jangan ragu untuk mengunjungi Perpustakaan Mike dan temukan buku-buku terbaru atau klasik yang Anda cari.</p>
            <p>Jika Anda memiliki pertanyaan atau memerlukan bantuan, jangan ragu untuk menghubungi Saya. Saya dengan senang hati akan membantu Anda dalam perjalanan membaca Anda.</p>
        </div>
    </div>
</div>

<!-- Tambahkan efek interaktif dengan JavaScript -->
<script>
    // Efek hover pada gambar
    const image = document.querySelector("img");
    image.addEventListener("mouseover", function () {
        image.style.transform = "scale(1.1)";
    });

    image.addEventListener("mouseout", function () {
        image.style.transform = "scale(1)";
    });
</script>
