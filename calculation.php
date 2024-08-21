<?php
	session_start();
	include ('connection.php');
?>

<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ιατρικές εξισώσεις και υπολογισμοί</title>
	<link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>
<div class="top-line">
<div id="stripe2">
<img src="ygeiafirst4.png" style="width: 20%; height: auto;" >
</div>

<div id="stripe">
	<button class="mode ">HOME</button>
	<?php 
	if(!isset($_SESSION['id_user'])){
		echo '<button class="mode">REGISTER</button>';
		}
	else {
		echo '<button class="mode">'?><?php echo $_SESSION['email']; echo '</button>';
	}
	
	?>
	<?php 
	if(!isset($_SESSION['id_user'])){
		echo '<button class="mode">LOGIN</button>';
		}
	else {
		echo '<button class="mode">LOGOUT</button>';
	}
	?>
	<button class="mode selected">ΥΠΟΛΟΓΙΣΜΟΙ</button>
	<button class="mode">DOCTORS</button>
	<button class="mode">ΙΑΤΡΙΚΑ ΑΡΘΡΑ</button>
	<button class="mode">ΒΙΒΛΙΟΓΡΑΦΙΑ</button>
	
</div>
</div>

<div id = "container">
<br><br>
<div class="w3-card-4" style="background-color: rgb(237,242,239);">
<p>Για τους Ιατρικούς υπολογισμούς πρέπει να είστε εγγεγραμμένος χρήστης και ΟΧΙ γιατρός.</p>
<button style="background-color: rgb(162,235,182) ;" onclick="location.href='under_constr.php';">Σωματομετρικά στοιχεία</button><br><br>
<button style="background-color: rgb(162,235,182) ;" onclick="location.href='under_constr.php';">Εκτίμηση καρδιοαγγειακού κινδύνου</button><br><br>
<button style="background-color: rgb(162,235,182) ;" onclick="location.href='under_constr.php';">Εμβολιασμοί</button><br><br>
<button style="background-color: rgb(162,235,182) ;" onclick="location.href='under_constr.php';">Σπειραματική διήθηση</button><br><br>
<button style="background-color: rgb(162,235,182) ;" onclick="location.href='under_constr.php';">Κολπική μαρμαρυγή και εγκεφαλικό</button><br><br>
<button style="background-color: rgb(162,235,182) ;" onclick="location.href='under_constr.php';">Εκτίμηση για κατάθλιψη</button><br><br>
<button style="background-color: rgb(162,235,182) ;" onclick="location.href='under_constr.php';">Χάσμα ανιόντων</button><br><br>
</div><br><br>

<div class="w3-card-4" style="background-color: rgb(237,242,239);">
<p>Διαλέξτε ώς σύμβουλο υγείας σας έναν από τους γιατρούς μας</p><br>
<button style="background-color: rgb(92, 222, 135) ;" onclick="location.href='https://www.youtube.com/watch?v=1K4NAldaflU&list=PL6dNAFGMSznlW4CpUtaJYljWhgybGL7W8';" target="_blank">Doxy-me</button><br><br>

</div>    



<div id="stripe1" class="bottom-line">
<button class="rule">ΟΡΟΙ</button>
<button class="rule">ΠΟΛΙΤΙΚΗ ΑΠΟΡΡΗΤΟΥ</button>
<button class="rule">ΟΔΗΓΙΕΣ</button>
</div>
<script type="text/javascript" src="algorithm.js"></script>
</body>
</html>