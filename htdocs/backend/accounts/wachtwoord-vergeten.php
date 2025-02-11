<?php
session_start();
require("../connection.php");
require("vendor/autoload.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email']);

    if (empty($email)) {
        $_SESSION['message'] = "Vul een e-mailadres in.";
        $_SESSION['message_type'] = "error";
        header("Location: ../../../frontend/mijn-account/inloggen/wachtwoord-vergeten.php");
        exit();
    }

    $Eemail = $_POST['email']; // Store email for later use

    // Controleer of de e-mail in de database staat en haal de gebruikersnaam op
    $stmt = $conn->prepare("SELECT username FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        $_SESSION['message'] = "Geen account gevonden met dit e-mailadres.";
        $_SESSION['message_type'] = "error";
        header("Location: ../../../frontend/mijn-account/inloggen/wachtwoord-vergeten.php");
        exit();
    }

    // Fetch the username from the result
    $stmt->bind_result($username);
    $stmt->fetch();
    $stmt->close(); // Close the statement

    // **Debugging: Check if the correct username is retrieved**
    // echo "Gebruikersnaam opgehaald: " . $username; exit;

    // Genereer een unieke token
    $token = bin2hex(random_bytes(50));
    $expires = date("Y-m-d H:i:s", strtotime("+1 hour")); // Token geldig voor 1 uur

    // Sla token op in de database
    $stmt = $conn->prepare("UPDATE users SET reset_token = ?, reset_expires = ? WHERE email = ?");
    $stmt->bind_param("sss", $token, $expires, $email);
    $stmt->execute();
    $stmt->close(); // Close the statement

    $message = "
    <!DOCTYPE html>
    <html lang='nl'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Wachtwoord resetten - De Receptenhoek</title>
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
            <div class='header'>Wachtwoord resetten - De Receptenhoek</div>
            <div class='content'>
                <h2>Hallo $username,</h2>
                <p>We hebben een verzoek ontvangen om je wachtwoord opnieuw in te stellen. Klik op de onderstaande link om je wachtwoord te resetten:</p>
                <a href='http://localhost:8080/frontend/mijn-account/inloggen/resetten.php?token={$token}' class='button'>Wachtwoord resetten</a>
                <p>Als je dit verzoek niet hebt aangevraagd, kun je deze e-mail gewoon negeren.</p>
            </div>
            <div class='footer'>
                <p>Met vriendelijke groet, <br> Het team van De Receptenhoek</p>
                <p><a href='http://localhost:8080' style='color: white;'>Bezoek onze website</a></p>
            </div>
        </div>
    </body>
    </html>
    ";

    // **Plain Text Alternative**
    $altMessage = "
    Hallo {$username},

    We hebben een verzoek ontvangen om je wachtwoord opnieuw in te stellen. Klik op de onderstaande link om je wachtwoord te resetten:

    http://localhost:8080/frontend/mijn-account/inloggen/resetten.php?token={$token}

    Als je dit verzoek niet hebt aangevraagd, kun je deze e-mail gewoon negeren.

    Met vriendelijke groet, 
    Het team van De Receptenhoek

    Bezoek onze website: http://localhost:8080
    ";

    // Stuur e-mail met reset-link
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'mailhog';
        $mail->Port = 1025;
        $mail->SMTPAuth = false;

        $mail->setFrom('no-reply@DeReceptenhoek.nl', 'De Receptenhoek');
        $mail->addAddress($Eemail, $username); // Ensure correct username is passed here
        $mail->isHTML(true);
        $mail->Subject = "Wachtwoord Reset";
        $mail->Body = $message;
        $mail->AltBody = $altMessage;

        $mail->send();
        $_SESSION['message'] = "Controleer je e-mail voor een reset-link.";
        $_SESSION['message_type'] = "success";
    } catch (Exception $e) {
        $_SESSION['message'] = "Fout bij verzenden van e-mail: " . $mail->ErrorInfo;
        $_SESSION['message_type'] = "error";
    }

    header("Location: ../../../frontend/mijn-account/inloggen/wachtwoord-vergeten.php");
    exit();
}
?>
