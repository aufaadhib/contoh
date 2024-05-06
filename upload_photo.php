<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Jika belum, redirect ke halaman login
    header("Location: login_form.php");
    exit();
}

// Koneksi ke database (ganti dengan informasi koneksi Anda)
include 'koneksi.php';
// Mendapatkan informasi pengguna dari sesi
$username = $_SESSION['username'];

// Proses unggah foto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Periksa apakah file telah diunggah dengan benar
    if (isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0) {
        $target_dir = "uploads/"; // Direktori penyimpanan foto
        $target_file = $target_dir . basename($_FILES["photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Periksa apakah file adalah gambar asli atau bukan
        $check = getimagesize($_FILES["photo"]["tmp_name"]);
        if($check !== false) {
            // File adalah gambar
            $uploadOk = 1;
        } else {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }

        // Periksa apakah file sudah ada
        if (file_exists($target_file)) {
            echo "Maaf, file sudah ada.";
            $uploadOk = 0;
        }

        // Periksa ukuran file
        if ($_FILES["photo"]["size"] > 500000) {
            echo "Maaf, ukuran file terlalu besar.";
            $uploadOk = 0;
        }

        // Izinkan hanya format gambar tertentu
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Maaf, hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
            $uploadOk = 0;
        }

        // Jika semua validasi berhasil, simpan file
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
                // Perbarui foto profil pengguna dalam database
                $query = "UPDATE user SET profile_photo='$target_file' WHERE username='$username'";
                if (mysqli_query($conn, $query)) {
                    echo "Foto profil berhasil diperbarui.";
                } else {
                    echo "Gagal memperbarui foto profil: " . mysqli_error($conn);
                }
            } else {
                echo "Maaf, terjadi kesalahan saat mengunggah file.";
            }
        }
    } else {
        echo "Maaf, terjadi kesalahan saat mengunggah file.";
    }
}

// Menutup koneksi
mysqli_close($conn);
?>
