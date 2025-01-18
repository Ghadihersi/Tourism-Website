<?php
session_start();


$conn = new mysqli('localhost', 'root', 'root', '405Proj');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format. <a href='signup.php'>Try again</a>");
    }

    
    if (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/', $password)) {
        die("Password must be at least 8 characters, include an uppercase letter, a number, and a special character. <a href='signup.php'>Try again</a>");
    }

    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "This email is already registered. <a href='Login.html'>Log in</a>";
    } else {
        // Insert the new user into the database
        $sql = "INSERT INTO users (email, password) VALUES ('$email', '$hashed_password')";
        
        if ($conn->query($sql) === TRUE) {
            echo "Sign-up successful. <a href='Login.html'>Log in here</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
