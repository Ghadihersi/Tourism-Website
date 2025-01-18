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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $new_password = $_POST['password'];
    

   
    $sql = "UPDATE users SET password = '$new_password' WHERE email = '$email'";
   

    if ($conn->query($sql) === TRUE) {
        if ($conn->affected_rows > 0) {
            echo "Password updated successfully!<a href='Login.html'>back to login</a>";
        } else {
            echo "No user found with the provided email!<a href='ResetPassword.html'>try again</a>";
        }
    } else {
        echo "Error updating password: " . $conn->error;
    }
}

$conn->close();
?>


