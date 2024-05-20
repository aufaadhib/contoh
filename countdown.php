<?php
include "koneksi.php";


// Ambil tanggal rencana berobat dari database
$query = "SELECT MAX(rencana_berobat) AS jadwal FROM riwayat_berobat  WHERE id_pasien=11";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$tanggal_rencana = $row['jadwal'];
// Tampilkan tanggal rencana berobat di halaman HTML
echo "<span id='tanggal_rencana' style='display:none;'>$tanggal_rencana</span>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countdown Live</title>
</head>
<body>
    <h1>Countdown Live</h1>
    <div id="countdown"></div>

    <script>
        // Ambil tanggal rencana berobat dari PHP
        var tanggalRencana = document.getElementById('tanggal_rencana').innerText;

        // Fungsi untuk menghitung mundur dan memperbarui tampilan
        function updateCountdown() {
            var tanggalBerobat = new Date(tanggalRencana).getTime();
            var sekarang = new Date().getTime();
            var selisihWaktu = tanggalBerobat - sekarang;

            var hari = Math.floor(selisihWaktu / (1000 * 60 * 60 * 24));
            var jam = Math.floor((selisihWaktu % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var menit = Math.floor((selisihWaktu % (1000 * 60 * 60)) / (1000 * 60));
            var detik = Math.floor((selisihWaktu % (1000 * 60)) / 1000);

            document.getElementById("countdown").innerHTML = hari + " hari " + jam + " jam " + menit + " menit " + detik + " detik ";

            // Jika waktu hitungan mundur habis, kirim notifikasi email
            if (selisihWaktu <= 0) {
                sendEmailNotification();
            }
        }

        // Memperbarui setiap detik
        setInterval(updateCountdown, 1000);

        // Fungsi untuk mengirim notifikasi email
        function sendEmailNotification() {
            // Kirim notifikasi email menggunakan Ajax atau lakukan pengiriman di sini
            console.log('Notifikasi email dikirim!');
        }
    </script>
</body>
</html>
