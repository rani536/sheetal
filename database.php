<?php
$servername = "127.0.0.1:3308";
$username = "root";
$password = "";
$dbname = "student";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("CONNECTION SUCCESSFUL: " . $conn->connect_error);
  
}
else;
echo("CONNECTION FAILED");
?>

