<?php
   define('BASE_URL', 'https://ygeiafirst.net/');
   $env = parse_ini_file('/var/www/html/color/.env');
   $server = 'localhost';
   $user = 'root';
   $passw = $env['PASSW'];
   $dbname = 'gavalakis';
   
$con = mysqli_connect($server,$user,$passw,$dbname);

// Έλεγχος επιτυχούς σύνδεσης με τη βάση gavalakis

if(!$con) {
	die("Η Βάση αντιμετώπισε κάποιο σφάλμα !!!"); }
else {
mysqli_select_db($con, $dbname);

mysqli_set_charset($con,'utf8'); }
?>
