<?php include('up.php'); ?>

<head>
	<title>Strock Score</title>
	
</head>
<div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 ">
          <div class="img-box">
            <img src="images/strock2.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="images/strock3.jpeg" alt="">
          </div><br>
		  
		  <div class="img-box">
            <img src="images/strock5.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="images/strock6.jpeg" alt="">
          </div><br>
        </div>
		<div class="col-md-10 " style="display: flex; flex-direction: column; align-items: center; gap: 15px;">
		<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">
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
			if ($scor == 0) {
				$message = "Πιθανότητα ισχαιμικού εγκεφαλικού 0.2% και πιθανότητα εγκεφαλικού ή παροδικού εγκεφαλικού ή εμβολής 0.3%.";
			} elseif ($scor == 1) {
				$message = "Πιθανότητα ισχαιμικού εγκεφαλικού 0.6% και πιθανότητα εγκεφαλικού ή παροδικού εγκεφαλικού ή εμβολής 0.9%.";
			} elseif ($scor == 2) {
				$message = "Πιθανότητα ισχαιμικού εγκεφαλικού 2.2% και πιθανότητα εγκεφαλικού ή παροδικού εγκεφαλικού ή εμβολής 2.9%.";
			} elseif ($scor == 3) {
				$message = "Πιθανότητα ισχαιμικού εγκεφαλικού 3.2% και πιθανότητα εγκεφαλικού ή παροδικού εγκεφαλικού ή εμβολής 4.6%.";
			} elseif ($scor == 4) {
				$message = "Πιθανότητα ισχαιμικού εγκεφαλικού 4.8% και πιθανότητα εγκεφαλικού ή παροδικού εγκεφαλικού ή εμβολής 6.7%.";
			}elseif ($scor == 5) {
				$message = "Πιθανότητα ισχαιμικού εγκεφαλικού 7.2% και πιθανότητα εγκεφαλικού ή παροδικού εγκεφαλικού ή εμβολής 10.0%.";
			} elseif ($scor == 6) {
				$message = "Πιθανότητα ισχαιμικού εγκεφαλικού 9.7% και πιθανότητα εγκεφαλικού ή παροδικού εγκεφαλικού ή εμβολής 13.6%.";
			}elseif ($scor == 7) {
				$message = "Πιθανότητα ισχαιμικού εγκεφαλικού 11.2% και πιθανότητα εγκεφαλικού ή παροδικού εγκεφαλικού ή εμβολής 15.7%.";
			} elseif ($scor == 8) {
				$message = "Πιθανότητα ισχαιμικού εγκεφαλικού 10.8% και πιθανότητα εγκεφαλικού ή παροδικού εγκεφαλικού ή εμβολής 15.2%.";
			}else  {
				$message = "Πιθανότητα ισχαιμικού εγκεφαλικού 12.2% και πιθανότητα εγκεφαλικού ή παροδικού εγκεφαλικού ή εμβολής 17.4%.";
			} 
			
			}
			 ;?>
						
				<?php if (!empty($message) && isset($_POST['submit'])): ?>
							<h2>Πιθανότητα εγκεφαλικού και εμβολικού επεισοδίου σε 1 χρόνο</h2>
							<h3><strong>SCORE:</strong> <?php echo $scor ; ?></h3><br>
                            <h3><strong></strong> <?php echo $message; ?></h3>
                 <?php endif; ?>
			<button style="background-color: rgb(162,235,182) ;"><a href="calculation.php">Πίσω</a></button><br><br>
</div>
</div>
</div>				 
</div>
</section>
</div>

<?php include('down.php'); ?>