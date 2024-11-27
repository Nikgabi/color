<?php include('up.php'); ?>

<head>
	<title>Medical Calculations</title>
</head>

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
			<a href="istoriko.php">
              Ιστορικό
            </a>
			<a href="exetaseis.php">
              Βιοχημικές εξετάσεις
            </a>
			<a href="under_constr.php">
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
  </div>

<?php include('down.php'); ?>