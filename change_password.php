
<?php
	session_start();
	include ('connection.php');
?>	
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Change Password Form</title>
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
<form name="change_password_form"  action="password_reset_code.php" method="POST" >
    <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];} ?>" >
    <label ><h2 style="font-weight: bold ;">Change Password</h2></label><br>
    <label for="email" class="w3-row">E-mail</label><br>
    <input  type="text" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" placeholder="Δώστε email" size="30"><br><br>
    <label  for="password">Νέος Κωδικός πρόσβασης</label><br>
    <input  type="password" name="new_password" placeholder="Δώστε password"><br><br>
    <label  for="confirm_password">Επιβεβαίωση κωδικού</label><br>
    <input  type="password" name="confirm_password" placeholder="Επιβεβαιώστε το password"><br><br>
	<button id="submitBtn4" class="w3-btn " type="submit" value="Change Password" name="submitBtn4" style="background-color: rgb(162,235,182) ;" >Αλλαγή Password</button><br><br>
	
    
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


