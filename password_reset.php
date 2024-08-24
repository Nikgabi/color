<!DOCTYPE html>
<?php
	session_start();
	include ('connection.php');
	?>

<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reset Password</title>
	<link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>
<div class="top-line">
<div id="stripe2">
<img src="ygeiafirst4.png" style="width: 20%; height: auto;" >
</div>

<div id="stripe">
	<button class="mode">HOME</button>
	<button class="mode">REGISTER</button>
	<button class="mode selected">LOGIN</button>
	<button class="mode">ΥΠΟΛΟΓΙΣΜΟΙ</button>
	<button class="mode">DOCTORS</button>
	<button class="mode">ΙΑΤΡΙΚΑ ΑΡΘΡΑ</button>
	<button class="mode">ΒΙΒΛΙΟΓΡΑΦΙΑ</button>
	
</div>
</div>

<div id = container ><br><br><br><br>
<div class="w3-card-4" style="background-color: rgb(237,242,239);">
<?php
	if(isset($_SESSION['status'])){
		?>
	<h3 style="color:red"><?= $_SESSION['status']; ?></h3>';
	<?php 
		unset($_SESSION['status']);	
	}
?>	
<form name="reset_form"  action="password_reset_code.php" method="POST" ><br>
    <label ><h2 style="font-weight: bold ;">Reset Password</h2></label><br>
    <label for="email" class="w3-row">E-mail</label><br>
    <input  type="text" name="email" placeholder="Δώστε email" size="30"><br><br>
    
	<button id="submitBtn3" class="w3-btn " type="submit" value="Είσοδος" name="submitBtn3" style="background-color: rgb(162,235,182) ;" >Send Password reset Link</button><br><br>
	
	<br><br>
	
    
    
	
	
</form>
</div>


</div>
</div>





<div id="stripe1" class="bottom-line">
<button class="rule">ΟΡΟΙ</button>
<button class="rule">ΠΟΛΙΤΙΚΗ ΑΠΟΡΡΗΤΟΥ</button>
<button class="rule">ΟΔΗΓΙΕΣ</button>
</div>
<script type="text/javascript" src="algorithm.js"></script>
</body>
</html>