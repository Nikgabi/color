<?php include('up.php'); 
// Αρχικοποίηση μεταβλητών για τα αποτελέσματα
$bmi = $bsa = $bmr = $ibw = $abw = $rfm = null;

if (isset($_POST['submit'])) {
    // Λήψη των δεδομένων από τη φόρμα
    $height = $_POST['height'];
    $weight = $_POST['weight'];
    $waist = $_POST['waist'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
	$user_id= $_SESSION['id_user'];

    // Υπολογισμός BMI
    $height_m = $height / 100; // Μετατροπή σε μέτρα
    $bmi = $weight / ($height_m * $height_m);

    // Υπολογισμός BSA (με τον τύπο Du Bois)
    $bsa = 0.007184 * pow($weight, 0.425) * pow($height, 0.725);

    // Υπολογισμός BMR (Mifflin-St Jeor)
    if ($gender == 'male') {
        $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) + 5;
    } else {
        $bmr = (10 * $weight) + (6.25 * $height) - (5 * $age) - 161;
    }
	
	// Υπολογισμός RFM
    if ($gender == 'male') {
        $rfm = 64 - (20 * $height/$waist);
    } else {
        $rfm = 64 - (20 * $height/$waist) + 12;
    }

    // Υπολογισμός Ύψους σε ίντσες
    $height_in_inches = $height / 2.54;

    // Υπολογισμός IBW (Ιδανικό Βάρος)
    if ($gender == 'male') {
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
	
	// Υπολογισμός ETD
    $etd = ($height / 10) + 4;
	
	// Υπολογισμός Tidal Volume
    $tv = $ibw * 7;

    // Αποθήκευση δεδομένων στη βάση δεδομένων
    $query = "INSERT INTO health_data (user_id,height, weight, waist, age, gender, bmi, bsa, bmr, ibw, abw , rfm , etd , tv) 
              VALUES ('$user_id','$height', '$weight', '$waist', '$age', '$gender', '$bmi', '$bsa', '$bmr', '$ibw', '$abw' , '$rfm' , '$etd' , '$tv')";
$query_run = mysqli_query($con, $query);}
	

?>

<head>
	<title>Σωματομετρικοί υπολογισμοί</title>
</head>

  
  <div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 ">
          <div class="img-box">
            <img src="images/106.jpg" alt="">
          </div>
        </div>
		<div class="col-md-8 ">
			<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">
		  
			<h2>Συμπλήρωσε τα στοιχεία σου</h2>
			<form action="" method="POST">
				<label for="height">Ύψος (cm):</label>
				<input type="number" name="height" required>

				<label for="weight">Βάρος (kg):</label>
				<input type="number" name="weight" required>

				<label for="waist">Περίμετρος μέσης (cm):</label>
				<input type="number" name="waist" required>

				<label for="age">Ηλικία:</label>
				<input type="number" name="age" required>

				<label for="gender">Φύλο:</label>
				<select name="gender" required>
					<option value="male">Άνδρας</option>
					<option value="female">Γυναίκα</option>
				</select><br>

				<input type="submit" name="submit" value="Υπολογισμός" style="background-color: rgb(162,235,182) ;"><br>
				
				<?php if (isset($_POST['submit'])): ?>
				<h2>Αποτελέσματα ΒΜΙ (Body Mass Index) BSA (Body Surface Area) BMR (Basal Metabolic Rate) κλπ </h2>
				<p><strong>BMI:</strong> <?php echo number_format($bmi, 2); ?> Φυσιολογικές τιμές 18.5 έως 24.9 Υπέρβαρος 25 έως 29.9 Παχύσαρκος >=30</p>
				<p><strong>BSA:</strong> <?php echo number_format($bsa, 2); ?> m²</p>
				<p><strong>BMR:</strong> <?php echo number_format($bmr, 2); ?> kcal/day</p>
				<p><strong>Related Fat Mass (RFM):</strong> <?php echo number_format($rfm, 2); ?> Παχυσαρκια για άνδρες > 22.8 , για γυναίκες 33.9 </p>
				<p><strong>Ιδανικό Βάρος (IBW):</strong> <?php echo number_format($ibw, 2); ?> kg</p>
				<p><strong>Προσαρμοσμένο Βάρος (ABW):</strong> <?php echo number_format($abw, 2); ?> kg</p>
				<p><strong>Endotracheal Tube Deapth (ETD):</strong> <?php echo number_format($etd, 0); ?> cm</p>
				<p><strong>Tidal Volume - Όγκος στον αναπνευστήρα (TV):</strong> <?php echo number_format($tv, 0); ?> ml</p>
				<?php endif; ?>
			
			<button style="background-color: rgb(162,235,182) ;"><a href="calculation.php">
					  Πίσω
					</a></button><br>
				
			</form>	
		  
			</div>
			</div> 
		  </div>
	</div> 
	</section>
	</div>
  
  <?php include('down.php'); ?>