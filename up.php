<!DOCTYPE html>
<?php
	session_start();
	include ('connection.php');
?>	
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="Medecine , Doctors, Medical functions , ΕΑΠ , πτυχιακή" />
  <meta name="description" content="Διαδικτυακή πλατφόρμα ιατρικών υπολογισμών, τηλειατρικής και πληροφοριών τεχνητής νοημοσύνης στα πλαίσια πτυχιακής εργασίας στο Ελληνικό Ανοικτό Πανεπιστήμιο " />
  <meta name="author" content="Gavalakis Nikos" />
  <link rel="icon" type="image/png" href="<?php echo BASE_URL; ?>images/favicon.png">

  <!-- Scripts & CSS -->
  <script src="<?php echo BASE_URL; ?>js/jquery-3.7.1.min.js"></script>
  <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/bootstrap.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link href="<?php echo BASE_URL; ?>css/font-awesome.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
  <link href="<?php echo BASE_URL; ?>css/style.css" rel="stylesheet" />
  <link href="<?php echo BASE_URL; ?>css/blog.css" rel="stylesheet" />
  <link href="<?php echo BASE_URL; ?>css/responsive.css" rel="stylesheet" />

  <!-- Google Analytics -->
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
    <!-- header section -->
    <header class="header_section">
      <div class="header_top">
        <div class="container">
          <div class="contact_nav">
            <a href="#">
              <i class="fa fa-phone"></i><span>Call :6944818841</span>
            </a>
            <a href="mailto:info@ygeiafirst.net">
              <i class="fa fa-envelope"></i><span>Email :info@ygeiafirst.net</span>
            </a>
            <a href="<?php echo BASE_URL; ?>auxi/location.php">
              <i class="fa fa-map-marker"></i><span>Location</span>
            </a>
            <a href="<?php echo BASE_URL; ?>auxi/pdf_helping.php">
              <i class="fa fa-folder-open-o"></i><span>pdf_help</span>
            </a>
            <a href="<?php echo BASE_URL; ?>auxi/normal_values.php">
              <i class="fa fa-wheelchair"></i><span>Φυσ_τιμές</span>
            </a>
            <a href="<?php echo BASE_URL; ?>auxi/opinion.php">
              <i class="fa fa-star-o"></i><span>your_opinion</span>
            </a>
            <?php 
              if ((isset($_SESSION['email']) && isset($_SESSION['role'])) && $_SESSION['role'] == 'Doctor') {
                echo '
                <a href="' . BASE_URL . 'auxi/form_doctor.php">
                  <i class="fa fa-user-md"></i><span>for_doctors</span>
                </a>';
              }
            ?>
          </div>
        </div>
      </div>

      <div class="header_bottom">
        <div class="container-fluid">
          <nav class="navbar navbar-expand-lg custom_nav-container">
            <a class="navbar-brand" href="<?php echo BASE_URL; ?>">
              <img src="<?php echo BASE_URL; ?>images/health_f.png" alt="">
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
              <span class=""></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <div class="d-flex mr-auto flex-column flex-lg-row align-items-center">
                <ul class="navbar-nav">
                  <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>index.php">Home</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>calculation_istor.php">ιστορικο</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>calculation.php">υπολογισμοι</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>blog.php">αρθρα</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>doctors.php">Doctors</a></li>
                  <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>charts.php">Διαγραμματα</a></li>
                  <?php
                    if (isset($_SESSION['consultant']) && $_SESSION['consultant'] !== '0' && !empty($_SESSION['consultant'])) {
                      echo '<li class="nav-item"><a class="nav-link" href="' . BASE_URL . 'your_doctor.php">Ο ΓΙΑΤΡΟΣ ΣΟΥ</a></li>';
                    } else if ((isset($_SESSION['email']) && isset($_SESSION['role'])) && $_SESSION['role'] == 'visitor') {
                      echo '<li class="nav-item"><a class="nav-link" href="' . BASE_URL . 'choose_doctor.php">ΔΙΑΛΕΞΕ ΓΙΑΤΡΟ</a></li>';
                    } else if ((isset($_SESSION['email']) && isset($_SESSION['role'])) && $_SESSION['role'] == 'Doctor') {
                      echo '<li class="nav-item"><a class="nav-link" href="' . BASE_URL . 'h_istory/teleconfer_con.php?consultant=' . $_SESSION['id_user'] . '">ΤΗΛΕΙΑΤΡΙΚΗ</a></li>';
                    }
                  ?>
                </ul>
              </div>

              <div class="quote_btn-container">
                <?php 
                  if(!isset($_SESSION['email'])){
                    echo '<a href="' . BASE_URL . 'login.php"><i class="fa fa-user"></i><span>Login</span></a>';
                  } else {
                    echo '<a href="' . BASE_URL . 'logout.php"><i class="fa fa-user"></i><span>Logout</span></a>';
                  }

                  if(!isset($_SESSION['email'])){
                    echo '<a href="' . BASE_URL . 'register.php"><i class="fa fa-user"></i><span>Sign Up</span></a>';
                  } else {
                    if (isset($_SESSION['role']) && $_SESSION['role'] == 'visitor') {
                      echo '<i><a class="" href="' . BASE_URL . 'my_data.php">YOUR DATA</a></i>';
                    } else if (isset($_SESSION['role']) && $_SESSION['role'] == 'Doctor') {
                      echo '<i><span><a class="" href="' . BASE_URL . 'patiens.php">ΑΣΘΕΝΕΙΣ ΣΟΥ</a></span></i>';
                    }
                  }
                ?>
                <i><span><a class="" href="<?php echo BASE_URL; ?>auxi/statistics.php">STAT</a></span></i>
              </div>
            </div>
          </nav>
        </div>
      </div>
    </header>
  </div>
