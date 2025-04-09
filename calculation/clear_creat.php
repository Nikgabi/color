<?php include('../up.php'); ?>
<?php
	$bmi=$krea=$height=$gender=$weight=$age=$ibw=$abw=$clear_crea=$diort=null;
	
	function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['submit'])) {

	$height = test_input($_POST['height']);
    $weight = test_input($_POST['weight']);
	$gender = $_POST['gender'];
	$age = test_input($_POST['age']);
	$krea = test_input($_POST['krea']);

	// Υπολογισμός BMI
    $height_m = $height / 100; // Μετατροπή σε μέτρα
    $bmi = $weight / ($height_m * $height_m);
	
	// Υπολογισμός Ύψους σε ίντσες
    $height_in_inches = $height / 2.54;

    // Υπολογισμός IBW (Ιδανικό Βάρος)
	
    if ($gender == 'male' ) {
        $ibw = 50 + 2.3 * ($height_in_inches - 60);
    } else {
        $ibw = 45.5 + 2.3 * ($height_in_inches - 60);
    }

    // Υπολογισμός ABW (Προσαρμοσμένο Βάρος)
    if ($weight > 1.3 * $ibw) {
        $abw = $ibw + 0.4 * ($weight - $ibw);
    } else {
        $abw = $weight; // Αν δεν είναι υπέρβαρος, το ABW είναι ίσο με το πραγματικό βάρος
    }
	if($gender == 'male'){
		$clear_crea=((140-$age)*$weight)/(72*$krea);
	}else{
		$clear_crea=((140-$age)*$weight*0.85)/(72*$krea);
	}
	
	if ($bmi <=24.9){
		$diort=$clear_crea*$ibw/$weight;
	}else{
		$diort=$clear_crea*$abw/$weight;
	}	
}
?>

<head>
	<title>Σπειραματική διήθηση</title>
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
			<h2 style="align-items: center;">Υπολογισμός κάθαρσης κρεατινίνης</h2>
			<h3 style="align-items: center;">Creatinine Clearance (Cockcroft-Gault Equation)</h3>
		  <br>
			
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<label for="height">Ύψος (cm):</label>
				<input type="text" name="height" size="5" required>
			
				<label for="weight">Βάρος (kg):</label>
				<input type="text" name="weight" size="5" required>
				
			</div><br>
			<div style="display: flex; gap: 20px; flex-direction: row;">
			
				<label for="age">Ηλικία:</label>
				<input type="text" name="age" size="5" required>
				<label for="krea">Κρεατινίνη αιμ. (mg/dl):</label>
				<input type="text" name="krea" size="5" required>
			
				
			</div><br>
			
			
			
			<div style="display: flex; gap: 20px; flex-direction: row;">
			
			<label for="gender">Φύλο:</label>
				<select name="gender" required>
					<option value="male">Άνδρας</option>
					<option value="female">Γυναίκα</option>
				</select>
			</div><br>
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<input type="submit" name="submit" value="Υπολογισμός" style="background-color: rgb(162,235,182) ;"><br>
			
			<button style="background-color: rgb(162,235,182) ;"><a href="<?php echo BASE_URL; ?>menu/calculation.php">
					  Πίσω
					</a></button><br>
			</div><br>	
			</form>	
			<?php if (isset($_POST['submit'])): ?>
			<p><strong>Κάθαρση κρεατινίνης :</strong> <?php echo number_format($clear_crea,0); ?> ml/min</p><br>
			<p><strong>Διορθωμένη για υπέρβαρους/λιποβαρείς:</strong> <?php echo number_format($diort,0); ?> ml/min</p><br>
			<?php endif; ?>
			</div>
			</div>
			</div> 
		  </div>
	 
	</section>
	</div>
  
  <?php include('../down.php'); ?>