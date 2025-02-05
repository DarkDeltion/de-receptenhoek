<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', '/var/www/html/php_error.log');  // Log naar een bestand in de webroot

$email = "test@example.com";
$subject = "Test Mail";
$message = "Dit is een testmail via MailHog.";
$headers = "From: no-reply@example.com";

if (mail($email, $subject, $message, $headers)) {
    echo "✅ E-mail succesvol verzonden.";
} else {
    echo "❌ E-mail verzenden mislukt.";
    error_log("Mail-error: " . print_r(error_get_last(), true));
}
?>
