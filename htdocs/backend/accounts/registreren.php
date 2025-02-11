<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require("../connection.php");
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

session_start();

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
    $_SESSION['message'] = "Vul alstublieft alle velden in.";
    $_SESSION['message_type'] = "error";
    header("Location: ../../../frontend/mijn-account/inloggen/registreren.php");
    exit();
}

if ($password !== $confirm_password) {
    $_SESSION['message'] = "Wachtwoorden komen niet overeen.";
    $_SESSION['message_type'] = "error";
    header("Location: ../../../frontend/mijn-account/inloggen/registreren.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
$stmt->bind_param("ss", $username, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['message'] = "Gebruikersnaam of e-mail is al in gebruik.";
    $_SESSION['message_type'] = "error";
    header("Location: ../../../frontend/mijn-account/inloggen/registreren.php");
    exit();
}

// Generate a random verification token
$verificationToken = bin2hex(random_bytes(16)); // Generate a secure token

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// **New HTML Welcome Email**
$verificationLink = "http://localhost:8080/backend/accounts/verifiëren.php?token=" . $verificationToken;

$message = "
<!DOCTYPE html>
<html lang='nl'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Welkom bij De Receptenhoek!</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f8f8f8; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 20px auto; background: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
        .header { background: #ff6f00; padding: 20px; text-align: center; color: white; font-size: 24px; font-weight: bold; border-radius: 8px 8px 0 0; }
        .content { padding: 20px; text-align: center; }
        .content h2 { color: #333; }
        .content p { font-size: 16px; color: #555; }
        .footer { background: #333; color: white; text-align: center; padding: 15px; font-size: 14px; border-radius: 0 0 8px 8px; }
        .button { display: inline-block; padding: 10px 20px; margin-top: 20px; font-size: 16px; color: white; background: #ff6f00; text-decoration: none; border-radius: 5px; }
        .button:hover { background: #e65100; }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>Welkom bij De Receptenhoek!</div>
        <div class='content'>
            <h2>Hallo {$username},</h2>
            <p>We zijn ontzettend blij dat je lid bent geworden van onze community! Om je account te verifiëren, klik je op de onderstaande link:</p>
            <p><a href='{$verificationLink}' class='button'>Klik hier om je account te verifiëren</a></p>
        </div>
        <div class='footer'>
            <p>Veel kookplezier! <br> Het team van De Receptenhoek</p>
            <p><a href='http://localhost:8080' style='color: white;'>Bezoek onze website</a></p>
        </div>
    </div>
</body>
</html>";

// **Plain Text Alternative**
$altMessage = "
Hallo {$username},

Welkom bij De Receptenhoek! We zijn ontzettend blij dat je lid bent geworden van onze community.

Om je account te verifiëren, klik je op de onderstaande link:
{$verificationLink}

Veel kookplezier!
Het team van De Receptenhoek
";

try {
    $mail->isSMTP();
    $mail->Host = 'mailhog';
    $mail->Port = 1025;
    $mail->SMTPAuth = false;
    
    $mail->setFrom('no-reply@DeReceptenhoek.nl', 'De Receptenhoek');
    $mail->addAddress($email, $username);
    $mail->isHTML(true);
    $mail->Subject = 'Welkom bij De Receptenhoek!';
    $mail->Body = $message;
    $mail->AltBody = $altMessage;

    if (!$mail->send()) {
        throw new Exception("E-mail kon niet worden verzonden: " . $mail->ErrorInfo);
    }

    // Insert user into the database with the verification token
    $stmt = $conn->prepare("INSERT INTO users (username, password, email, verification_token, verified) VALUES (?, ?, ?, ?, 0)");
    $stmt->bind_param("ssss", $username, $hashed_password, $email, $verificationToken);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Account succesvol aangemaakt! Controleer je e-mail om je account te verifiëren.";
        $_SESSION['message_type'] = "success";
        header("Location: ../../../frontend/mijn-account/inloggen/inloggen.php");
    } else {
        $_SESSION['message'] = "Er is een fout opgetreden bij het aanmaken van het account.";
        $_SESSION['message_type'] = "error";
        header("Location: ../../../frontend/mijn-account/inloggen/registreren.php");
    }

} catch (Exception $e) {
    error_log("Fout bij registratie: " . $e->getMessage());
    $_SESSION['message'] = "Er is een fout opgetreden. Probeer het later opnieuw.";
    $_SESSION['message_type'] = "error";
    header("Location: ../../../frontend/mijn-account/inloggen/registreren.php");
}

$stmt->close();
$conn->close();
exit();
?>
