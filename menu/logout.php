<?php
//Δυνατότητα αποσύνδεσης πατώντας το button «Έξοδος»
include ('../connection.php');
session_start();	        
session_unset();
$url = BASE_URL . "index.php";
header("Location: $url");
?>