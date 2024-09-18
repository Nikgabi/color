<!DOCTYPE html>
<?php
	session_start();
	include ('connection.php');
	?>
	
<html>
<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Register</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <!-- nice select -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha256-mLBIhmBvigTFWPSCtvdu6a76T+3Xyt+K571hupeFLg4=" crossorigin="anonymous" />
  <!-- datepicker -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <link href="blog.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body class="sub_page">

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="header_top">
        <div class="container">
          <div class="contact_nav">
            <a href="">
              <i class="fa fa-phone" aria-hidden="true"></i>
              <span>
                Call : +30 6944818841
              </span>
            </a>
            <a href="">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <span>
                Email : nikosgavalakis@gmail.com
              </span>
            </a>
            <a href="https://www.google.gr/maps/place/Hellenic+Open+University/@38.206531,21.7645307,714m/data=!3m2!1e3!4b1!4m6!3m5!1s0x135e49d966693855:0x8a9e099fd55ba51a!8m2!3d38.206531!4d21.767111!16zL20vMGR0cnI5?entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D" target="_blank">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              <span>
                Location
              </span>
            </a>
          </div>
        </div>
      </div>
      <div class="header_bottom">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="#">
              <img src="images/EAP-logo.svg.png" alt="">
            </a>
            

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class=""> </span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <div class="d-flex mr-auto flex-column flex-lg-row align-items-center">
                <ul class="navbar-nav  ">
                  <li class="nav-item ">
                    <a class="nav-link " href="index.php">Home</a> 
                  </li>
				  <li class="nav-item">
                    <a class="nav-link " href="calculation.php">υπολογισμοι</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link " href="https://blog.ygeiafirst.net"> Blog</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link " href="https://bibliography.ygeiafirst.net">Βιβλιογραφια</a>
                  </li>
                  <li class="nav-item active">
                    <a class="nav-link " href="https://doctors.ygeiafirst.net">Doctors</a>
                  </li>
				  <li class="nav-item">
                    <a class="nav-link " href="about.php">about</a>
                  </li>
                  
                </ul>
              </div>
			  <div class="quote_btn-container">
                <a  href="login.php">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span>
                    Login
                  </span>
                </a>
                <a  href="register.php">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span>
                    Sign Up
                  </span>
                </a>
				</div>
              
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header section -->
  </div>

<div id = container class="layout_padding-bottom"><br>
<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">
<?php
	if(isset($_SESSION['status'])){
		?>
	<h3 style="color:red"><?= $_SESSION['status']; ?></h3>';
	<?php 
		unset($_SESSION['status']);	
	}
?>	
<form name="reg_form"  action="insert_new_user.php" method="POST" onsubmit="return FormValidate()">

    <label ><h2 style="font-weight: bold ;">Εγγραφή Νέου Χρήστη</h2></label>

	<label for="name" >Nickname</label>
    <input  type="text" name="name" placeholder="Δώστε το nickname σας (το όνομα που θα έχετε)" size="50">
    <label for="email" >E-mail</label>
    <input  type="text" name="email" placeholder="Δώστε email" size="40" >
    <label  for="password">Κωδικός πρόσβασης</label>
    <input  type="password" name="password" placeholder="Δώστε password">
    <label  for="password_1" >Επιβεβαίωση κωδικού</label>
    <input  type="password" name="password_1" placeholder="Επιβεβαίωσε password">
	
	<div class="form-row">
	<label for="rolο">Γράφεσαι σάν .... </label>
	<select  id="role" name="role" onsubmit="document.getElementById('role').value;" onchange="eidikDoctor()">
		<option value="visitor" >Επισκέπτης</option>
		<option value="Doctor">Γιατρός</option>
	</select>
	</div>
	<div class="form-row" id="speciality" style=" display:none;">
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
	</select>
	</div>
	
	<div class="checkbox-container">
	<input id="terms" type="checkbox" name="sygkat" value="yes">
	<label for="sygkat"> Έχω διαβάσει τους όρους χρήσης , την πολιτική απορρήτου και τις οδηγίες</label>
    </div>
    <button id="submitBtn" name="SubmitBtn" class="w3-btn " type="submit" value="Εγγραφή"  style="background-color: rgb(162,235,182) ;" disabled >Εγγραφή</button>
	
	<label ><p style="color: red ">*Όλα τα πεδία υποχρεωτικά.Το Password 8 τουλάχιστον χαρακτήρες με 1 αριθμό και 1 κεφαλαίο γράμμα</p></label>
	
</form>

<script>
        document.getElementById('terms').addEventListener('change', function() {
            document.getElementById('submitBtn').disabled = !this.checked;
        });
</script>

</div>
</div>

<!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <p>
	   <span id="displayYear" hidden></span><!-- All Rights Reserved By
        <a href="https://html.design/">Free Html Templates</a><br>-->
        <a  href="rules.pdf" target="_blank">ΟΡΟΙ</a>
		---
        <a  href="policy.pdf" target="_blank">ΠΟΛΙΤΙΚΗ ΑΠΟΡΡΗΤΟΥ</a>
		---
		<a  href="instructions.pdf" target="_blank">ΟΔΗΓΙΕΣ</a>
      </p>
    </div>
  </footer>
  <!-- footer section -->

  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js" integrity="sha256-Zr3vByTlMGQhvMfgkQ5BtWRSKBGa2QlspKYJnkjZTmo=" crossorigin="anonymous"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <!-- datepicker -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
  
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
			speciality.style.display='flex';
		} else {
			speciality.style.display='none';
		}
		
	}
</script>
</body>
</html>
