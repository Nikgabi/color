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
  <meta name="keywords" content="Medecine , Doctors, Medical functions , ΕΑΠ , πτυχιακή" />
  <meta name="description" content="Διαδικτυακή πλατφόρμα ιατρικών υπολογισμών, τηλειατρικής και 
  πληροφοριών τεχνητής νοημοσύνης στα πλαίσια πτυχιακής εργασίας στο Ελληνικό Ανοικτό Πανεπιστήμιο " />
  <meta name="author" content="Gavalakis Nikos" />
  <!-- Favicon -->
  <link rel="icon" type="image/png" href="images/favicon.png">
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
  
  <!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-WJZGQ8EM5K"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-WJZGQ8EM5K');
	</script>
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
            <a href="mailto:info@ygeiafirst.net">
              <i class="fa fa-envelope" aria-hidden="true"></i>
              <span>
                Email : info@ygeiafirst.net
              </span>
            </a>
            <a href="https://www.google.gr/maps/place/Hellenic+Open+University/@38.206531,21.7645307,714m/data=!3m2!1e3!4b1!4m6!3m5!1s0x135e49d966693855:0x8a9e099fd55ba51a!8m2!3d38.206531!4d21.767111!16zL20vMGR0cnI5?entry=ttu&g_ep=EgoyMDI0MDkwMi4xIKXMDSoASAFQAw%3D%3D" target="_blank">
              <i class="fa fa-map-marker" aria-hidden="true"></i>
              <span>
                Location
              </span>
            </a>
			</a>
			<a href="testimonials.php">
              <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
              <span>
                Testimonials
              </span>
            </a>
          </div>
        </div>
      </div>
      <div class="header_bottom">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="#">
              <img src="images/health_f.png" alt="">
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
                    <a class="nav-link " href="calculation_istor.php">ιστορικο</a>
                  </li>
				  <li class="nav-item">
                    <a class="nav-link " href="calculation.php">υπολογισμοι</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link " href="blog.php"> αρθρα</a>
                  </li>
                 <!-- <li class="nav-item">
                    <a class="nav-link " href="bibliography.php">Βιβλιογραφια</a>
                  </li>-->
                  <li class="nav-item active">
                    <a class="nav-link " href="doctors.php">Doctors</a>
                  </li>
				  <li class="nav-item active">
                    <a class="nav-link " href="charts.php">Διαγραμματα</a>
                  </li>
				  <!--<li class="nav-item">
                    <a class="nav-link " href="testimonials.php">αποψεις</a>
                  </li>-->
				  <?php
					if (isset($_SESSION['consultant']) && $_SESSION['consultant'] !== '0' && !empty($_SESSION['consultant'])) {
						
							echo '
							<li class="nav-item">
								<a class="nav-link" href="your_doctor.php">Ο ΓΙΑΤΡΟΣ ΣΟΥ</a>
							</li>';
						} 
					 else if ((isset($_SESSION['email']) && isset($_SESSION['role'])) && $_SESSION['role'] == 'visitor') {
						// Αν ο χρήστης είναι επισκέπτης
						echo '
						<li class="nav-item">
							<a class="nav-link " href="choose_doctor.php">ΔΙΑΛΕΞΕ ΓΙΑΤΡΟ</a>
						</li>';
					} else if ((isset($_SESSION['email']) && isset($_SESSION['role'])) && $_SESSION['role'] == 'Doctor') {
						// Αν ο χρήστης είναι γιατρός
						echo '
						<li class="nav-item">
							<a class="nav-link " href="teleconfer_con.php?consultant='. $_SESSION['id_user'].'">ΤΗΛΕΙΑΤΡΙΚΗ</a>
						</li>';
					} else {
						// Αν δεν ικανοποιείται καμία από τις παραπάνω συνθήκες
						echo '
						<li class="nav-item">
							<a class="nav-link " href=""></a>
						</li>';
					}
					?>
					


                  
                </ul>
              </div>
			  <div class="quote_btn-container">
			  <?php 
				if(!isset($_SESSION['email'])){
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
				if(!isset($_SESSION['email'])){
                echo '<a  href="register.php">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <span>
                    Sign Up
                  </span>
                </a>';}
				else {if ( isset($_SESSION['role']) && $_SESSION['role'] == 'visitor') {
						// Αν ο χρήστης είναι επισκέπτης
						echo '
						<i aria-hidden="true">
						
							<a class="  " href="my_data.php">YOUR DATA</a>
							
						</i>';
					} else if ( isset($_SESSION['role']) && $_SESSION['role'] == 'Doctor') {
						// Αν ο χρήστης είναι γιατρός
						echo '
						<i aria-hidden="true">
						<span>
							<a class=" " href="patiens.php">ΑΣΘΕΝΕΙΣ ΣΟΥ</a>
						</span>	
						</i>';
					}
					  } ?>
				<i aria-hidden="true">
						<span>
							<a class=" " href="statistics.php">STAT</a>
						</span>	
						</i>
				
				</div>
              
            </div>
          </nav>
        </div>
      </div>
    </header>
    <!-- end header section -->
  </div>