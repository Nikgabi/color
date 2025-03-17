<?php include('up.php'); ?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp-relay.gmail.com'; 
    $mail->Port = 587; 
    $mail->SMTPSecure = 'tls'; 
    $mail->SMTPAuth = false; // ΧΩΡΙΣ authentication!

    $mail->setFrom('nikos.gavalakis@ygeiafirst.net', 'Nikos');
    $mail->addAddress('nikosgavalakis@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Test Email';
    $mail->Body = 'Αυτό είναι ένα email δοκιμής μέσω SMTP Relay χωρίς authentication';

    $mail->send();
    echo 'Το email στάλθηκε!';
} catch (Exception $e) {
    echo "Σφάλμα: {$mail->ErrorInfo}";
}
?>