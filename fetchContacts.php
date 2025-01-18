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
// تحميل البيانات من الداتابيس
$result = $conn->query("SELECT * FROM ContactForm");

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Message Type</th>
                <th>Message</th>
                <th>Subscription</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['first_name']) . "</td>
                <td>" . htmlspecialchars($row['last_name']) . "</td>
                <td>" . htmlspecialchars($row['email_address']) . "</td>
                <td>" . htmlspecialchars($row['message_type']) . "</td>
                <td>" . htmlspecialchars($row['message']) . "</td>
                <td>" . ($row['subscribe_newsletter'] === 'yes' ? 'Subscribed' : 'Not Subscribed') . "</td>
              <td>
                          <a href='update.html?id=" . $row['id'] . "'>Modify</a>
                          <a href='delete.html?id=" . $row['id'] . "'>Delete</a>
                      </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No records found.</p>";
}

$conn->close();
?>
