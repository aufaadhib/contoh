<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Data</title>
</head>
<body>

<h2>Select Data</h2>

<form method="post" action="getData.php">
    <label for="category">Select Category:</label>
    <select name="category" id="category">
        <option value="books">Books</option>
        <option value="movies">Movies</option>
        <!-- Add more options for other categories as needed -->
    </select>
    <button type="submit" name="selectData">Select Data</button>
</form>

</body>
</html>
