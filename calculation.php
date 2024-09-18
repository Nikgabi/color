<?php
	session_start();
	include ('connection.php');
	
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

<div id = "container" class="layout_padding2-bottom">
<br><br>

<section class="about_section">
    <div class="container  ">
      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="images/calculation.png" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                Για τους Ιατρικούς υπολογισμούς πρέπει να είστε εγγεγραμμένος χρήστης <span>και ΟΧΙ γιατρός.</span>Οι υπολογισμοί μας:
              </h2>
            </div>
            <?php if ((isset($_SESSION['id_user']) && isset($_SESSION['role']))&& $_SESSION['role']=='visitor'){
            echo '<a href="somatometr.php">
              Σωματομετρικά στοιχεία
            </a>
			<a href="under_conSTR.php">
              Καρδιοαγγειακός κίνδυνος
            </a>
			<a href="under_constr.php">
              Εμβολιασμοί
            </a>
			<a href="under_constr.php">
              Σπειραματική διήθηση
            </a>
			<a href="under_constr.php">
              Κολπική μαρμαρυγή και εγκεφαλικό
            </a>
			<a href="under_constr.php">
              Εκτίμηση για κατάθλιψη
            </a>
			<a href="under_constr.php">
              Χάσμα ανιόντων
            </a>';}
			 else {
				echo '<h4 style="color:red ;">Πρέπει να εγγραφείτε ώς επισκέπτης για να έχετε πρόσβαση στο περιεχόμενο της σελίδας </h4>'; 
			 }
			?>
          </div>
        </div>
      </div>
    </div>
  </section><br><br>



    



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