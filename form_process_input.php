<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Bulanan</title>
    <script>
        function checkPreviousMonths() {
            var form = document.forms["monthlyForm"];
            for (var i = 1; i <= 24; i++) {
                var currentInput = form["month" + i];
                var previousInput = form["month" + (i - 1)];
                if (previousInput && !previousInput.value) {
                    currentInput.disabled = true;
                } else {
                    currentInput.disabled = false;
                }
            }
        }

        window.onload = function() {
            checkPreviousMonths();
        };
    </script>
</head>
<body>
    <h1>Form Input Bulanan</h1>
    <form name="monthlyForm" action="process_input.php" method="post">
        <?php for ($i = 1; $i <= 24; $i++): ?>
            <div>
                <label for="month<?= $i ?>">Bulan <?= $i ?>:</label>
                <input type="text" id="month<?= $i ?>" name="month<?= $i ?>" oninput="checkPreviousMonths()">
            </div>
        <?php endfor; ?>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
