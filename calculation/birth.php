<?php include('../up.php'); ?>
<?php
setlocale(LC_TIME, 'el_GR.UTF-8'); // Ρύθμιση τοπικής γλώσσας στα Ελληνικά
$birth_date = null;

if (isset($_POST['submit'])) {
    // Λήψη των δεδομένων από τη φόρμα
    $last = isset($_POST['last']) ? (int)$_POST['last'] : null; // Ημέρα τελευταίας περιόδου
    $last_m = isset($_POST['last_m']) ? $_POST['last_m'] : null; // Ημερομηνία τελευταίας περιόδου

    if ($last_m) {
        $now = new DateTime(); // Τρέχουσα ημερομηνία
        $last_m_date = DateTime::createFromFormat('Y-m-d', $last_m);

        if (!$last_m_date) {
            echo "<script>alert('Μη έγκυρη ημερομηνία τελευταίας περιόδου!');</script>";
        } elseif ($last_m_date > $now) {
            echo "<script>alert('Η ημερομηνία τελευταίας περιόδου δεν μπορεί να είναι στο μέλλον!');</script>";
        } else {
            // Προσθήκη των 280 ημερών για τον υπολογισμό της πιθανής ημερομηνίας γέννησης
            if ($last > 28) {
                $extra_days = $last - 28;
                $last_m_date->modify("+{$extra_days} days");
            }
            $last_m_date->modify("+280 days");
            $birth_date = strftime('%A %d %B %Y', $last_m_date->getTimestamp()); // Μορφή "Σάββατο 15 Ιουλίου 2025"

            
        }
    } else {
        echo "<script>alert('Παρακαλώ εισάγετε την ημερομηνία τελευταίας περιόδου!');</script>";
    }
}
?>


<head>
	<title>Birth date</title>
	
</head>

<div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-3 "><br><br>
          
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/birth_t.jpg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/birth_t1.jpg" alt="">
          </div><br>
		  
        </div>
		<div class="col-md-9 "><br><br>
		<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;"><br>
		<form name="child_heigh" action="" style="display: flex;  align-items: center; margin-bottom: 20px;" method="POST" ">
                <label>
                    <h2 style="font-weight: bold;">Πιθανή ημερομηνία γέννησης </h2>
                </label>
				
				
				
                <div style = "display: flex; flex-direction: column ; align-items: center; gap: 15px;">
                    <div style="width: 100%; max-width: 900px; text-align: center;">
                        <label for="last">Διάρκεια περιόδου </label>
						<input  type="text" name="last"  size="5"><br><br>
                        
                    </div>
                    
					<div style="width: 100%; max-width: 900px; text-align: center;">
                        <label for="last_m">Ημερομηνία τελευτ. περιόδου </label>
						<input  type="date" name="last_m"  size="10"><br><br>
                        
                    </div>
					
					
                </div>
				
				
                <br>
                <div style="display: flex; gap: 20px; flex-direction: row;">
				<input type="submit" name="submit" value="Υπολογισμός" style="background-color: rgb(162,235,182) ;"><br>
				<button style="background-color: rgb(162,235,182) ;"><a href="<?php echo BASE_URL; ?>calculation.php">Πίσω</a></button><br><br>
				</div><br>
				<?php if (isset($_POST['submit'])): ?>
				<p><strong>Πιθανή ημερομηνία γέννησης:</strong> <?php echo  ucfirst($birth_date); // Κεφαλαίο το πρώτο γράμμα ?> </p><br>
				<p>Βιβλιογραφία, Αμερικάνικη εταιρεία γυναικολογίας: <button><a href="<?php echo BASE_URL; ?>files/Methods for Estimating the Due Date.pdf" target="_blank">Δές το άρθρο</a></button></p><br>
				<?php endif; ?>
				</div>
				<br>
				</form>
				</div>
				</div>
				</div>
       
	</div>
	</div>
	</section> 
	<?php include('../down.php'); ?>