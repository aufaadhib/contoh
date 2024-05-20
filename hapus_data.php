<?php
// Koneksi ke database
include "koneksi.php";

// Periksa apakah ID pasien diterima dari permintaan Ajax
if (isset($_POST['nama_depan'])) {
    $nama_depan = $_POST['nama_depan'];

    // Query untuk menghapus data pasien berdasarkan ID
    $sql = "DELETE FROM data_pasien WHERE nama_depan = $nama_depan";

    if ($conn->query($sql) === TRUE) {
        echo "Data pasien berhasil dihapus";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "ID pasien tidak diterima";
}

// Tutup koneksi ke database
$conn->close();
?>
