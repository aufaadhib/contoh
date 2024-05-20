<?php
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selectData']) && isset($_POST['category'])) {
    // Get selected category
    $selectedCategory = $_POST['category'];

    // Database connection
    $servername = "localhost";
    $username = "username";
    $password = "password";
    $dbname = "your_database";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data based on selected category
    $sql = "SELECT * FROM $selectedCategory";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Display data
        echo "<h3>Data from $selectedCategory:</h3>";
        echo "<ul>";
        while($row = $result->fetch_assoc()) {
            echo "<li>" . $row['name'] . "</li>";
        }
        echo "</ul>";
    } else {
        echo "No data available for this category.";
    }
    $conn->close();
}
?>
