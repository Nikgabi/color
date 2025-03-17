<?php include('up.php'); ?>
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
use League\OAuth2\Client\Provider\Google;

require 'vendor/autoload.php'; // Εάν χρησιμοποιείς Composer

function refreshAccessToken($con, $clientId, $clientSecret, $refreshToken) {
    // 1. Ορισμός του URL για την ανανέωση του token
    $url = 'https://oauth2.googleapis.com/token';

    // 2. Δημιουργία των δεδομένων που θα σταλούν στη Google
    $data = [
        'client_id' => $clientId,
        'client_secret' => $clientSecret,
        'refresh_token' => $refreshToken,
        'grant_type' => 'refresh_token',
    ];

    // 3. Ορισμός των παραμέτρων για την HTTP POST κλήση
    $options = [
        'http' => [
            'header' => "Content-Type: application/x-www-form-urlencoded",
            'method' => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    // 4. Αποστολή του αιτήματος και λήψη της απόκρισης
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
	// Δες αν το API απαντάει σωστά
    echo "Google API Response: $result <br>";
	
    $response = json_decode($result, true);

    // 5. Έλεγχος αν η απόκριση είναι έγκυρη
    if (!$response) {
        die("Error decoding response: " . $result);
    }

    // 6. Έλεγχος αν η απόκριση περιέχει νέο access token
    if (isset($response['access_token'])) {
        $newAccessToken = $response['access_token'];
        $expiresAt = date('YmdHis', time() + $response['expires_in']); // Διόρθωση: Χρήση του `expires_in`
		
		// Δες τι επιστρέφει η Google
        echo "New Token: $newAccessToken <br>";
        echo "Expires At: $expiresAt <br>";
		echo "Expires At (RAW TIMESTAMP): " . $expiresAt . " (" . gettype($expiresAt) . ")<br>";
		// Ενημέρωση της βάσης
			$stmt = $con->prepare("UPDATE tokens SET access_token = ?, expires_at=CAST(? AS UNSIGNED) WHERE id = 1");
			$stmt->bind_param("ssi", $newAccessToken, $expiresAt); 
			//$stmt->bind_param("ssi", $accessToken, $refreshToken, (int) $expiresAt);

			$stmt->execute();
			$stmt->close();

			return $newAccessToken;
		} else {
			die("Error refreshing token: " . json_encode($response));
		}
		
        // 7. Αν η απόκριση περιέχει και νέο refresh token, αποθηκεύουμε και αυτό
        if (isset($response['refresh_token'])) {
            $newRefreshToken = $response['refresh_token'];

            // 8. Ενημέρωση της βάσης δεδομένων με το νέο access token και refresh token
            $stmt = $con->prepare("UPDATE tokens SET access_token = ?, refresh_token = ?, expires_at =CAST(? AS UNSIGNED) WHERE id = 1");
            $stmt->bind_param("ssi", $newAccessToken, $newRefreshToken, $expiresAt);
        } else {
            // 9. Ενημέρωση της βάσης δεδομένων μόνο με το νέο access token αν δεν υπάρχει νέο refresh token
            $stmt = $con->prepare("UPDATE tokens SET access_token = ?, expires_at=CAST(? AS UNSIGNED) WHERE id = 1");
            $stmt->bind_param("ssi", $newAccessToken, $expiresAt);
			// 10. Εκτέλεση της SQL εντολής
        $stmt->execute();
        $stmt->close();

        // 11. Επιστροφή των νέων tokens (αν υπάρχει νέο refresh token, το επιστρέφουμε, αλλιώς κρατάμε το παλιό)
        return [$newAccessToken, $newRefreshToken ?? $refreshToken];
        }	
     
}


$client_id = $env['CLIENT_ID'];
$client_secret = $env['CLIENT_SECRET'];

// 1. Ανάκτηση των token από τη βάση
$sql = "SELECT access_token, refresh_token, expires_at  FROM tokens WHERE id = 1";
$result = mysqli_query($con, $sql);
$row = $result->fetch_assoc();

$accessToken = $row['access_token'];
$refreshToken = $row['refresh_token'];
$expiresAt = $row['expires_at'];

// 2. Έλεγχος αν το access token έχει λήξει
if (time() >= $expiresAt) {
    list($accessToken, $refreshToken) = refreshAccessToken($con, $client_id, $client_secret, $refreshToken);
	
	// Δες τι επιστρέφει η συνάρτηση
    echo "New Access Token: $accessToken <br>";
    echo "New Refresh Token: $refreshToken <br>";

    // 3. Ενημέρωση της βάσης με τα νέα tokens
    $stmt = $con->prepare("UPDATE tokens SET access_token = ?, refresh_token = ?, expires_at=CAST(? AS UNSIGNED) WHERE id = 1");
    $stmt->bind_param("ssi", $accessToken, $refreshToken,$expiresAt);
    $stmt->execute();
	if ($stmt->affected_rows > 0) {
			echo "Η βάση ενημερώθηκε επιτυχώς! <br>";
		} else {
			echo "Η βάση ΔΕΝ ενημερώθηκε! SQL Error: " . $stmt->error . "<br>";
		}
	
	
	
    $stmt->close();
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
    'accessToken' => $accessToken, // ΝΕΟ!
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
