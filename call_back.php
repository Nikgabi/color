<?php include('up.php'); ?>
<?php
require 'vendor/autoload.php';  // Φόρτωσε τα απαιτούμενα dependencies μέσω Composer

use League\OAuth2\Client\Provider\Google;
use GuzzleHttp\Client;

$authCode = $_GET['code'];
echo "Authorization Code: " . htmlspecialchars($authCode) . "<br>";
$client = new Client();

$env = parse_ini_file('/var/www/html/color/.env1');

// Ρυθμίσεις Google API
$client_id = $env['CLIENT_ID'];
$client_secret = $env['CLIENT_SECRET'];
$redirect_uri = 'https://ygeiafirst.net/call_back.php';  // Πρέπει να είναι το ίδιο με το Google Console
$scope = 'https://www.googleapis.com/auth/gmail.send';

// Δημιουργία του Google provider
$googleProvider = new Google([
    'client_id'     => $client_id,
    'client_secret' => $client_secret,
    'redirect_uri'  => $redirect_uri,
]);

// Έλεγχος αν υπάρχει authorization code
if (!isset($_GET['code'])) {
    die("Error: No authorization code provided. Please visit the authorization URL first.");
}

try {
	

    // Στέλνουμε το αίτημα για να ανταλλάξουμε τον authorization code για access token
    $response = $client->post('https://oauth2.googleapis.com/token', [
        'form_params' => [
            'code' => $authCode,
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'redirect_uri' => $redirect_uri,
            'grant_type' => 'authorization_code',
			'scope' => 'https://www.googleapis.com/auth/gmail.send', 
			'access_type' => 'offline',	
			],
        ]
    );

    // Αποκωδικοποιούμε την απάντηση JSON
    $body = json_decode((string) $response->getBody(), true);

    // Αν υπάρχει λάθος στην απάντηση, το εκτυπώνουμε
    if (isset($body['error'])) {
        exit("Error fetching access token: " . json_encode($body));
    }

    // Αν όλα πάνε καλά, παίρνουμε το access token και το refresh token
    $accessToken = $body['access_token'];
    $refreshToken = $body['refresh_token'];
	$expiresIn = $body['expires_in'];
	
	//date_default_timezone_set('Europe/Athens'); // Ζώνη ώρας Αθήνας

		$expiresAt = time() + $expiresIn; // UNIX timestamp

		$stmt = $con->prepare("INSERT INTO tokens (access_token, refresh_token, expires_at) VALUES (?, ?, ?)");
		$stmt->bind_param("ssi", $accessToken, $refreshToken, $expiresAt);

		// Εκτέλεση με έλεγχο για σφάλματα
		if (!$stmt->execute()) {
			die("Database Error: " . $stmt->error);
		}

		$stmt->close();
	
	
	
	
	

    echo "Access Token: " . htmlspecialchars($accessToken) . "<br>";
    echo "Refresh Token: " . htmlspecialchars($refreshToken) . "<br>";
	echo "Expires In: " . htmlspecialchars($expiresIn) . " seconds<br>";


    

   

    

    echo "✅ Tokens saved successfully! You can now use send_email.php.";
} catch (Exception $e) {
    // Αν υπάρξει σφάλμα κατά την εκτέλεση του αιτήματος, το εκτυπώνουμε
    echo "Error: " . $e->getMessage();
}
?>
