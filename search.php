<?php
// Connect to the database
$conn = new mysqli('localhost', 'root', 'root', '405Proj');

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $conn->real_escape_string($_POST['first_name']);

    // Execute the query
    $sql = "SELECT * FROM ContactForm WHERE first_name LIKE '%$firstName%'";
    $result = $conn->query($sql);

    // Build results table
    if ($result->num_rows > 0) {
        echo "<table border='1'>";
        echo "<tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Message Type</th>
            <th>Message</th>
        </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
            echo "<td>" . htmlspecialchars($row['email_address']) . "</td>";
            echo "<td>" . htmlspecialchars($row['message_type']) . "</td>";
            echo "<td>" . htmlspecialchars($row['message']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No results found for <strong>" . htmlspecialchars($firstName) . "</strong>.</p>";
    }
}

$conn->close();
?>
