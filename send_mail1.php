<?php include('up.php'); ?>
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

require 'vendor/autoload.php'; // Εάν χρησιμοποιείς Composer

function refreshAccessToken($con, $client_id, $client_secret, $refreshToken) {
    // Αποστολή αίτησης στο Google API για νέο access token
    $client = new GuzzleHttp\Client();
    $response = $client->post('https://oauth2.googleapis.com/token', [
        'form_params' => [
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'refresh_token' => $refreshToken,
            'grant_type' => 'refresh_token',
        ],
    ]);

    $response = json_decode($response->getBody(), true);

    // Αν η απάντηση περιέχει νέο access token
    if (isset($response['access_token'])) {
        $newAccessToken = $response['access_token'];
        $expiresAt = time() + $response['expires_in']; // Υπολογισμός UNIX timestamp

        echo "New Token: $newAccessToken <br>";
        echo "Expires At (Unix Timestamp): " . $expiresAt . "<br>";

        // Διαγραφή όλων των περιττών εγγραφών, κρατώντας μόνο 1
        $con->query("DELETE FROM tokens WHERE id NOT IN (SELECT id FROM (SELECT id FROM tokens ORDER BY id DESC LIMIT 1) AS t)");

        // Έλεγχος αν υπάρχει ήδη εγγραφή στη βάση
        $result = $con->query("SELECT id FROM tokens LIMIT 1");

        if ($result->num_rows > 0) {
            // Υπάρχει ήδη εγγραφή, κάνουμε UPDATE
            $stmt = $con->prepare("UPDATE tokens SET access_token = ?, expires_at = ? WHERE id = (SELECT id FROM (SELECT id FROM tokens ORDER BY id DESC LIMIT 1) AS t)");
            $stmt->bind_param("si", $newAccessToken, $expiresAt);
        } else {
            // Δεν υπάρχει εγγραφή, κάνουμε INSERT
            $stmt = $con->prepare("INSERT INTO tokens (access_token, refresh_token, expires_at) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $newAccessToken, $refreshToken, $expiresAt);
        }

        // Εκτέλεση της SQL εντολής και έλεγχος σφαλμάτων
        if ($stmt->execute()) {
            echo "Η βάση ενημερώθηκε επιτυχώς!<br>";
        } else {
            echo "SQL Error: " . $stmt->error . "<br>";
        }

        $stmt->close();

        // Επιστροφή των νέων tokens
        return [$newAccessToken, $refreshToken];
    } else {
        // Επιστροφή λάθους αν το refresh token είναι άκυρο
        if (isset($response['error']) && $response['error'] == 'invalid_grant') {
            echo "Error: Refresh token has expired or been revoked. Please reauthorize the application.";
            // Ίσως να πρέπει να καλέσεις ξανά την διαδικασία OAuth για νέο refresh token
        }
        die("Error refreshing token: " . json_encode($response));
    }
}

	$env = parse_ini_file('/var/www/html/color/.env1');
	$client_id = $env['CLIENT_ID'];
	$client_secret = $env['CLIENT_SECRET'];

	$sql = "SELECT access_token, refresh_token, expires_at 
        FROM tokens 
        ORDER BY id DESC 
        LIMIT 1";
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


?>
