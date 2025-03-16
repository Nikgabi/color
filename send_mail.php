<?php include('up.php'); ?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

require 'vendor/autoload.php'; // Εάν χρησιμοποιείς Composer

$client_id = $env['CLIENT_ID'];
$client_secret = $env['CLIENT_SECRET'];

$sql="SELECT access_token, refresh_token, UNIX_TIMESTAMP(expires_at) as expires_at FROM tokens WHERE id = 1" ;
$result = mysqli_query($con, $sql);


$row = $result->fetch_assoc();

if (!$row) {
    die("Δεν βρέθηκαν tokens στη βάση!");
}

$accessToken = $row['access_token'];
$refreshToken = $row['refresh_token'];
$expiresAt = $row['expires_at'];

// Έλεγχος αν έχει λήξει το token
if (time() >= $expiresAt) {
    die("Το access token έχει λήξει! Ανανεώστε το πρώτα.");
}

// Δημιουργία PHPMailer
$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // OAuth2 Authentication
    $mail->AuthType = 'XOAUTH2';
    $provider = new Google([
        'clientId' => $client_id,
        'clientSecret' => $client_secret,
    ]);

    $mail->setOAuth(new OAuth([
        'provider' => $provider,
        'clientId' => $client_id,
        'clientSecret' => $client_secret,
        'refreshToken' => $refreshToken,
        'userName' => 'nikos.gavalakis@ygeiafirst.net'
    ]));

    // Ρυθμίσεις αποστολής email
    $mail->setFrom('nikos.gavalakis@ygeiafirst.net', 'Το Όνομά Σου');
    $mail->addAddress('nikosgavalakis@gmail.com', 'Παραλήπτης');
    $mail->Subject = 'Δοκιμαστικό email με OAuth2';
    $mail->Body = 'Αυτό είναι ένα δοκιμαστικό email που στέλνεται μέσω του Gmail API με χρήση OAuth2!';

    $mail->send();
    echo "Το email στάλθηκε επιτυχώς!";
} catch (Exception $e) {
    echo "Σφάλμα κατά την αποστολή: " . $mail->ErrorInfo;
}

// Κλείσιμο σύνδεσης με τη βάση
$mysqli->close();
?>
