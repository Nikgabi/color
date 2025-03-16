<?php include('up.php'); ?>
<?php
require 'vendor/autoload.php';  // Φόρτωσε τα απαιτούμενα dependencies μέσω Composer

use League\OAuth2\Client\Provider\Google;

$env = parse_ini_file('/var/www/html/color/.env1');

// Ρυθμίσεις Google API
$client_id = $env['CLIENT_ID'];
$client_secret = $env['CLIENT_SECRET'];
$redirect_uri = 'https://ygeiafirst.net/call_back.php';  // Πρέπει να είναι το ίδιο με το Google Console

// Δημιουργία του Google provider
$googleProvider = new Google([
    'clientId'     => $client_id,
    'clientSecret' => $client_secret,
    'redirectUri'  => $redirect_uri,
]);

// Έλεγχος αν υπάρχει authorization code
if (!isset($_GET['code'])) {
    die("Error: No authorization code provided. Please visit the authorization URL first.");
}

try {
    // Ανάκτηση του access token και refresh token με τον authorization code
    $accessToken = $googleProvider->getAccessToken('authorization_code', [
        'code' => $_GET['code'],
    ]);

    // Παίρνουμε το refresh token (αν υπάρχει)
    $refreshToken = $accessToken->getRefreshToken();
    $expiresAt = $accessToken->getExpires();

    

    // Αποθήκευση του access token και του refresh token στη βάση δεδομένων
    $stmt = $con->prepare("INSERT INTO tokens (access_token, refresh_token, expires_at) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $accessToken->getToken(), $refreshToken, date('Y-m-d H:i:s', $expiresAt));
    $stmt->execute();
    $stmt->close();

    

    echo "✅ Tokens saved successfully! You can now use send_email.php.";
} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
    // Αν υπάρχει σφάλμα στην εξουσιοδότηση
    echo 'Error fetching access token: ' . $e->getMessage();
}
?>
