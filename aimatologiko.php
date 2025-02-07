<?php include('up.php'); ?>

<head>
	<title>Αιματολογικές εξετάσεις</title>
</head>

  
  <div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-3 ">
          <div class="img-box">
            <img src="images/aima.jpg" alt="">
          </div>
        </div>
		<div class="col-md-9 ">
		<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">
		<form action="aima_results.php" method="POST">	
		  <div style="display: flex; gap: 20px; flex-direction:row;">
			<h2 style="align-items: center;">Συμπλήρωσε τις τιμές των εργαστηριακών σου εξετάσεων</h2>
			
			</div>
			<h3 style="align-items: center; color:green">(Βάζεις μόνο νούμερα και για δεκαδικά βάζεις 3.56 )</h3><br>
			
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<label for="Hb">Αιμοσφαιρίνη (gr/dl):</label>
				<input type="text" name="Hb" size="3" >
				<label for="Htc">Αιματοκρίτης (%):</label>
				<input type="text" name="Htc" size="3" >
				<label for="eryth">Ερυθρά (x10^6):</label>
				<input type="text" name="eryth" size="3" >			
			</div><br>
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<label for="leuk">Λευκά (x10^3):</label>
				<input type="text" name="leuk" size="5" >
				<label for="oudet">Ουδετ.(%):</label>
				<input type="text" name="oudet" size="3" >
				<label for="lemfo">Λεμφο(%):</label>
				<input type="text" name="lemfo" size="3" >				
			</div><br>
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<label for="mono">Μονο(%):</label>
				<input type="text" name="mono" size="3" >
				<label for="ios">Ηωσινόφ.(%):</label>
				<input type="text" name="ios" size="3" >
				<label for="bas">Βασεόφ.(%):</label>
				<input type="text" name="bas" size="3" >			
			</div><br>
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<label for="plt">Αιμοπετάλια (x10^3):</label>
				<input type="text" name="plt" size="5" >
				<label for="Fe">Σίδηρος:</label>
				<input type="text" name="Fe" size="3" >
				<label for="ferit">Φεριτίνη:</label>
				<input type="text" name="ferit" size="3" >
			</div><br>
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<label for="b12">B12:</label>
				<input type="text" name="b12" size="3" >
				<label for="filiko">Φυλλικό:</label>
				<input type="text" name="filiko" size="3" >
				
				<label for="pt">PT Χρ. Προθρομβίνης:</label>
				<input type="text" name="pt" size="3" >
				<label for="pt1">PT Μάρτυρα:</label>
				<input type="text" name="pt1" size="3" >
			</div><br>
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<label for="inr">INR:</label>
				<input type="text" name="inr" size="3" >
				<label for="ptt">PTT Χρ. θρομβοπλαστίνης:</label>
				<input type="text" name="ptt" size="3" >
				<label for="ino">Ινωδογόνο:</label>
				<input type="text" name="ino" size="3" >
				
			</div><br>
			
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<input type="submit" name="submit" value="Υπολογισμός" style="background-color: rgb(162,235,182) ;"><br>
			
			<button style="background-color: rgb(162,235,182) ;"><a href="calculation.php">
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
  
  <?php include('down.php'); ?>