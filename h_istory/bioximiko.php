<?php include('../up.php'); ?>

<head>
	<title>Βιοχημικές εξετάσεις</title>
</head>

  
  <div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-1 ">
          <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/t3.png" alt="">
          </div>
        </div>
		<div class="col-md-11 ">
		<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">
		<form action="<?php echo BASE_URL; ?>result_bioximiko.php" method="POST">	
		  <div style="display: flex; gap: 20px; flex-direction: row;">
			<h2 style="align-items: center;">Συμπλήρωσε τις τιμές των βιοχημικών σου εξετάσεων</h2>
			</div>
			<h3 style="align-items: center; color:green">(Βάζεις μόνο νούμερα και για δεκαδικά βάζεις 3.56 )</h3><br>
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<label for="glu">Γλυκόζη (mg/dl):</label>
				<input type="text" name="glu" size="5" >
				<label for="ouria">Ουρία (mg/dl):</label>
				<input type="text" name="ouria" size="5" >
				<label for="krea">Κρεατινίνη (mg/dl):</label>
				<input type="text" name="krea" size="5" >
				<label for="ouriko">Ουρικό οξύ (mg/dl):</label>
				<input type="text" name="ouriko" size="5" >
			</div><br>
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<label for="cholist">Χοληστερόλη(mg/dl):</label>
				<input type="text" name="cholist" size="3" >
				<label for="hdl">HDL Χολ.(mg/dl):</label>
				<input type="text" name="hdl" size="3" >
				<label for="trigl">Τριγλυκ (mg/dl):</label>
				<input type="text" name="trigl" size="3" >
				<label for="al_f">Αλκαλ. Φωσφατ:</label>
				<input type="text" name="al_f" size="3" >
			</div><br>
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<label for="sgot">SGOT:</label>
				<input type="text" name="sgot" size="3" >
				<label for="sgpt">SGPT:</label>
				<input type="text" name="sgpt" size="3" >
				<label for="ggt">γ-gt:</label>
				<input type="text" name="ggt" size="3" >
				<label for="choler">Χολερυθρίνη:</label>
				<input type="text" name="choler" size="3" >
				<label for="choler1">Άμεση χολερ.:</label>
				<input type="text" name="choler1" size="3" >
			</div><br>
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<label for="ka">Κάλιο:</label>
				<input type="text" name="ka" size="3" >
				<label for="na">Νάτριο:</label>
				<input type="text" name="na" size="3" >
				<label for="cl">Χλώριο:</label>
				<input type="text" name="cl" size="3" >
				<label for="ca">Ασβέστιο:</label>
				<input type="text" name="ca" size="3" >
				<label for="mgn">Μαγνήσιο:</label>
				<input type="text" name="mgn" size="3" >
			</div><br>
			
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<label for="leuk">Λευκώματα ολ.:</label>
				<input type="text" name="leuk" size="3" >
				<label for="alboum">Αλβουμίνη:</label>
				<input type="text" name="alboum" size="3" >
				<label for="glu_hb">Γλυκοζ Hb:</label>
				<input type="text" name="glu_hb" size="3" >
				<label for="amyl">Αμυλάση αιμ:</label>
				<input type="text" name="amyl" size="3" >
				<label for="amyl1">Αμυλάση ούρων:</label>
				<input type="text" name="amyl1" size="3" >
			</div><br>
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<label for="crp">CRP:</label>
				<input type="text" name="crp" size="3" >
				<label for="psa">PSA (προστατικό αντ):</label>
				<input type="text" name="psa" size="3" >
				<label for="cpk">CPK:</label>
				<input type="text" name="cpk" size="3" >
			</div><br>
			
			
			
			<div style="display: flex; gap: 20px; flex-direction: row;">
				<input type="submit" name="submit" value="Υπολογισμός" style="background-color: rgb(162,235,182) ;"><br>
			
			<button style="background-color: rgb(162,235,182) ;"><a href="<?php echo BASE_URL; ?>calculation_istor.php">
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