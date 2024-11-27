<?php
//Δυνατότητα αποσύνδεσης πατώντας το button «Έξοδος»
include ('connection.php');
session_start();	        
session_unset();
header ('Location:index.php');


?>