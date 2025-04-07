<?php include('up.php'); ?>

<head>
	<title>Medical Calculations</title>
</head>

<div id = "container" class="layout_padding2-bottom">
<br><br>

<section class="about_section">
    <div class="container  ">
      <div class="row">
        <div class="col-md-3 ">
          <div class="img-box">
            <img src="images/history1.jpg" alt="">
          </div>
        </div>
		
        <div class="col-md-9">
		
          <div class="detail-box">
            
            <?php if ((isset($_SESSION['id_user']) && isset($_SESSION['role']))&& $_SESSION['role']=='visitor'){
            echo '<h2>
                Εισαγωγή ιστορικού , εξετάσεων & διαγνώσεων:
              </h2>
			  <p>Βάλετε στοιχεία από το ιστορικό σας, τις εξετάσεις σας και τυχόν γνωματεύσεις από ειδικούς γιατρούς. 
			  Μόνο ο γιατρός που έχετε επιλέξει έχει πρόσβαση στα δεδομένα σας. Τα δεδομένα σας είναι ασφαλή.
			  </p>
			<a href="h_istory/istoriko.php">
              Εισαγωγή Ιστορικού
            </a>
			<a href="h_istory/bioximiko.php">
              Βιοχημικές εξετάσεις
            </a>
			<a href="h_istory/aimatologiko.php">
              Αιματολογικές εξετάσεις
            </a>
			<a href="h_istory/ormon.php">
              Μικροβιολογικές κ.α εξετάσεις 
            </a>
			<a href="h_istory/aktino.php">
              Απεικονιστικές εξετάσεις
            </a>
			<a href="h_istory/loipes_exet.php">
              Λοιπές εξετάσεις
            </a>
			<a href="h_istory/gnomat.php">
              Γνωματεύσεις από ειδικούς
            </a><hr>
			<br><br>
			';}
			 else {
				echo '<div class="heading_container">
              
              <h2> Για την συμπλήρωση του Ιατρικού Ιστορικού σας και των εξετάσεών σας πρέπει να είστε εγγεγραμμένος χρήστης <span>και ΟΧΙ γιατρός.</span>
              </h2>
            </div>
				<h4 style="color:red ;">Πρέπει να εγγραφείτε ώς επισκέπτης για να έχετε πρόσβαση στο περιεχόμενο της σελίδας </h4>'; 
			 }
			?>
          </div>
		  </div>
        </div>
      
    </div>
  </section><br><br>
  </div>

<?php include('down.php'); ?>