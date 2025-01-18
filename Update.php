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

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form values
    $recordId = $_POST['id'];
    $updateField = $_POST['update_field'];
    $newValue = $_POST['new_value'];

    // Validate the input
    $allowedFields = ['first_name', 'last_name', 'email_address', 'message', 'message_type', 'subscribe_newsletter'];
    if (!in_array($updateField, $allowedFields)) {
        die("Invalid field selected.");
    }

    // Prepare the query
    $stmt = $conn->prepare("UPDATE ContactForm SET $updateField = ? WHERE id = ?");
    $stmt->bind_param("si", $newValue, $recordId);

    // Execute the query and provide feedback
    if ($stmt->execute()) {
        echo "Record updated successfully!";
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

