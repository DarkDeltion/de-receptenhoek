<?php
$servername = "mariadb"; // Use your actual server name
$username = "root";
$password = "admin";
$dbname = "De_receptenhoek_DB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    // Log error to console and stop script execution
    echo "<script>console.error('Connection failed: " . $conn->connect_error . "');</script>";
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "<script>console.log('Connected successfully');</script>";
}
?>