<?php include('up.php'); ?>

<head>
	<title>Anxiety Score</title>
	
</head>
<div id = "container" class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 ">
          <div class="img-box">
            <img src="images/anxiety1.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="images/anxiety2.jpeg" alt="">
          </div><br>
		  
		  <div class="img-box">
            <img src="images/anxiety5.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="images/anxiety6.jpeg" alt="">
          </div><br>
        </div>
		<div class="col-md-10 " style="display: flex; flex-direction: column; align-items: center; gap: 15px;">
<?php 
						

		if (isset($_POST['submit'])) {
			$psyc_id = $_SESSION['id_user'];
			$er1 = $_POST['er1'];
			$er2 = $_POST['er2'];
			$er3 = $_POST['er3'];
			$er4 = $_POST['er4'];
			$er5 = $_POST['er5'];
			$er6 = $_POST['er6'];
			$er7 = $_POST['er7'];			
		// Collect all responses in an array for easier checking
			$responses = [$er1, $er2, $er3, $er4, $er5, $er6, $er7];

        // Calculate score
        $scor = array_sum($responses);
							

			// Determine message based on score
			if ($scor <= 4) {
				$message = "Δεν έχετε άγχος και είστε μέσα στα φυσιολογικά πλαίσια.";
			} elseif ($scor <= 9) {
				$message = "Μικρού βαθμού άγχος. Καλό είναι να επισκεφθείτε έναν ειδικό και να είστε υπό παρακολούθηση του άγχους σας.";
			} elseif ($scor <= 14) {
				$message = "Πρέπει να επισκεφθείτε έναν ειδικό. Έχετε άγχος σοβαρού βαθμού";
			} else  {
				$message = "Επιβάλλεται να επισκεφθείτε έναν ειδικό και πιθανότατα χρειάζεστε θεραπεία";
			}
			$psyc_id = mysqli_real_escape_string($con, $psyc_id);
			$scor = mysqli_real_escape_string($con, $scor);
			$message = mysqli_real_escape_string($con, $message);
			$query = "INSERT INTO pcyc_data (psyc_id, scor_stress, message_stress) 
          VALUES('$psyc_id', '$scor', '$message')";

				$query_run = mysqli_query($con, $query);

				

			}
			 ;?>
						
				<?php if (!empty($message) && isset($_POST['submit'])): ?>
							<h2>Απαντήσεις στο Stress Test</h2>
							<h3><strong>SCORE:</strong> <?php echo $scor ; ?></h3><br>
                            <h3><strong>Εκτίμηση:</strong> <?php echo $message; ?></h3>
							<h4>Βιβλιογραφία, Arch of internal medicine: <button><a href="https://pubmed.ncbi.nlm.nih.gov/16717171/" target="_blank">Δές το άρθρο</a></button></h4><br>
                 <?php endif; ?>
			<button style="background-color: rgb(162,235,182) ;"><a href="calculation.php">Πίσω</a></button><br><br>
</div>
</div>				 
</div>
</section>
</div>

<?php include('down.php'); ?>