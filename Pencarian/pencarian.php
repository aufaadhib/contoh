<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Live Search Dropdown</title>
    <style>
        #dropdown {
            border: 1px solid #ccc;
            display: none;
            position: absolute;
            max-height: 150px;
            overflow-y: auto;
            background: white;
        }

        #dropdown div {
            padding: 8px;
            cursor: pointer;
        }

        #dropdown div:hover {
            background-color: #e9e9e9;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h2>Pilih Kota:</h2>
    <form id="searchForm" action="submit.php" method="POST">
        <label for="searchInput">Kota:</label><br>
        <input type="text" id="searchInput" placeholder="Cari kota..">
        <input type="hidden" id="selectedId" name="id_pasien">
        <div id="dropdown"></div><br><br>

        <input type="submit" value="Submit">
    </form>

    <script>
        $(document).ready(function() {
            function fetchDropdown(query = '') {
                $.ajax({
                    url: 'search.php',
                    method: 'POST',
                    data: { query: query },
                    success: function(data) {
                        $('#dropdown').html(data);
                        $('#dropdown').show();
                    }
                });
            }

            $('#searchInput').on('focus', function() {
                fetchDropdown();
            });

            $('#searchInput').on('input', function() {
                var query = $(this).val();
                fetchDropdown(query);
            });

            $(document).on('click', '#dropdown div', function() {
                var selectedText = $(this).text();
                var selectedId = $(this).data('id');
                $('#searchInput').val(selectedText);
                $('#selectedId').val(selectedId);
                $('#dropdown').hide();
            });

            $(document).on('click', function(event) {
                if (!$(event.target).closest('#searchInput, #dropdown').length) {
                    $('#dropdown').hide();
                }
            });
        });
    </script>
</body>
</html>
