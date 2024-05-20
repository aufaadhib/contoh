<?php
// Koneksi ke database
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname   = 'dummy_data';

    $conn = mysqli_connect($hostname, $username, $password, $dbname);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
// Query SQL untuk mengambil data
$query = "SELECT tanggal, jumlah_pengunjung FROM data_pengunjung";
$result = mysqli_query($koneksi, $query);

// Proses data
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Tutup koneksi
mysqli_close($koneksi);

// Konversi data ke format JSON
$data_json = json_encode($data);
?>
