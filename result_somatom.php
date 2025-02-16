<?php include('up.php');
// Αρχικοποίηση μεταβλητών για τα αποτελέσματα
$bmi = $bsa = $bmr = $ibw = $abw = $rfm = $C0=$CI=$SV=$MAP=null;

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['submit'])) {
    // Λήψη των δεδομένων από τη φόρμα
    $height = test_input($_POST['height']);
    $weight = test_input($_POST['weight']);
    $waist = test_input($_POST['waist']);
    $age = test_input($_POST['age']);
    $gender = test_input($_POST['gender']);
	$sbp=test_input($_POST['sbp']);
	$dbp=test_input($_POST['dbp']);
	$HR=test_input($_POST['HR']);
	$apost=test_input($_POST['apost']);
	$Hb=test_input($_POST['Hb']);
	$SaO2=test_input($_POST['SaO2']);
	$SvO2 = empty(test_input($_POST['SvO2'])) ? 75 : test_input($_POST['SvO2']);
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
	
	// Υπολογισμός ETD
    $etd = ($height / 10) + 4;
	
	// Υπολογισμός Tidal Volume
    $tv = $ibw * 7;
	
	// Υπολογισμός MAP (Mean Arterial Pressure -  μέση αρτηριακή πίεση)
    $MAP = (2/3)*$dbp + (1/3)*$sbp ;
	
	// Υπολογισμός καρδιακής παροχής CO (Cardiac output) ,καρδιακού δείκτη CI (Cardiac Index ) ,όγκου παλμού
	if ($age <70){
		$VO2 = 125*$bsa;
	}else{
		$VO2 = 110*$bsa;
		}
	$CO = $VO2*100/(($SaO2-$SvO2)*$Hb*13.4);
	$CI = $CO/$bsa;
	$SV=$CO*1000/$HR;
	
	
	
	//Υπολογισμός ενδοφλεβίων υγρών 24ώρου
	$iwater=1500+($ibw-20)*20;
	
	//Υπολογισμός 6 min walk distance
	if ($gender == 'male'){
		$_6MWD=(7.57*$height)-(5.02*$age)-(1.76*$weight)-309;
		$_minWD=$_6MWD-153;
	}
	else{
		$_6MWD=(2.11*$height)-(5.78*$age)-(2.29*$weight)+667;
		$_minWD=$_6MWD-139 ;
	}
	$expect=$apost*100/$_6MWD ;
	
	

    // Αποθήκευση δεδομένων στη βάση δεδομένων
    $query = "INSERT INTO health_data (user_id,height, weight, waist, age, gender, bmi, bsa, bmr, ibw, abw , rfm , etd , tv, co, ci, sv, map, apost, expect ) 
              VALUES ('$user_id','$height', '$weight', '$waist', '$age', '$gender', '$bmi', '$bsa', '$bmr', '$ibw', '$abw' , '$rfm' , '$etd' , '$tv','$CO','$CI','$SV','$MAP','$apost','$expect')";
$query_run = mysqli_query($con, $query);}
	

?>

<head>
	<title>Αποτελέσματα σωματομετρικών υπολογισμών</title>
</head>

<div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 ">
          <div class="img-box">
            <img src="images/106.jpg" alt="">
          </div>
        </div>
		<div class="col-md-10 ">
			<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">
			<?php if (isset($_POST['submit'])): ?>
				<h3 style="color: red">Αποτελέσματα για ενήλικες. Δεν είναι σωστά για ηλικίες κάτω των 18 ετών</h3><br>
				<p style="color: red">Το ιδανικό βάρος υπολογίζεται σε άτομα πάνω από 153 cm ύψος</p><br>
				
				<p><strong>BMI (Body Mass Index):</strong> <?php echo number_format($bmi, 2); ?></p><br>
				<p> Φυσιολογικές τιμές 18.5 έως 24.9. Υπέρβαρος 25 έως 29.9. Παχύσαρκος >=30.</p><br>
				<p><strong>BSA (Body Surface Area):</strong> <?php echo number_format($bsa, 2); ?> m²</p><br>
				<p><strong>BMR (Basal Metabolic Rate):</strong> <?php echo number_format($bmr, 2); ?> kcal/day ο βασικός μεταβολισμός.</p><br>
				<p><strong>RFM (Related Fat Mass):</strong> <?php echo number_format($rfm, 2); ?>%.Ποσοστό του λίπους(Παχυσαρκια για άνδρες > 22.8 % , για γυναίκες > 33.9 %) </p><br>
				<p><strong>IBW (Ideal Body Weight).Ιδανικό Βάρος:</strong> <?php echo number_format($ibw, 2); ?> kg</p><br>
				<p><strong>ABW (Adjasted Body Weight).Προσαρμοσμένο Βάρος:</strong> <?php echo number_format($abw, 2); ?> kg</p><br>
				<p><strong>Endotracheal Tube Deapth (ETD):</strong> <?php echo number_format($etd, 0); ?> cm</p><br>
				<p><strong>MAP - Mean Arterial Pressure. Μέση Αρτ. Πίεση:</strong> <?php echo number_format($MAP, 0); ?> mmHg</p><br>
				<p><strong>CO-Cardiac Output. Καρδιακή παροχή:</strong> <?php echo number_format($CO, 2); ?> L/min</p><br>
				<p><strong>CI-Cardiac Index. Καρδιακός δείκτης:</strong> <?php echo number_format($CI, 2); ?> L/min*m2</p><br>
				<p><strong>Strock Volume. Όγκος παλμού:</strong> <?php echo number_format($SV, 0); ?> ml</p><br>
				<p><strong>Tidal Volume. Όγκος στον αναπνευστήρα:</strong> <?php echo number_format($tv, 0); ?> ml</p><br>
				<p><strong>Όγκος υγρών ημερησίως:</strong> <?php echo number_format($iwater, 0); ?> ml</p><br>
				<p><strong>6 min Walk Distance expected:</strong> <?php echo number_format($_6MWD, 0); ?> m</p><br>
				<p><strong>6 min Walk Distance minimum:</strong> <?php echo number_format($_minWD, 0); ?> m</p><br>
				<p><strong>% αναμενόμενου 6MWD:</strong> <?php echo number_format($expect, 1); ?> %</p><br>
				
				
				
			<?php endif; ?>
		<button style="background-color: rgb(162,235,182) ;"><a href="calculation.php">
					  Υπολογισμοί
					</a></button><br><br>
			</div>
			</div> 
		  </div>
	</div> 
	</section>
	</div>
  
  <?php include('down.php'); ?>				
					