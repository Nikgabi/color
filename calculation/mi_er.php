<?php include('../up.php'); ?>

<head>
	<title>Strock</title>
	
</head>

<div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 ">
          <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/mi_1.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/mi_2.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/mi_3.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/mi_4.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/mi_5.jpeg" alt="">
          </div><br>
		  
        </div>
		<div class="col-md-10 ">
		<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">
		<form name="strock" action="<?php echo BASE_URL; ?>calculation/cardiov.php" style="display: flex;  align-items: center; margin-bottom: 20px;" method="POST" onsubmit="return FormValidate()">
                <label>
                    <h2 style="font-weight: bold;">Ερωτηματολόγιο για Εκτίμηση κινδύνου καρδιακού επεισοδίου</h2>
                </label>
				<h3 style="color: red">Απαντήστε σε όλες τις ερωτήσεις</h3><br>
				
				
                <div style="display: flex; flex-direction: column; align-items: center; gap: 15px;">
                    <div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="age">Ηλικία</label>
						<input  type="text" name="age"  size="5"><br><br>
                        
                    </div>
                    
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="tot_chol">Ολική Χοληστερόλη σε mg/dl</label>
						<input  type="text" name="tot_chol"  size="5"><br><br>
                        
                    </div>
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="hdl_chol">HDL Χοληστερόλη σε mg/dl</label>
						<input  type="text" name="hdl_chol"  size="5"><br><br>
                        
                    </div>
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="sbp">Η συστολική σας πίεση σε mmHg</label>
						<input  type="text" name="sbp"  size="5"><br><br>
                        
                    </div>
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er3">Φύλο  </label><br>
                        <select name="er3" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="female">Γυναίκα</option>
                            <option value="male">Άνδρας</option>
                            
                        </select>
                    </div>
                    <div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er1">Κάνετε θεραπεία για υπέρταση;  </label><br>
                        <select name="er1" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι</option>
                            <option value="1">Ναί</option>
           
                        </select>
                    </div>
					
					
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er2">Καπνίζετε;  </label><br>
                        <select name="er2" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι</option>
                            <option value="1">Ναί</option>
                            
                        </select>
                    </div>
					
					
                </div>
				
				
                <br>
                <div style="display: flex; gap: 20px; flex-direction: row;">
				<input type="submit" name="submit" value="Καταχώρηση" style="background-color: rgb(162,235,182) ;"><br>
				<button style="background-color: rgb(162,235,182) ;"><a href="<?php echo BASE_URL; ?>calculation.php">Πίσω</a></button><br><br>
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