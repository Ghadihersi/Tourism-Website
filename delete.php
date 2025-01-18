<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', 'root', '405Proj');

// Check the connection
if ($conn->connect_error) {
    die("<p style='color: red;'>Connection failed: " . $conn->connect_error . "</p>");
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName =$_POST['first_name']; // Trim whitespace

    echo "<div class='container'>";
    echo "<h1>Delete Result</h1>";

    // Check if the row exists
    $checkSql = "SELECT * FROM ContactForm WHERE first_name = '$firstName'";
    $checkResult = $conn->query($checkSql);

    if ($checkResult && $checkResult->num_rows > 0) {
        // Row exists, proceed to delete
        $deleteSql = "DELETE FROM ContactForm WHERE first_name = '$firstName'";
        if ($conn->query($deleteSql) === TRUE) {
            echo "<p style='color: green;'>User with first name <strong>" . htmlspecialchars($firstName) . "</strong> was successfully deleted.</p>";
        } else {
            echo "<p style='color: red;'>Error deleting user: " . $conn->error . "</p>";
        }
    } else {
        echo "<p style='color: red;'>No user found with the first name <strong>" . htmlspecialchars($firstName) . "</strong>.</p>";
    }

    echo "<a href='AdminPanel.html'>Go Back</a>";
    echo "</div>";
}

// Close the connection
$conn->close();
?>

