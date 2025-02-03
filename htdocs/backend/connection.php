<?php
$servername = "mariadb"; // In plaats van "localhost"
$username = "root";
$password = "admin";
$dbname = "De_receptenhoek_DB";

// Maak verbinding
$conn = new mysqli($servername, $username, $password, $dbname);

// Controleer de verbinding
if ($conn->connect_error) {
    echo "<script>console.log('Connection failed: " . $conn->connect_error . "');</script>"; // Log to console
} else {
    echo "<script>console.log('Connected successfully');</script>"; // Log to console
}

$conn->close();
?>
