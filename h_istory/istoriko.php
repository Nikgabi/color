<?php include('../up.php'); 
// Αρχικοποίηση μεταβλητών για τα αποτελέσματα
$pathiseis = $farmaka = $xeirourg = $gynaikolo = $ypertasi = $diaviti = $stefani = $pcixiki = $anapneu = $nefriki = $smoking = $drink = $kataxr = null;
$id_istor = $_SESSION['id_user'];
$message = ""; // Για αποθήκευση του μηνύματος επιτυχίας ή σφάλματος
if (isset($_POST['submit'])) {
	
    // Λήψη των δεδομένων από τη φόρμα
    $pathiseis = mysqli_real_escape_string($con ,$_POST['pathiseis']);
    $farmaka = mysqli_real_escape_string($con ,$_POST['farmaka']);
    $xeirourg = mysqli_real_escape_string($con ,$_POST['xeirourg']);
    $gynaikolo = mysqli_real_escape_string($con ,$_POST['gynaikolo']);
    
    $ypertasi = isset($_POST['ypertasi']) ? 1 : 0;
    $diaviti = isset($_POST['diaviti']) ? 1 : 0;
    $stefani = isset($_POST['stefani']) ? 1 : 0;
    $pcixiki = isset($_POST['pcixiki']) ? 1 : 0;
    $anapneu = isset($_POST['anapneu']) ? 1 : 0;
    $nefriki = isset($_POST['nefriki']) ? 1 : 0;

    $smoking = mysqli_real_escape_string($con ,$_POST['smoking']);
    $drink = mysqli_real_escape_string($con ,$_POST['drink']);
    $kataxr = mysqli_real_escape_string($con ,$_POST['kataxr']);

    $sql = "INSERT INTO medical_history (
               id_istor, pathiseis, farmaka, xeirourg, gynaikolo,
                ypertasi, diaviti, stefani, pcixiki,
                anapneu, nefriki, smoking, drink, kataxr
            ) VALUES (
                '$id_istor','$pathiseis', '$farmaka', '$xeirourg', '$gynaikolo',
                $ypertasi, $diaviti, $stefani, $pcixiki,
                $anapneu, $nefriki, '$smoking', '$drink', '$kataxr'
            )";
	$query_run = mysqli_query($con, $sql);
	
	if ($query_run) {
        $message = "<p style='color:green;'>Τα στοιχεία σας καταχωρήθηκαν επιτυχώς!</p>";
    } else {
        $error_message = mysqli_error($con);
        $message = "<p style='color:red;'>Σφάλμα κατά την καταχώρηση: $error_message</p>";
    }	
	}
?>

<head>
	<title>Ιστορικό επισκέπτη</title>
</head>

  
  <div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-3 ">
          <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/contact-img.jpg" alt="">
          </div>
        </div>
		<div class="col-md-9 ">
		<form action="" style="display: flex;  align-items: center; margin-bottom: 20px;" method="POST">
			<h2>Συμπλήρωσε τo ιστορικό σου</h2>
			<label for="pathiseis">Ανέφερε τις σημαντικές Χρόνιες παθήσεις σου:</label>
			<input name="pathiseis" size="100" >
			
			<label for="farmaka">Φάρμακα που παίρνεις για αυτές:</label>
			<input name="farmaka" size="100" >
			
			<label for="xeirourg">Χειρουργικές επεμβάσεις που έχεις κάνει:</label>
			<input name="xeirourg" size="100" >
			
			<label for="gynaikolo">Γυναικολογικό ιστορικό και επεμβάσεις (Αριθμ. Παιδιών, Καισαρικές, Χειρουργεία):</label>
			<input name="gynaikolo" size="100" >
			<div style="display: flex; gap: 20px; flex-direction: row;">	
			<label><input type="checkbox" name="ypertasi" value="Υπέρταση"> Υπέρταση</label>
			<label><input type="checkbox" name="diaviti" value="Διαβήτης"> Διαβήτης</label>
			<label><input type="checkbox" name="stefani" value="Στεφανιαία"> Στεφανιαία</label>
			<label><input type="checkbox" name="pcixiki" value="Ψυχική"> Ψυχική νόσος</label>
			<label><input type="checkbox" name="anapneu" value="ΧΑΠ"> ΧΑΠ</label>
			<label><input type="checkbox" name="nefriki" value="Νεφρ. Ανεπ">Νεφρική Αν.</label>
			</div>

			<div style="display: flex; gap: 20px; flex-direction: row;">
				<div style="display: flex; gap: 20px; flex-direction: row;">
					<label for="smoking">Κάπνισμα:</label>
					<select name="smoking" required>
						<option value="Ποτέ">Ποτέ</option>
						<option value="Περιστασιακά">Περιστασιακά</option>
						<option value="Μέχρι 5 τσιγάρα την ημέρα">Μέχρι 5 τσιγάρα την ημέρα</option>
						<option value="1 πακέτο την ημέρα">1 πακέτο την ημέρα</option>
						<option value="Πάνω από 1 πακέτο την ημέρα">Πάνω από 1 πακέτο την ημέρα</option>
						<option value="Παλαιότερος καπνιστής.Το έχω διακόψει.">Παλαιότερος καπνιστής. Το έχω διακόψει.</option>
					</select>
				</div>

				<div style="display: flex; gap: 20px; flex-direction: row;">
					<label for="drink">Αλκοόλ:</label>
					<select name="drink" required>
						<option value="Ποτέ">Ποτέ</option>
						<option value="Περιστασιακά">Περιστασιακά</option>
						<option value="1 ποτό την ημέρα">1 ποτό την ημέρα</option>
						<option value="2-3 ποτά την ημέρα">2-3 ποτά την ημέρα</option>
						<option value="Πάνω από 3 ποτά την ημέρα">Πάνω από 3 ποτά την ημέρα</option>
						<option value="Έχω κάνει απεξάρτηση.">Έχω κάνει απεξάρτηση.</option>
					</select>
				</div>
				
				<div style="display: flex; gap: 20px; flex-direction: row;">
					<label for="kataxr">Drugs (ναρκωτικά κ.α):</label>
					<select name="kataxr" required>
						<option value="Ποτέ">Ποτέ</option>
						<option value="Περιστασιακά">Περιστασιακά</option>
						<option value="Χρήστης ήπιων">Χρήστης ήπιων</option>
						<option value="Χρήστης σκληρών">Χρήστης σκληρών</option>
						<option value="Έχω κάνει απεξάρτηση.">Έχω κάνει απεξάρτηση.</option>
					</select>
				</div>
			</div><br>
		
		
		<div style="display: flex; gap: 20px; flex-direction: row;">
        <input type="submit" name="submit" value="Καταχώρηση" style="background-color: rgb(162,235,182) ;"><br>
		<button style="background-color: rgb(162,235,182) ;"><a href="<?php echo BASE_URL; ?>menu/calculation_istor.php">Πίσω</a></button><br>
		
		
		</div>
		</form>	
		<?php if (!empty($message)) { echo $message; } ?>
		</div>
	</div>
	</div> 
	</section>
	</div>
  
  <?php include('../down.php'); ?>