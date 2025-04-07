<?php include('../up.php'); ?>

<head>
	<title>Σωματομετρικοί υπολογισμοί</title>
</head>

  
  <div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 ">
          <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/106.jpg" alt="">
          </div>
        </div>
		<div class="col-md-10 ">
		<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">
		<form action="<?php echo BASE_URL; ?>calculation/result_somatom.php" method="POST">	
		  <div style="display: flex; gap: 2px; flex-direction: column;">
			<h2 style="align-items: center;">Συμπλήρωσε τα στοιχεία σου</h2>
			<p>Όπου υπάρχει * είναι υποχρεωτικό να το συμπληρώσεις</p>
			<p>Στο SvO2 βάλε τιμή 75 εάν δεν ξέρεις.</p>
			<p>Tα 6 λεπτά περπάτημα μπορείς να τα υπολογίσεις με το google map</p>
			</div><br>
			
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<label for="height">Ύψος (cm)*:</label>
				<input type="text" name="height" size="5" required>
			
				<label for="weight">Βάρος (kg)*:</label>
				<input type="text" name="weight" size="5" required>
				<label for="age">Ηλικία*:</label>
				<input type="text" name="age" size="5" required>
			</div><br>
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<label for="sbp">Συστολική πίεση (mmHg)*:</label>
				<input type="text" name="sbp" size="5" required>
			
				<label for="dbp">Διαστολική πίεση (mmHg)*:</label>
				<input type="text" name="dbp" size="5" required>
				<label for="HR">Σφυγμοί (/min)*:</label>
				<input type="text" name="HR" size="5" required>
			</div><br>
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<label for="waist">Περίμετρος μέσης (cm)*:</label>
				<input type="text" name="waist" size="5" required>
				<label for="apost">Απόσταση που περπατάς σε 6 λεπτά με κανονικό βήμα(m)*:</label>
				<input type="text" name="apost" size="5" required>
				
			</div><br>
			
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<label for="Hb">Αιμοσφαιρίνη(gr/dl)*:</label>
				<input type="text" name="Hb" size="5" required>
			
				<label for="SaO2">Κορεσμός SaO2 (%)*:</label>
				<input type="text" name="SaO2" size="5" required>
				<label for="SvO2">Κορεσμός SvO2 φλεβικό(%):</label>
				<input type="text" name="SvO2" size="5" >
				
			</div><br>
			<div style="display: flex; gap: 20px; flex-direction: row;">
			
			<label for="gender">Φύλο*:</label>
				<select name="gender" required>
					<option value="male">Άνδρας</option>
					<option value="female">Γυναίκα</option>
				</select>
			</div><br>
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<input type="submit" name="submit" value="Υπολογισμός" style="background-color: rgb(162,235,182) ;"><br>
			
			<button style="background-color: rgb(162,235,182) ;"><a href="<?php echo BASE_URL; ?>calculation.php">
					  Πίσω
					</a></button><br>
			</div><br>	
			</form>	
		  
			</div>
			</div>
			</div> 
		  </div>
	 
	</section>
	</div>
  
  <?php include('../down.php'); ?>