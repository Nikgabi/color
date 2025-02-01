<?php include('up.php'); ?>

<head>
	<title>Medical Calculations</title>
</head>

<div id = "container" class="layout_padding2-bottom">
<br><br>

<section class="about_section">
    <div class="container  ">
      <div class="row">
        <div class="col-md-5 ">
          <div class="img-box">
            <img src="images/calculation.png" alt="">
          </div>
        </div>
        <div class="col-md-7">
          <div class="detail-box">
            
            <?php if ((isset($_SESSION['id_user']) && isset($_SESSION['role']))&& $_SESSION['role']=='visitor'){
            echo '<h2>
                Οι υπολογισμοί μας:
              </h2>
			<a href="istoriko.php">
              Ιστορικό
            </a>
			<a href="somatometr.php">
              Σωματομετρικά στοιχεία
            </a>
			
			<a href="under_constr.php">
              Βιοχημικές εξετάσεις
            </a>
			<a href="under_constr.php">
              Καρδιοαγγειακός κίνδυνος
            </a>
			<a href="appendix_child.php">
              Εκτίμηση οξ. σκωληκοειδίτιδας
            </a>
			<a href="under_constr.php">
              Σπειραματική διήθηση
            </a>
			<a href="strock.php">
              Κολπική μαρμαρυγή και εγκεφαλικό
            </a>
			<a href="depression.php">
              Εκτίμηση για κατάθλιψη
            </a>
			<a href="anxiety.php">
              Εκτίμηση για άγχος
            </a>
			<a href="under_constr.php">
              Χάσμα ανιόντων
            </a>';}
			 else {
				echo '<div class="heading_container">
              <h2>
                Για τους Ιατρικούς υπολογισμούς πρέπει να είστε εγγεγραμμένος χρήστης <span>και ΟΧΙ γιατρός.</span>
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