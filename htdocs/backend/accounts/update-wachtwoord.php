<?php
session_start();
require("../connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $_SESSION['message'] = "Wachtwoorden komen niet overeen.";
        $_SESSION['message_type'] = "error";    
        die();
    }
    

    // Hash het wachtwoord
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Werk het wachtwoord bij en verwijder de reset-token
    $stmt = $conn->prepare("UPDATE users SET password = ?, reset_token = NULL, reset_expires = NULL WHERE reset_token = ?");
    $stmt->bind_param("ss", $hashed_password, $token);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
        $_SESSION['message'] = "Je wachtwoord is succesvol bijgewerkt.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Fout bij het bijwerken van je wachtwoord.";
        $_SESSION['message_type'] = "error";
    }   
    header("Location: ../../../frontend/mijn-account/inloggen/inloggen.php");
    exit();
}
?>
