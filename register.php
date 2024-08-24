<!DOCTYPE html>
<?php
	session_start();
	include ('connection.php');
	?>
	
<script>
	function FormValidate() {
	var name = document.forms["reg_form"]["name"].value;	
	var email = document.forms["reg_form"]["email"].value;
	var password = document.forms["reg_form"]["password"].value;
	var confirm_password = document.forms["reg_form"]["password_1"].value;
	
		if (name=="") {
		alert("Όλα τα πεδία πρέπει να συμπληρωθούν");
		return false;
		}
	
	// Ερώτηση 1
		// Το εmail  να περιέχει το @
		if (!email.includes("@")) {
		alert("To email πρέπει να περιέχει το @");
		return false;
		}
		// Ερώτηση 2
		//γ) Τα περιεχόμενα των πεδίων «Κωδικός» και «Επιβεβαίωση κωδικού» πρέπει να είναι ταυτόσημα. 
		//   σε αντίθετη περίπτωση θα εμφανίζεται μήνυμα σφάλματος.
		if (password !=confirm_password) {
		alert("Οι κωδικοί πρόσβασης και επιβεβαίωσης πρέπει να είναι ίδιοι");
		return false;
		}
		// Ερώτηση 2
		//β) Ο κωδικός (password) θα αποτελείται από τουλάχιστον 8 χαρακτήρες εκ των 
		// οποίων τουλάχιστον ένας αριθμητικός και ένα κεφαλαίο γράμμα. 
		// Σε αντίθετη περίπτωση θα εμφανίζεται μήνυμα σφάλματος.
		if (password.length < 8) {
		alert("Ο κωδικός (password) πρέπει να αποτελείται από τουλάχιστον 8 χαρακτήρες.");
		return false;
		}
		// Επικύρωση αριθμών
		var numbers = /[0-9]/g;
		if(!password.match(numbers)) {  
		alert("Πρέπει ένας τουλάχιστον χαρακτήρες να είναι αριθμός");
		return false;
		}
		// Επικύρωση κεφαλαίων γραμμάτων
		var upperCaseLetters = /[A-Z]/g;
		if(!password.match(upperCaseLetters)) {  
		alert("Πρέπει ένας τουλάχιστον χαρακτήρες να είναι κεφαλαίο γράμμα");
		return false;
		}	
		
	}
	function eidikDoctor(){
		var rolos=document.getElementById('role');
		var speciality=document.getElementById('speciality');
		if (rolos.value=='Doctor'){
			speciality.style.display='block';
		} else {
			speciality.style.display='none';
		}
		
	}
</script>


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
	<button class="mode">HOME</button>
	<button class="mode selected">REGISTER</button>
	<button class="mode">LOGIN</button>
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
<form name="reg_form"  action="insert_new_user.php" method="POST" onsubmit="return FormValidate()">

    <label ><h2 style="font-weight: bold ;">Εγγραφή Νέου Χρήστη</h2></label><br>

	<label for="name" class="w3-row">Nickname</label><br>
    <input  type="text" name="name" placeholder="Δώστε το nickname σας (το όνομα που θα έχετε)" size="50"><br><br>
    <label for="email" class="w3-row">E-mail</label><br>
    <input  type="text" name="email" placeholder="Δώστε email" size="40" ><br><br>
    <label  for="password">Κωδικός πρόσβασης</label><br>
    <input  type="password" name="password" placeholder="Δώστε password"><br><br>
    <label  for="password_1" >Επιβεβαίωση κωδικού</label><br>
    <input  type="password" name="password_1" placeholder="Επιβεβαίωσε password"><br><br>
	<label for="rolο">Γράφεσαι σάν .... </label>
	<select  id="role" name="role" onsubmit="document.getElementById('role').value;" onchange="eidikDoctor()">
		<option value="visitor" >Επισκέπτης</option>
		<option value="Doctor">Γιατρός</option>
	</select><br><br>
	<div id="speciality" style="text-align: center;" hidden >
	<label for="speciality">Ειδικότητα </label>
	<select   name="speciality"  onsubmit="document.getElementByName('speciality').value;">
		<option value="Αναισθησιολόγος" >Αναισθησιολόγος</option>
		<option value="Ακτινολόγος">Ακτινολόγος</option>
		<option value="Παθολόγος" >Παθολόγος</option>
		<option value="Χειρουργός">Χειρουργός</option>
		<option value="Γεν. Ιατρός">Γενικός - Οικογενειακός Ιατρός</option>
		<option value="Ορθοπαιδικός">Ορθοπαιδικός</option>
		<option value="Οφθαλμίατρος">Οφθαλμίατρος</option>
		<option value="Γυναικολόγος">Γυναικολόγος</option>
		<option value="Ουρολόγος">Ουρολόγος</option>
		<option value="Καρδιολόγος">Καρδιολόγος</option>
		<option value="Ογκολόγος">Ογκολόγος</option>
		<option value="Νεφρολόγος">Νεφρολόγος</option>
		<option value="Αιματολόγος">Αιματολόγος</option>
		<option value="Αγγειοχειρουργός">Αγγειοχειρουργός</option>
		<option value="ΩΡΛ">ΩΡΛ</option>
		<option value="Ψυχίατρος">Ψυχίατρος</option>
		<option value="Χειρουργός Παίδων">Χειρουργός Παίδων</option>
		<option value="Χειρουργός Θώρακα">Χειρουργός Θώρακα</option>
		<option value="Νευρολόγος">Νευρολόγος</option>
		<option value="Νευροχειρουργός">Νευροχειρουργός</option>
		<option value="Ουρολόγος">Ουρολόγος</option>
		<option value="Παιδίατρος">Παιδίατρος</option>
		<option value="Πνευμονολόγος">Πνευμονολόγος</option>
		<option value="Μικροβιολόγος">Μικροβιολόγος</option>
		<option value="Κυτταρολόγος">Κυτταρολόγος</option>
		<option value="Δερματολόγος">Δερματολόγος</option>
		<option value="Πλαστικός Χειρουργός">Πλαστικός Χειρουργός</option>
	</select><br><br>
	</div>
	<input id="terms" type="checkbox" name="sygkat" value="yes">
	<label for="sygkat"> Έχω διαβάσει τους όρους χρήσης , την πολιτική απορρήτου και τις οδηγίες</label><br><br>
    
    <button id="submitBtn" name="SubmitBtn" class="w3-btn " type="submit" value="Εγγραφή"  style="background-color: rgb(162,235,182) ;" disabled >Εγγραφή</button><br><br>
	
	<label ><p style="color: red ">*Όλα τα πεδία υποχρεωτικά.</p></label>
	<label ><p style="color: red ">Το Password 8 τουλάχιστον χαρακτήρες με 1 αριθμό και 1 κεφαλαίο γράμμα</p></label><br>
</form>

<script>
        document.getElementById('terms').addEventListener('change', function() {
            document.getElementById('submitBtn').disabled = !this.checked;
        });
</script>

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
