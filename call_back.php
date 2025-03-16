<?php include('up.php'); ?>
<?php
require 'vendor/autoload.php';

use League\OAuth2\Client\Provider\Google;

$env = parse_ini_file('/var/www/html/color/.env1');

// Βάλε τα δικά σου Client ID & Secret
$clientId = $env['CLIENT_ID'];
$clientSecret = $env['CLIENT_SECRET'];
$redirectUri = 'https://ygeiafirst.net/call_back.php';



// Έλεγχος αν υπάρχει authorization code
if (!isset($_GET['code'])) {
    die("No authorization code provided.");
}

// Ανταλλαγή του authorization code με access & refresh token
$token_url = "https://oauth2.googleapis.com/token";
$params = [
    'code' => $_GET['code'],
    'client_id' => $clientId,
    'client_secret' => $clientSecret,
    'redirect_uri' => $redirectUri,
    'grant_type' => 'authorization_code'
];

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $token_url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl);
curl_close($curl);

$token_info = json_decode($response, true);

if (!isset($token_info['access_token'], $token_info['refresh_token'])) {
    die("Error fetching tokens: " . $response);
}

// Παίρνουμε τα tokens
$access_token = $token_info['access_token'];
$refresh_token = $token_info['refresh_token'];
$expires_at = date('Y-m-d H:i:s', time() + $token_info['expires_in']);

// Αποθήκευση στη βάση δεδομένων
$stmt = $conn->prepare("INSERT INTO tokens (access_token, refresh_token, expires_at) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $access_token, $refresh_token, $expires_at);
$stmt->execute();
$stmt->close();



echo "Tokens saved successfully! You can now use send_email.php.";
?>
