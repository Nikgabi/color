<?php include('up.php'); ?>
<?php
require 'vendor/autoload.php';

use League\OAuth2\Client\Provider\Google;

$env = parse_ini_file('/var/www/html/color/.env1');

// Ρυθμίσεις Google API
$client_id = $env['CLIENT_ID'];
$client_secret = $env['CLIENT_SECRET'];
$redirect_uri = 'https://ygeiafirst.net/call_back.php';  // Πρέπει να είναι το ίδιο με το Google Console
$scope = 'https://www.googleapis.com/auth/gmail.send';


// Δημιουργία του Google provider
$googleProvider = new Google([
    'clientId'     => $client_id,
    'clientSecret' => $client_secret,
    'redirectUri'  => $redirect_uri,
	'scope' => 'https://www.googleapis.com/auth/gmail.send', 
	'access_type' => 'offline', // Αναγκαίο για το refresh token
]);

// Δημιουργία του URL εξουσιοδότησης
$authorizationUrl = $googleProvider->getAuthorizationUrl();

echo "Πατήστε στον παρακάτω σύνδεσμο για να επιλέξετε λογαριασμό:<br>";
echo "<a href='$authorizationUrl'>$authorizationUrl</a>";
?>
