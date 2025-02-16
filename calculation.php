<?php include('up.php'); ?>

<head>
	<title>Medical Calculations</title>
</head>

<div id = "container" class="layout_padding2-bottom">
<br><br>

<section class="about_section">
    <div class="container  ">
      <div class="row">
        <div class="col-md-1 "><br><br><br>
          <div class="img-box">
            <img src="images/calculation.png" alt="">
          </div><br><br>
		  <div class="img-box">
            <img src="images/images.jpeg" alt="">
          </div><br><br>
		  <div class="img-box">
            <img src="images/chatgpt.jpg" alt="">
          </div><br><br>
		  <div class="img-box">
            <img src="images/history.jpg" alt="">
          </div>
        </div>
        <div class="col-md-11">
          <div class="detail-box">
            
            <?php if ((isset($_SESSION['id_user']) && isset($_SESSION['role']))&& $_SESSION['role']=='visitor'){
            echo '<h2>
                Ιατρικοί υπολογισμοί και εκτιμήσεις κινδύνων:
              </h2>
			
			<a href="somatometr.php">
              Σωματομετρικά στοιχεία και υπολογισμοί
            </a>
			<a href="strock.php">
              Κολπική μαρμαρυγή και εγκεφαλικό
            </a>
			
			<a href="mi_er.php">
               Κίνδυνος εμφράγματος
            </a>
			<a href="appendix_child.php">
              Εκτίμηση οξ. σκωληκοειδίτιδας
            </a>
			
			
			<a href="clear_creat.php">
              Σπειραματική διήθηση
            </a>
			<a href="child_height.php">
              Υπολογισμός τελικού ύψους παιδιού
            </a>
			<a href="birth.php">
              Πιθανή ημερομηνία γέννησης
            </a>
			<a href="depression.php">
              Εκτίμηση για κατάθλιψη
            </a>
			<a href="anxiety.php">
              Εκτίμηση για άγχος
            </a>
			<a href="anion_gap.php">
              Χάσμα ανιόντων
            </a><hr>
			<h3>Τεχνητή νοημοσύνη </h3>
			<a href="chatgpt3.php">
              Ερώτημα προς το ChatGpt-4
            </a>
			';}
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