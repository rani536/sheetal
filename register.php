<?php
include 'login.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are set
    if (!isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirmPassword'])) {
        die("All fields are required.");
    }
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $passwords = $_POST['password'];
    $confirm_password = $_POST['confirmPassword'];

    // Validate password
    if (strlen($passwords) < 8)  {
        echo "Password must be at least 8 characters long and contain one of the symbols @&$#.";
        exit;
    }

    if ($passwords !== $confirm_password) {
        echo "Passwords do not match.";
        exit;
    }

    // Encrypt the password
    $hashed_password = password_hash($passwords, PASSWORD_DEFAULT);

    // Prepare an SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    // Execute the statement and check for errors
    if ($stmt->execute()) {
        echo "location: rani.html";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>