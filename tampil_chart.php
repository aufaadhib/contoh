<?php
// // Koneksi ke database
//     $hostname = 'localhost';
//     $username = 'root';
//     $password = '';
//     $dbname   = 'dummy_data';

//     $conn = mysqli_connect($hostname, $username, $password, $dbname);

// if (!$conn) {
//     die("Koneksi gagal: " . mysqli_connect_error());
// }
include "koneksi.php";
// Query SQL untuk mengambil data
$query = "SELECT tanggal_berobat, berat_badan FROM riwayat_berobat WHERE id_pasien=11";
$result = mysqli_query($conn, $query);

// Proses data
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

// Tutup koneksi
mysqli_close($conn);

// Konversi data ke format JSON
$data_json = json_encode($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Line Chart</title>
    <!-- Include Chart.js versi 2.x -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
</head>
<body>
    <!-- Tambahkan elemen canvas untuk menampilkan grafik -->
    <canvas id="lineChart"></canvas>

    <script>
        var data = <?php echo $data_json; ?>;

        // Siapkan label dan data untuk grafik
        var labels = data.map(function(item) {
            return item.tanggal_berobat;
        });

        var dataset = {
            label: 'Jumlah Pengunjung',
            data: data.map(function(item) {
                return item.berat_badan;
            }),
            borderColor: 'blue',
            fill: false
        };

        var config = {
            type: 'line',
            data: {
                labels: labels,
                datasets: [dataset]
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Line Chart'
                },
                scales: {
                    xAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Month'
                        }
                    }],
                    yAxes: [{
                        scaleLabel: {
                            display: true,
                            labelString: 'Number of Visitors'
                        },
                        gridLines: {
                            display: false // Menonaktifkan gridlines pada sumbu Y
                        }
                    }]
                },
                legend: {
                    display: false // Menonaktifkan legend
                }
            }
        };

        // Buat dan tampilkan grafik menggunakan Chart.js
        var myChart = new Chart(
            document.getElementById('lineChart'),
            config
        );
    </script>
</body>
</html>

