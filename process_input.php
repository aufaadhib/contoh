<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Bulanan</title>
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <h1>Form Input Bulanan</h1>
    <?php
    // Koneksi ke database
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $dbname   = 'dummy_data';

    $conn = mysqli_connect($hostname, $username, $password, $dbname);

    // Ambil user_id dari sesi atau parameter lain
    $user_id = 1; // Sesuaikan dengan logika aplikasi Anda

    // Proses inputan ke database jika form disubmit
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        for ($i = 1; $i <= 24; $i++) {
            if (isset($_POST["month$i"]) && !empty($_POST["month$i"])) {
                $month = $i;
                $input_value = $_POST["month$i"];
                $stmt = $conn->prepare("INSERT INTO monthly_inputs (user_id, month, input_value) VALUES (?, ?, ?)
                                        ON DUPLICATE KEY UPDATE input_value = VALUES(input_value)");
                $stmt->bind_param("iis", $user_id, $month, $input_value);
                $stmt->execute();
                $stmt->close();
            }
        }
    }

    // Ambil data input bulanan dari database
    $monthly_data = [];
    $stmt = $conn->prepare("SELECT month, input_value FROM monthly_inputs WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $monthly_data[$row['month']] = $row['input_value'];
    }
    $stmt->close();
    $conn->close();
    ?>

    <form name="monthlyForm" action="" method="post">
        <?php for ($i = 1; $i <= 24; $i++): ?>
            <div class="<?= $i > 1 && !isset($monthly_data[$i-1]) ? 'hidden' : '' ?>">
                <label for="month<?= $i ?>">Bulan <?= $i ?>:</label>
                <input type="text" id="month<?= $i ?>" name="month<?= $i ?>"
                       value="<?= isset($monthly_data[$i]) ? htmlspecialchars($monthly_data[$i]) : '' ?>">
            </div>
        <?php endfor; ?>
        <button type="submit">Submit</button>
    </form>
    <script>
        function checkPreviousMonths() {
            var form = document.forms["monthlyForm"];
            for (var i = 1; i <= 24; i++) {
                var currentDiv = form.querySelector('[name="month' + i + '"]').parentElement;
                var previousInput = form["month" + (i - 1)];
                if (previousInput && !previousInput.value) {
                    currentDiv.classList.add('hidden');
                } else {
                    currentDiv.classList.remove('hidden');
                }
            }
        }

        window.onload = function() {
            checkPreviousMonths();
        };
    </script>
</body>
</html>
