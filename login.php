<?php
include 'database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $passwords = $_POST['passwords'];
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    // Verify reCAPTCHA
    $secretKey = "6LcQQfMpAAAAAHOy5Y72dVLETXalQwlDW0yz9_hW";
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse");
    $responseKeys = json_decode($response, true);

    if(intval($responseKeys["success"]) !== 1) {
        echo "Please complete the reCAPTCHA verification.";
        exit();
    }

    // Sanitize input to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);

    $sql = "SELECT * FROM users WHERE LOWER(email) = LOWER('$email')";
    $result = $conn->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row['password'];

            if (password_verify($passwords, $stored_password)) {
                $_SESSION['user_id'] = $row['id'];
                // Redirect to the dashboard or another page after successful login
                header("Location: dashboard.php");
                exit(); // Ensure no further code is executed after redirection
            } else {
                echo "Invalid email or password.";
                exit(); // Ensure no further code is executed after outputting error message
            }
        } else {
            echo "No user found with that email.";
            exit(); // Ensure no further code is executed after outputting error message
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        exit(); // Ensure no further code is executed after outputting error message
    }

    $conn->close();
}
?>