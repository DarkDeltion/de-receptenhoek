<?php
session_start(); // Start the session

// Check if the user is logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or home page
    header("Location: ../../../frontend/mijn-account/inloggen/inloggen.php");
    exit();
} else {
    // If the user is not logged in, redirect to the login page
    header("Location: ../../../frontend/mijn-account/inloggen/inloggen.php");
    exit();
}
?>