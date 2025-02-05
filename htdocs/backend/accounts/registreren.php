<?php
$servername = "mariadb";
$username = "root";
$password = "admin";
$dbname = "De_receptenhoek_DB";

// Maak verbinding
$conn = new mysqli($servername, $username, $password, $dbname);

// Check verbinding
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check of het formulier is verzonden
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check of wachtwoorden overeenkomen
    if ($password !== $confirm_password) {
        header("Location: ../../../frontend/mijn-account/inloggen/registreren.php?status=error&message=Passwords_do_not_match");
        exit();
    }

    // Check of gebruikersnaam al bestaat
    $stmt_check = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        header("Location: ../../../frontend/mijn-account/inloggen/registreren.php?status=error&message=Username_already_exists");
        exit();
    }

    // Wachtwoord hashen
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Gebruiker opslaan
    $stmt = $conn->prepare("INSERT INTO users (username, password, is_verified) VALUES (?, ?, 1)");
    $stmt->bind_param("ss", $username, $hashed_password);

    if ($stmt->execute()) {
        header("Location: ../../../frontend/mijn-account/inloggen/inloggen.php?status=success&message=Account_created_successfully");
        exit();
    } else {
        header("Location: ../../../frontend/mijn-account/inloggen/registreren.php?status=error&message=Database_error");
        exit();
    }

    // Statements sluiten
    $stmt_check->close();
    $stmt->close();
}

$conn->close();
?>
