<?php
require("../connection.php"); 
session_start();

// Check if the user is already logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    header("Location: ../../../index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $_SESSION['message'] = "Vul alstublieft alle velden in.";
        $_SESSION['message_type'] = "error";
        header("Location: ../../../frontend/mijn-account/inloggen/inloggen.php");
        exit();
    }

    // Prepare and bind
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $_SESSION['message'] = "Gebruikersnaam of wachtwoord is onjuist.";
        $_SESSION['message_type'] = "error";
        header("Location: ../../../frontend/mijn-account/inloggen/inloggen.php");
        exit();
    }

    $user = $result->fetch_assoc();

    if (!password_verify($password, $user['password'])) {
        $_SESSION['message'] = "Gebruikersnaam of wachtwoord is onjuist.";
        $_SESSION['message_type'] = "error";
        header("Location: ../../../frontend/mijn-account/inloggen/inloggen.php");
        exit();
    }

    // ✅ Successful login
    $_SESSION['message'] = "Inloggen succesvol!";
    $_SESSION['message_type'] = "success";
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['logged_in'] = true;

    // ✅ Redirect the user to the frontend login page to display the message
    header("Location: ../../../frontend/mijn-account/inloggen/inloggen.php?success=true");
    exit();
}
?>
