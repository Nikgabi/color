<?php
include('connection.php');
session_start();

// Αρχικοποίηση μεταβλητών για τα αποτελέσματα
$bmi = $bsa = $bmr = $ibw = $abw = $rfm = null;

if (isset($_POST['submit'])) {
    // Λήψη των δεδομένων από τη φόρμα
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $waist = $_POST['waist'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
	$user_id= $_SESSION['id_user'];

    // Υπολογισμός BMI
    $height_m = $height / 100; // Μετατροπή σε μέτρα
    $bmi = $weight / ($height_m * $height_m);

    // Υπολογισμός BSA (με τον τύπο Du Bois)
    $bsa = 0.007184 * pow($weight, 0.425) * pow($height, 0.725);

    // Υπολογισμός BMR (Mifflin-St Jeor)
    if ($gender == 'male') {
        $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;
    } else {
        $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
    }
	
	// Υπολογισμός RFM
    if ($gender == 'male') {
        $rfm = 64 - (20 * $height/$waist);
    } else {
        $rfm = 64 - (20 * $height/$waist) + 12;
    }

    // Υπολογισμός Ύψους σε ίντσες
    $height_in_inches = $height / 2.54;

    // Υπολογισμός IBW (Ιδανικό Βάρος)
    if ($gender == 'male') {
        $ibw = 50 + 2.3 * ($height_in_inches - 60);
    } else {
        $ibw = 45.5 + 2.3 * ($height_in_inches - 60);
    }

    // Υπολογισμός ABW (Προσαρμοσμένο Βάρος)
    if ($weight > 1.3 * $ibw) {
        $abw = $ibw + 0.4 * ($weight - $ibw);
    } else {
        $abw = $weight; // Αν δεν είναι υπέρβαρος, το ABW είναι ίσο με το πραγματικό βάρος
    }
	
	// Υπολογισμός ETD
    $etd = ($height / 10) + 4;
	
	// Υπολογισμός Tidal Volume
    $tv = $ibw * 7;

    // Αποθήκευση δεδομένων στη βάση δεδομένων
    $query = "INSERT INTO health_data (user_id,height, weight, waist, age, gender, bmi, bsa, bmr, ibw, abw , rfm , etd , tv) 
              VALUES ('$user_id','$height', '$weight', '$waist', '$age', '$gender', '$bmi', '$bsa', '$bmr', '$ibw', '$abw' , '$rfm' , '$etd' , '$tv')";
$query_run = mysqli_query($con, $query);}
	
?>

<!DOCTYPE html>
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

  <title>Medical Calculations</title>


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
			  <?php 
				if(!isset($_SESSION['id_user'])){
                echo '<a  href="login.php">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span>
                    Login
                  </span>
                </a>';}
				else{
					echo '<a  href="logout.php">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span>
                    Logout
                  </span>
                </a>';
				} ?>
				<?php 
				if(!isset($_SESSION['id_user'])){
                echo '<a  href="register.php">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span>
                    Sign Up
                  </span>
                </a>';}
				else {
					echo '<a  href="#">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span>' ?>
                    <?php echo $_SESSION['email'];
                 echo '</span>
                </a>';  } ?>
					
				
				</div>
              
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header section -->
  </div>  
  
  <div id = container class="layout_padding-bottom">
	<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">
  
	<h2>Συμπλήρωσε τα στοιχεία σου</h2>
    <form action="" method="POST">
        <label for="height">Ύψος (cm):</label>
        <input type="number" name="height" required>

        <label for="weight">Βάρος (kg):</label>
        <input type="number" name="weight" required>

        <label for="waist">Περίμετρος μέσης (cm):</label>
        <input type="number" name="waist" required>

        <label for="age">Ηλικία:</label>
        <input type="number" name="age" required>

        <label for="gender">Φύλο:</label>
        <select name="gender" required>
            <option value="male">Άνδρας</option>
            <option value="female">Γυναίκα</option>
        </select><br>

        <input type="submit" name="submit" value="Υπολογισμός" style="background-color: rgb(162,235,182) ;"><br>
		
		<?php if (isset($_POST['submit'])): ?>
        <h2>Αποτελέσματα ΒΜΙ (Body Mass Index) BSA (Body Surface Area) BMR (Basal Metabolic Rate) κλπ </h2>
        <p><strong>BMI:</strong> <?php echo number_format($bmi, 2); ?> Φυσιολογικές τιμές 18.5 έως 24.9 Υπέρβαρος 25 έως 29.9 Παχύσαρκος >=30</p>
        <p><strong>BSA:</strong> <?php echo number_format($bsa, 2); ?> m²</p>
        <p><strong>BMR:</strong> <?php echo number_format($bmr, 2); ?> kcal/day</p>
		<p><strong>Related Fat Mass (RFM):</strong> <?php echo number_format($rfm, 2); ?> Παχυσαρκια για άνδρες > 22.8 , για γυναίκες 33.9 </p>
        <p><strong>Ιδανικό Βάρος (IBW):</strong> <?php echo number_format($ibw, 2); ?> kg</p>
        <p><strong>Προσαρμοσμένο Βάρος (ABW):</strong> <?php echo number_format($abw, 2); ?> kg</p>
		<p><strong>Endotracheal Tube Deapth (ETD):</strong> <?php echo number_format($etd, 0); ?> cm</p>
		<p><strong>Tidal Volume - Όγκος στον αναπνευστήρα (TV):</strong> <?php echo number_format($tv, 0); ?> ml</p>
    <?php endif; ?>
	
	<button style="background-color: rgb(162,235,182) ;"><a href="calculation.php">
              Πίσω
            </a></button><br>
		
    </form>	
  
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
  
  </html>