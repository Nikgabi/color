<?php include('../up.php'); ?>
<?php
	$na=$cl=$dit=$alb=$anion_gap=$cor_anion_gap=$delta_gap=$cor_delta_gap=$delta_ration=$cor_delta_ration=null;
	$message="";
if (isset($_POST['submit'])) {

	$na = $_POST['na'];
    $cl = $_POST['cl'];
	$dit = $_POST['dit'];
	if($dit==24){
		$dit=24.1;
	}
	$alb = $_POST['alb'];

	// Υπολογισμός anion gap
    $anion_gap = $na-($cl+$dit);
	$cor_anion_gap = $anion_gap + (4-$alb)*2.5 ;
    $delta_gap=$anion_gap-12;
	$cor_delta_gap=$cor_anion_gap-12;
	$delta_ration=$delta_gap/(24-$dit);
	$cor_delta_ration=$cor_delta_gap/(24-$dit);
	if( $cor_delta_ration<0.4){
		$message="Υπερχλωραιμική οξέωση με φυσιολογικό χάσμα ανιόντων";
	} else if($cor_delta_ration<1){
		$message="Υψηλό AG & φυσιολογική οξέωση ";	
	} else if($cor_delta_ration<2){
		$message="Καθαρή οξέωση με χάσμα ανιόντων ";	
	}else {
		$message="Υψηλή  οξέωση και ταυτόχρονη μεταβολική αλκάλωση ή προϋπάρχουσα αντιρροπούμενη αναπνευστική οξέωση ";
	}
}
?>
<head>
	<title>Χάσμα Ανιόντων</title>
</head>

  
  <div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 "><br><br>
          <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/106.jpg" alt="">
          </div>
        </div>
		<div class="col-md-8 "><br><br><br>
		<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">
		<form action="" method="POST">
			<h2 style="align-items: center;">Υπολογισμός Χάσματος Ανιόντων</h2>
			<h3 style="align-items: center;">Υπολογίζετε σε ασθενείς με οξέωση</h3>
		  <br>
			
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<label for="na">Νάτριο (mEql/L):</label>
				<input type="text" name="na" size="5" required>
			
				<label for="cl">Χλώριο (mEql/L):</label>
				<input type="text" name="cl" size="5" required>
				
			</div><br>
			<div style="display: flex; gap: 20px; flex-direction: row;">
			
				<label for="dit">Διτανθρακικά (mEql/L):</label>
				<input type="text" name="dit" size="5" required>
				<label for="alb">Αλβουμίνη (g/dl):</label>
				<input type="text" name="alb" size="5" required>
			
				
			</div><br>
			
			
			
			
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<input type="submit" name="submit" value="Υπολογισμός" style="background-color: rgb(162,235,182) ;"><br>
			
			<button style="background-color: rgb(162,235,182) ;"><a href="<?php echo BASE_URL; ?>calculation.php">
					  Πίσω
					</a></button><br>
			</div><br>	
			</form>	
			<?php if (isset($_POST['submit'])): ?>
			<p><strong>Χάσμα Ανιόντων :</strong> <?php echo $anion_gap; ?> mEq/L</p><br>
			<p><strong>Διορθωμένo Χάσμα Ανιόντων:</strong> <?php echo $cor_anion_gap; ?> mEq/L</p><br>
			<p><strong>Χάσμα Δέλτα :</strong> <?php echo $delta_gap; ?> mEq/L</p><br>
			<p><strong>Διορθωμένo Χάσμα Δέλτα:</strong> <?php echo $cor_delta_gap; ?> mEq/L</p><br>
			<p><strong>Αναλαγία Δέλτα :</strong> <?php echo number_format($delta_ration,2); ?> </p><br>
			<p><strong>Διορθωμένη Αναλογία Δέλτα:</strong> <?php echo number_format($cor_delta_ration,2); ?> </p><br>
			<p><strong>Συμπέρασμα:</strong> <?php echo $message; ?> </p><br>
			
			<?php endif; ?>
			</div>
			</div>
			</div> 
		  </div>
	 
	</section>
	</div>
  
  <?php include('../down.php'); ?>












