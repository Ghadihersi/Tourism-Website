<?php
$host = 'localhost';
$username = 'root';
$password = 'root'; // Replace with your actual password
$dbname = '405Proj';

// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM ContactForm";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Message Type</th>
            <th>Message</th>
            <th>Actions</th>
          </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['first_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['last_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email_address']) . "</td>";
        echo "<td>" . htmlspecialchars($row['message_type']) . "</td>";
        echo "<td>" . htmlspecialchars($row['message']) . "</td>";
        echo "<td>
                <a href='edit.php?id=" . $row['id'] . "'>Edit</a> |
                <a href='delete.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No records found.</p>";
}

$conn->close();
?>



