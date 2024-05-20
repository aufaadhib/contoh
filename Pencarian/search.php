<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "skripsi-kia";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "";
if (isset($_POST['query'])) {
    $query = $_POST['query'];
}

if ($query != "") {
    $sql = "SELECT id_pasien, nama_depan, nama_belakang FROM data_pasien WHERE nama_depan LIKE '%$query%' OR nama_belakang LIKE '%$query%'";
} else {
    $sql = "SELECT id_pasien, nama_depan, nama_belakang FROM data_pasien";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div data-id="' . $row['id_pasien'] . '">' . $row['nama_depan'] . ' ' . $row['nama_belakang'] . '</div>';
    }
} else {
    echo '<div>Tidak ditemukan</div>';
}

$conn->close();
?>
