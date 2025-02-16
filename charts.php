<?php include('up.php'); ?>

<head>
	<title>Διαγράμματα</title>
	
</head>

<div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-5 "><br><br>
          <div class="img-box">
            <img src="images/diagrama1.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="images/diagrama2.jpeg" alt="">
          </div><br>
		  
		  
        </div>
		<div class="col-md-7 ">
		<div class="detail-box">
            
            <?php if (isset($_SESSION['id_user'])){
				echo '<h2>
					Διαγράμματα: Επιλέξτε πίνακα 
				  </h2>
				  
				<a href="diagrammata1.php">
				  Πίνακας σωματομετρικών δεδομένων
				</a>
				<a href="bio_chart.php">
				  Πίνακας Βιοχημικών εξετάσεων
				</a>
				<a href="aima_chart.php">
				  Πίνακας Αιματολογικών εξετάσεων
				</a>
				<a href="pcyc_chart.php">
				  Πίνακας μέτρησης άγχους 
				</a>
				<a href="depress_chart.php">
				  Πίνακας μέτρησης κατάθλιψης
				</a>
				
				<br><br>
				';}
			 else {
					echo '<div class="heading_container">
				  <h2>
					Για να έχετε πρόσβαση στα διαγράμματα πρέπει να έχετε κάνει είσοδο ανεξάρτητα αν είστε επισκέπτης ή <span> γιατρός.</span>
				  </h2>
				</div>
					<h4 style="color:red ;">Πρέπει να εγγραφείτε  για να έχετε πρόσβαση στο περιεχόμενο της σελίδας </h4>'; 
				 }
			?>
          </div>
		  </div>









<?php include('down.php'); ?>