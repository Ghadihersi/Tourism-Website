<?php

$conn = new mysqli('localhost', 'root', 'root', '405Proj');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to validate the form inputs
function validateForm($firstName, $lastName, $emailAddress, $message) {
  
    if (empty($firstName) || !preg_match("/^[a-zA-Z]+$/",$firstName)) {
        return "First name must be a valid string containing only letters.";
    }
    
    if (empty($lastName)) {
        return "please enter a last name";
    }
    

    if (empty($emailAddress) || !filter_var( $emailAddress, FILTER_VALIDATE_EMAIL)) {
        return "Please enter a valid email address.";
    }

    if (empty($message) || strlen($message) > 100) {
        return "Message should not exceed 100 characters.";
    }

    
    return true;
}

// Example usage
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $emailAddress = $_POST['email_address'];
    $messageType = $_POST['message_type'];
    $message = $_POST['message'];
    $subscribeNewsletter = ($_POST['subscribe_newsletter'] == "Yes") ? 1 : 0;
    
    

    $validation_result = validateForm($firstName, $lastName, $emailAddress, $message);

    if ($validation_result === true) {
        $stmt = $conn->prepare("INSERT INTO ContactForm (first_name, last_name, email_address, message_type, message, subscribe_newsletter)
                                VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $firstName, $lastName, $emailAddress, $messageType, $message, $subscribeNewsletter);
        if ($stmt->execute()) {
           echo "Data inserted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
       
    } else {
        // Display the validation error message
        echo $validation_result;
    }
    
    
}
?>

