<?php include('up.php'); ?>
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

require 'vendor/autoload.php'; // Εάν χρησιμοποιείς Composer

function refreshAccessToken($con, $clientId, $clientSecret, $refreshToken) {
    $url = 'https://oauth2.googleapis.com/token';
    $data = [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'refresh_token' => $refreshToken,
        'grant_type' => 'refresh_token',
    ];

    $options = [
        'http' => [
            'header' => "Content-Type: application/x-www-form-urlencoded",
            'method' => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $response = json_decode($result, true);
	if (!$response) {
		die("Error decoding response: " . $result);
	}

    if (isset($response['access_token'])) {
        $newAccessToken = $response['access_token'];
        $expiresAt = time() + $response['expires_at'];

        // Ενημέρωση της βάσης
        $stmt = $con->prepare("UPDATE tokens SET access_token = ?, expires_at = ? WHERE id = 1");
        $stmt->bind_param("si", $newAccessToken, $expiresAt);
        $stmt->execute();
        $stmt->close();

        return $newAccessToken;
    } else {
        die("Error refreshing token: " . json_encode($response));
    }
}

$client_id = $env['CLIENT_ID'];
$client_secret = $env['CLIENT_SECRET'];

$sql="SELECT access_token, refresh_token, UNIX_TIMESTAMP(expires_at) as expires_at FROM tokens WHERE id = 1" ;
$result = mysqli_query($con, $sql);
$row = $result->fetch_assoc();
$accessToken = $row['access_token'];
$refreshToken = $row['refresh_token'];
$expiresAt = $row['expires_at'];

// Αν το access token έχει λήξει, πάρε νέο
if (time() >= $expiresAt) {
    $accessToken = refreshAccessToken($con, $client_id, $client_secret, $refreshToken);
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
        'refreshToken' => $refreshToken2,
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
