<?php include('../up.php'); ?>

<head>
	<title>Medical Calculations</title>
</head>

<div id = "container" class="layout_padding2-bottom">


<section class="about_section">
    <div class="container  ">
      <div class="row">
        <div class="col-md-3 "><br><br>
          <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/calculation.png" alt="">
          </div><br><br>
		  
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/chatgpt.jpg" alt="">
          </div><br><br>
		  
        </div>
		<div class="col-md-1 "><br><br>
          
		  
        </div>
        <div class="col-md-8">
		
          <div class="detail-box">
            
            <?php if ((isset($_SESSION['id_user']) && isset($_SESSION['role']))&& $_SESSION['role']=='visitor'){
            echo '<h2>
                Ιατρικοί υπολογισμοί και εκτιμήσεις κινδύνων:
              </h2>
			
			<a href="' . BASE_URL . 'calculation/somatometr.php">
              Σωματομετρικά στοιχεία και υπολογισμοί
            </a>
			<a href="' . BASE_URL . 'calculation/strock.php">
              Κολπική μαρμαρυγή και εγκεφαλικό
            </a>
			
			<a href="' . BASE_URL . 'calculation/mi_er.php">
               Κίνδυνος εμφράγματος
            </a>
			<a href="' . BASE_URL . 'calculation/appendix_child.php">
              Εκτίμηση οξ. σκωληκοειδίτιδας
            </a>
			
			
			<a href="' . BASE_URL . 'calculation/clear_creat.php">
              Σπειραματική διήθηση
            </a>
			<a href="' . BASE_URL . 'calculation/child_height.php">
              Υπολογισμός τελικού ύψους παιδιού
            </a>
			<a href="' . BASE_URL . 'calculation/birth.php">
              Πιθανή ημερομηνία γέννησης
            </a>
			<a href="' . BASE_URL . 'calculation/depression.php">
              Εκτίμηση για κατάθλιψη
            </a>
			<a href="' . BASE_URL . 'calculation/anxiety.php">
              Εκτίμηση για άγχος
            </a>
			<a href="' . BASE_URL . 'calculation/anion_gap.php">
              Χάσμα ανιόντων
            </a><hr>
			<h3>Τεχνητή νοημοσύνη </h3>
			<a href="' . BASE_URL . 'calculation/chatgpt_4.php">
              Ερώτημα προς το ChatGpt-4
            </a>
			';}
			 else {
				echo '<div class="heading_container">
              
               
            </div>
				<h2 style="color:green ;">Οι υπολογισμοί για τους οποίους έχετε πρόσβαση: </h2>
				<a href="' . BASE_URL . 'calculation/strock.php">
              Κολπική μαρμαρυγή και εγκεφαλικό
            </a>
			
			<a href="' . BASE_URL . 'calculation/mi_er.php">
               Κίνδυνος εμφράγματος
            </a>
			<a href="' . BASE_URL . 'calculation/appendix_child.php">
              Εκτίμηση οξ. σκωληκοειδίτιδας
            </a>
			
			
			<a href="' . BASE_URL . 'calculation/clear_creat.php">
              Σπειραματική διήθηση
            </a>
			<a href="' . BASE_URL . 'calculation/child_height.php">
              Υπολογισμός τελικού ύψους παιδιού
            </a>
			<a href="' . BASE_URL . 'calculation/birth.php">
              Πιθανή ημερομηνία γέννησης
            </a>
			<a href="' . BASE_URL . 'calculation/anion_gap.php">
              Χάσμα ανιόντων
            </a><hr>
			
			<h4>Τεχνητή νοημοσύνη <span style="color:green;"> μόνο για εγγεγραμένους χρήστες.</span> </h4>
			<a href="' . BASE_URL . 'calculation/chatgpt_4.php">
              Ερώτημα προς το ChatGpt-4
            </a>
				'; 
			 }
			?>
          </div>
        </div>
		</div>
      </div>
    
  </section><br><br>
  </div>

<?php include('../down.php'); ?>
