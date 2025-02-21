<?php include('up.php'); ?>

<head>
	<title>Deppression Results</title>
	
</head>

<div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 ">
          <div class="img-box">
            <img src="images/depres4.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="images/depres5.jpeg" alt="">
          </div><br>
		  
		  <div class="img-box">
            <img src="images/depres2.jpeg" alt="">
          </div><br>
		 
        </div>
		
	<div class="col-md-10 " style="display: flex; flex-direction: column; align-items: center; gap: 15px;">
	
	<?php 
		if (isset($_POST['submit'])) {
		$depress_id = $_SESSION['id_user'];
		$er1 = $_POST['er1'];
		$er2 = $_POST['er2'];
		$er3 = $_POST['er3'];
		$er4 = $_POST['er4'];
		$er5 = $_POST['er5'];
		$er6 = $_POST['er6'];
		$er7 = $_POST['er7'];
		$er8 = $_POST['er8'];
		$er9 = $_POST['er9'];
			// Collect all responses in an array for easier checking
    $responses = [$er1, $er2, $er3, $er4, $er5, $er6, $er7, $er8, $er9];

    
        // Calculate score
        $scor = array_sum($responses);
							

		// Determine message based on score
		if ($scor <= 4) {
			$message = "Δεν έχετε κατάθλιψη.";
		} elseif ($scor <= 9) {
			$message = "Μικρού βαθμού κατάθλιψη. Καλό είναι να επισκεφθείτε έναν ειδικό.";
		} elseif ($scor <= 14) {
			$message = "Ενδιάμεσου βαθμού κατάθλιψη. Πρέπει να επισκεφθείτε έναν ειδικό.";
		} elseif ($scor <= 19) {
			$message = "Σοβαρού βαθμού κατάθλιψη. Επιβάλλεται να επισκεφθείτε έναν ειδικό.";
		} else {
			$message = "Πολύ σοβαρού βαθμού κατάθλιψη. Πιθανό είναι να χρειάζεστε νοσηλεία και φαρμακευτική αγωγή. Επισκεφθείτε αμέσως έναν ειδικό.";
		}
	$query="INSERT INTO depress_data(depress_id , scor_depress , message_depress) VALUES('$depress_id','$scor','$message')";
	$query_run = mysqli_query($con, $query);
	}
		?>
						
				<?php if (!empty($message) && isset($_POST['submit'])): ?>
							<h2>Απαντήσεις για την Κατάθλιψη</h2>
							<h3><strong>SCORE:</strong> <?php echo isset($scor) ? $scor : "-"; ?></h3><br>
                            <h3><strong>Εκτίμηση:</strong> <?php echo $message; ?></h3>
							<h4>Βιβλιογραφία, Journal of General internal medicine: <button><a href="files/PHQ-9.pdf" target="_blank">Δές το άρθρο</a></button></h4><br>
                 <?php endif; ?>
				 <button style="background-color: rgb(162,235,182) ;"><a href="calculation.php">Πίσω</a></button><br><br>
				 
</div>
    </div>
</section>
</div>

<?php include('down.php'); ?>