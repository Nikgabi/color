
<?php include('up.php'); ?>

<head>
	<title>Change Password</title>
</head>

<div id = container ><br><br>
<div class="w3-card-4" style="background-color: rgb(240,240,240);">
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
    <label ><h2 style="font-weight: bold ;">Change Password</h2></label>
    <label for="email" class="w3-row">E-mail</label>
    <input  type="text" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" placeholder="Δώστε email" size="30">
    <label  for="password">Νέος Κωδικός πρόσβασης</label>
    <input  type="password" name="new_password" placeholder="Δώστε password">
    <label  for="confirm_password">Επιβεβαίωση κωδικού</label>
    <input  type="password" name="confirm_password" placeholder="Επιβεβαιώστε το password"><br>
	<button id="submitBtn4" class="w3-btn " type="submit" value="Change Password" name="submitBtn4" style="background-color: rgb(162,235,182) ;" >Αλλαγή Password</button>
	   
	<br><br>
</form>
</div>


</div>
<?php include('down.php'); ?>


