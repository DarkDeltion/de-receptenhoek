<?php
require("../connection.php");

session_start();

// Check if token is passed in the URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Query to find user by token
    $stmt = $conn->prepare("SELECT id, username, email FROM users WHERE verification_token = ? AND verified = 0");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    // If user is found with the provided token
    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        
        // Update the user as verified
        $updateStmt = $conn->prepare("UPDATE users SET verified = 1, verification_token = NULL WHERE id = ?");
        $updateStmt->bind_param("i", $user['id']);
        
        if ($updateStmt->execute()) {
            $_SESSION['message'] = "Account succesvol geverifieerd! Je kunt nu inloggen.";
            $_SESSION['message_type'] = "success";
            header("Location: ../../../frontend/mijn-account/inloggen/inloggen.php");
        } else {
            $_SESSION['message'] = "Er is een fout opgetreden tijdens het verifiëren van je account.";
            $_SESSION['message_type'] = "error";
            header("Location: ../../../frontend/mijn-account/inloggen/inloggen.php");
        }
    } else {
        $_SESSION['message'] = "Ongeldige verificatietoken of je account is al geverifieerd.";
        $_SESSION['message_type'] = "error";
        header("Location: ../../../frontend/mijn-account/inloggen/inloggen.php");
    }

    $stmt->close();
} else {
    $_SESSION['message'] = "Verificatietoken ontbreekt.";
    $_SESSION['message_type'] = "error";
    header("Location: ../../../frontend/mijn-account/inloggen/inloggen.php");
}

$conn->close();
exit();
?>
