<?php
session_start();

// Koneksi ke database (ganti dengan informasi koneksi Anda)
include "koneksi.php";

// Mengambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Melindungi dari serangan SQL Injection
$username = mysqli_real_escape_string($conn, $username);
$password = mysqli_real_escape_string($conn, md5($_POST['password']));

// Mengecek kredensial pengguna di database
$query = "SELECT * FROM user WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);

    // Variabel yang diambil
    $_SESSION['username'] = $username;
    $_SESSION['id'] = $row['id'];
    // Menetapkan peran berdasarkan level dari database
    $_SESSION['role'] = $row['level'];
    $_SESSION['logged_in'] = true; // Menandai bahwa pengguna telah login
    // Redirect ke halaman dashboard
    if ($_SESSION['role'] == 'dokter' || $_SESSION['role'] == 'bidan') {
        header("Location: user_dashboard.php"); // Redirect ke dashboard admin
    } elseif ($_SESSION['role'] == 'user') {
        header("Location: user_dashboard.php"); // Redirect ke dashboard pengguna
    }
    exit();
} else {
    echo "Login gagal. Silakan coba lagi.";
}



mysqli_close($conn);
?>
