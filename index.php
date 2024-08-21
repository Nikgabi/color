<?php
	session_start();
	include ('connection.php');
?>

<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Πρώτα η Υγεία</title>
	<link rel="stylesheet" type="text/css" href="home.css">
</head>
<body>
<div class="top-line">
	<div id="stripe2">
	<img src="ygeiafirst4.png" style="width: 20%; height: auto;" >
	</div>

	<div id="stripe">
		<button class="mode selected">HOME</button>
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
		<button class="mode">ΥΠΟΛΟΓΙΣΜΟΙ</button>
		<button class="mode">DOCTORS</button>
		<button class="mode">ΙΑΤΡΙΚΑ ΑΡΘΡΑ</button>
		<button class="mode">ΒΙΒΛΙΟΓΡΑΦΙΑ</button>
		
	</div>
</div>

<div id = "container">
<br><br>
<div class="w3-card-4" style="background-color: rgb(237,242,239);">
<p>Καλωσήρθατε στο "ygeiafirst.net" Πρώτα η Υγεία</p>
<p>Μιά διαδικτυακή πλατφόρμα ιατρικών υπολογισμών, εκτίμησης κινδύνων και συμβουλευτικής πάνω σε θέματα υγείας.</p><br>
</div>
<br>
<div class="w3-card-4" style="background-color: rgb(237,242,239);">
<p>Η πλατφόρμα αυτή δημιουργήθηκε στα πλαίσια της πτυχιακής μου εργασίας στην Πληροφορική,του Ελληνικού Ανοικτού Πανεπιστημίου (ΕΑΠ) του οποίου είμαι τελειόφοιτος φοιτητής</p>
<p>Στο κάτω μέρος της οθόνης δείτε τους "όρους χρήσης" , την "Πολιτική"  καθώς και τις "οδηγίες"
καλής χρήσης της πλατφόρμας.</p><br>
</div>
<br>
<div class="w3-card-4" style="background-color: rgb(237,242,239);">
<p>Από το μενού των επιλογών κάνετε εγγραφή και ακολούθως σύνδεση ώς επισκέπτης ή γιατρός. Συμπληρώστε όλα τα ζητούμενα πεδία , αλλά κυρίως δώστε ένα σωστό mail για την επικοινωνία σας. Είναι τελείως απαραίτητο</p>
<p>Μετά την εγγραφή σας και την σύνδεσή σας μπορείτε να κάνετε από το μενού "ΥΠΟΛΟΓΙΣΜΟΙ" πολλούς Ιατρικούς υπολογισμούς και να αντλήσετε πληροφορίες και χρήσιμες υποδείξεις σχετικά με την υγεία σας</p>
<p>Μπορείτε ακόμα να δηλώσετε έναν από τους γιατρούς μας ώς "σύμβουλο για την υγείας σας" και να επικοινωνείτε μαζί του μέσω του e-mail ή μέσω τηλε-Ιατρικής</p>
<p>Φυσικά όλες αυτές οι Υπηρεσίες είναι δωρεάν στα πλαίσια της δημιουργίας της Πτυχιακής εργασίας</p><br>
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
