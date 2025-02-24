<?php include('up.php'); ?>

<head>
	<title>Διαγράμματα</title>
	
</head>

<div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 "><br><br>
          <div class="img-box">
            <img src="images/diagrama1.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="images/diagrama2.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="images/diagrama3.jpeg" alt="">
          </div><br>
		  
		  
        </div>
		<div class="col-md-10 ">
		<div class="detail-box">
            
            <?php if (!isset($_SESSION['id_user'])): ?>
				<h2 style="color:green;">Στατιστικά στοιχεία μέσων όρων</h2>
				
				  
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
			
			<?php endif; ?>	
			<?php if (isset($_SESSION['id_user']) && $_SESSION['role']=='visitor'): ?>
			<h2 style="color:green;">Δεδομένα σας και σύγκριση μέσων όρων</h2>
				
				  
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
				
			<?php endif; ?>	
			<?php if (isset($_SESSION['id_user']) && $_SESSION['role']=='Doctor'): ?>
			<h2 style="color:green;">Σύγκριση μέσων όρων ασθενών σας</h2>
				
				  
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
			
			<?php endif; ?>
			
          </div>
		  </div>









<?php include('down.php'); ?>