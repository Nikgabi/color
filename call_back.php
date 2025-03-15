<?php include('up.php'); ?>
<?php
require 'vendor/autoload.php';

use League\OAuth2\Client\Provider\Google;

$env = parse_ini_file('/var/www/html/color/.env1');

// Βάλε τα δικά σου Client ID & Secret
$clientId = $env['CLIENT_ID'];
$clientSecret = $env['CLIENT_SECRET'];
$redirectUri = 'https://ygeiafirst.net/call_back.php';

$provider = new Google([
    'clientId'     => $clientId,
    'clientSecret' => $clientSecret,
    'redirectUri'  => $redirectUri,
    'scope'        => 'https://www.googleapis.com/auth/gmail.send',
]);

// Βήμα 1: Δημιουργία του URL για εξουσιοδότηση
if (!isset($_GET['code'])) {
    $authUrl = $provider->getAuthorizationUrl();
    echo 'Open the following URL in your browser to authorize the app:<br>';
    echo '<a href="' . htmlspecialchars($authUrl) . '">' . htmlspecialchars($authUrl) . '</a>';
    exit;
}

// Βήμα 2: Ανταλλαγή Authorization Code με Refresh Token
$token = $provider->getAccessToken('authorization_code', [
    'code' => $_GET['code']
]);

echo 'Access Token: ' . $token->getToken() . "<br>";
echo 'Refresh Token: ' . $token->getRefreshToken();
?>
