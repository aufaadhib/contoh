<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data Pasien</title>
    <script>
        function hapusData(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data pasien?')) {
                // Buat objek XMLHttpRequest
                var xhr = new XMLHttpRequest();

                // Set up request
                xhr.open('POST', 'hapus_data.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                // Kirim data ke server
                xhr.send('id=' + id);

                // Tangani respons dari server
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        alert(xhr.responseText); // Tampilkan pesan respons
                        // Refresh halaman atau lakukan tindakan lain setelah penghapusan berhasil
                        location.reload();
                    }
                };
            }
        }
    </script>
</head>
<body>
    <h1>Data Pasien</h1>
    <?php
    include "koneksi.php";
    // Query untuk mengambil data pasien
    $sql = "SELECT id_pasien, nama_depan, nama_belakang, email FROM data_pasien";
    $result = $conn->query($sql);

    // Tampilkan data pasien dalam tabel
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nama</th><th>Alamat</th><th>Aksi</th></tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["id_pasien"]."</td>";
            echo "<td>".$row["nama_depan"].$row["nama_belakang"]."</td>";
            echo "<td>".$row["email"]."</td>";
            echo "<td><button onclick='hapusData(".$row["nama_depan"].")'>Hapus</button></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Tidak ada data pasien";
    }

    // Tutup koneksi ke database
    $conn->close();
    ?>
</body>
</html>
