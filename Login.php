<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli('localhost', 'root', 'root', '405Proj');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            echo "Login successful!  <a href='index.html'>Back to home page</a>";
        } else {
            echo "Incorrect password! <a href='Login.html'>try again</a>";
        }
    } else {
        echo "No user found with that email. <a href='Login.html'>try again</a>";
    }

    $conn->close();
}
?>


