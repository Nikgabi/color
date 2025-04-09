<?php include('../up.php'); ?>

<head>
	<title>Pediatric Appendicitis Score</title>
	
</head>

<div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 ">
          <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/appendix_1.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/appendix_2.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/appendix_3.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/appendix_4.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/appendix_5.jpeg" alt="">
          </div><br>
		  
        </div>
		<div class="col-md-10 ">
		<form name="appendix" action="" style="display: flex;  align-items: center; margin-bottom: 20px;" method="POST" >
                <label>
                    <h2 style="font-weight: bold;">Eκτίμηση σκωληκοειδίτιδος σε παιδιά 3-18 ετών</h2>
                </label>
				<h3 style="color: red">Απαντήστε σε όλες τις ερωτήσεις</h3><br>
				
                <div style="display: flex; flex-direction: column; align-items: center; gap: 15px;">
                    <div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er1">Έχει ευαισθησία στη κοιλιά με τον βήχα, το χοροπηδητό ή την επίκρουση;</label><br>
                        <select class="one" name="er1" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι</option>
                            <option value="2">Ναί</option>
                            
                        </select>
                    </div>
                    <div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er2">Έχει ανορεξία;</label><br>
                        <select class="one" name="er2" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι</option>
                            <option value="1">Ναί</option>
                        </select>
                    </div>
                    <div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er3">Έχει πυρετό > 37.1;</label><br>
                        <select class="one" name="er3" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι</option>
                            <option value="1">Ναί</option>
                        </select>
                    </div>
					
					
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er4">Έχει ναυτία ή τάση για εμετό ή έχει κάνει εμετό;</label><br>
                        <select class="one" name="er4" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι</option>
                            <option value="1">Ναί</option>
                        </select>
                    </div>
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er5">Έχει ευαισθησία - πόνο στο δεξιό λαγόνιο βόθρο (δεξιό κάτω τεταρτημόριο της κοιλιάς);</label><br>
                        <select class="one" name="er5" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι</option>
                            <option value="2">Ναί</option>
                        </select>
                    </div>
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er6">Έχει λευκοκυττάρωση (Λευκά αιμοσφαίρια > 10.000);</label><br>
                        <select class="one" name="er6" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι</option>
                            <option value="1">Ναί</option>
                        </select>
                    </div>
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er7">Έχει αυξημένα πολυμορφοπύρηνα (>7.500);</label><br>
                        <select class="one" name="er7" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι</option>
                            <option value="1">Ναί</option>
                        </select>
                    </div>
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er8">Υπάρχει μετανάστευση του πόνου από τον ομφαλό στο δεξιό λαγόνιο βόθρο;</label><br>
                        <select class="one" name="er8" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι</option>
                            <option value="1">Ναί</option>
                        </select>
                    </div>
					
                </div>
                <br>
                <div style="display: flex; gap: 20px; flex-direction: row;">
				<input type="submit" name="submit" value="Καταχώρηση" style="background-color: rgb(162,235,182) ;"><br>
				<button style="background-color: rgb(162,235,182) ;"><a href="<?php echo BASE_URL; ?>menu/calculation.php">Πίσω</a></button><br><br>
				</div>
			</div>
			</form>
			</div>	
				
					
			<?php 
						$er1 = $_POST['er1'] ?? "";
						$er2 = $_POST['er2'] ?? "";
						$er3 = $_POST['er3'] ?? "";
						$er4 = $_POST['er4'] ?? "";
						$er5 = $_POST['er5'] ?? "";
						$er6 = $_POST['er6'] ?? "";
						$er7 = $_POST['er7'] ?? "";
						$er8 = $_POST['er8'] ?? "";
						
						
						$message = "";

						if (isset($_POST['submit'])) {
		// Collect all responses in an array for easier checking
    $responses = [$er1, $er2, $er3, $er4, $er5, $er6, $er7, $er8];

    
        // Calculate score
        $scor = array_sum($responses);
							

		// Determine message based on score
		if ($scor <= 3) {
			$message = "Απίθανη η διάγνωση σκωληκοειδίτιδας. Εξετάστε άλλες διαγνώσεις";
		} elseif ($scor <= 6) {
			$message = "Η σκωληκοειδίτιδα δεν μπορεί να αποκλεισθεί. Κάνετε έλεγχο με υπερηχογράφημα ή CT ή παραπέμψετε σε χειρουργό";
		} 
		} else {
			$message = "Πολύ πιθανή η σκωληκοειδίτιδα. Πρέπει να εκτιμηθεί από Χειρουργό";
		}
							
							
						 ?>
						
				<?php if (!empty($message) && isset($_POST['submit'])): ?>
							<h3><strong>SCORE:</strong> <?php echo isset($scor) ? $scor : "-"; ?></h3><br>
                            <h3><strong>Εκτίμηση:</strong> <?php echo $message; ?></h3>
							<h4>Βιβλιογραφία, Journal of Paediatric Surgery: <button><a href="<?php echo BASE_URL; ?>files/Pediatric-Appendicitis-Score.pdf" target="_blank">Δές το άρθρο</a></button></h4><br>
                 <?php endif; ?>		
					
	
               
            
        </div>
    </div>
</section>


<?php include('../down.php'); ?>


