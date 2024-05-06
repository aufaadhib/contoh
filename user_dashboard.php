<?php
session_start();
include 'koneksi.php';
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Jika belum, redirect ke halaman login
    header("Location: login_form.php");
    exit();
}
// Query untuk mengambil data dari database
$username = $_SESSION['username'];
$id= $_SESSION['id'];
// $query = "SELECT * FROM user where username=$username";
// $result = mysqli_query($conn, "$query");

// echo $username;
// echo $query;
$query="SELECT * FROM user where username= '$username'";
$result = mysqli_query($conn, $query);
$hasil=mysqli_fetch_assoc($result);
echo $hasil['username'];
echo $hasil['alamat'];
// if ($result) {
//     while ($row = mysqli_fetch_assoc($result)) {
//         // Lakukan sesuatu dengan $row
//         echo $row['username'];
//         echo $row['alamat'];
//     }
// } else {
//     echo "Kueri gagal: " . mysqli_error($conn);
// }

// echo $result['username'];
// if (mysqli_num_rows($result) > 0) {
//     // Mengambil baris data satu per satu menggunakan mysqli_fetch_array()
//     while ($row = mysqli_fetch_array($result)) {
//         // Menampilkan nilai dari setiap kolom menggunakan indeks numerik
//         echo "ID: " . $row[0] . "<br>";
//         echo "Nama: " . $row[1] . "<br>";
//         echo "Alamat: " . $row[2] . "<br>";

//         // Menampilkan nilai dari setiap kolom menggunakan indeks asosiatif
//         echo "ID: " . $row['id'] . "<br>";
//         echo "Nama: " . $row['nama'] . "<br>";
//         echo "Alamat: " . $row['alamat'] . "<br>";

//         // Menampilkan nilai dari setiap kolom menggunakan keduanya (indeks numerik dan asosiatif)
//         echo "ID: " . $row[0] . " / " . $row['id'] . "<br>";
//         echo "Nama: " . $row[1] . " / " . $row['nama'] . "<br>";
//         echo "alamat: " . $row[2] . " / " . $row['alamat'] . "<br>";
//     }
// } else {
//     echo "Tidak ada data yang ditemukan.";
// }

// Menutup koneksi
mysqli_close($conn);
?>