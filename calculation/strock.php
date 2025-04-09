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
            <img src="<?php echo BASE_URL; ?>images/strock1.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/strock2.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/strock3.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/strock4.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/strock5.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/strock6.jpeg" alt="">
          </div><br>
        </div>
		<div class="col-md-10 ">
		<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">
		<form name="strock" action="<?php echo BASE_URL; ?>calculation/strock_scor.php" style="display: flex;  align-items: center; margin-bottom: 20px;" method="POST" onsubmit="return FormValidate()">
                <label>
                    <h2 style="font-weight: bold;">Ερωτηματολόγιο για Εκτίμηση κινδύνου εγκεφαλικού επεισοδίου σε ασθενείς με κολπική μαρμαρυγή</h2>
                </label>
				<h3 style="color: red">Απαντήστε σε όλες τις ερωτήσεις</h3><br>
				
				
                <div style="display: flex; flex-direction: column; align-items: center; gap: 15px;">
                    <div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er1">Ηλικία</label><br>
                        <select name="er1" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">λιγότερο από 65 ετών</option>
                            <option value="1">65 έως 74 ετών</option>
                            <option value="2">Πάνω από 75 ετών</option>
                           
                        </select>
                    </div>
                    <div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er2">Φύλο</label><br>
                        <select name="er2" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="1">Γυναίκα</option>
                            <option value="0">Άνδρας</option>
                            
                        </select>
                    </div>
                    <div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er3">Έχετε ιστορικό συμφορητικής καρδιακής ανεπάρκειας;</label><br>
                        <select name="er3" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι</option>
                            <option value="1">Ναί</option>
           
                        </select>
                    </div>
					
					
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er4">Υπέρταση;</label><br>
                        <select name="er4" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι</option>
                            <option value="1">Ναί</option>
                            
                        </select>
                    </div>
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er5">Ιστορικο εγκεφαλικού ή παροδικού εγκεφαλικού ή θρομβοεμβολικού επεισοδίου;</label><br>
                        <select name="er5" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι</option>
                            <option value="2">Ναί</option>
                            
                        </select>
                    </div>
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er6">Έχετε νόσο των αγγείων; (δηλ προηγούμενο έμφραγμα ή περιφερική αρτηριοπάθεια ή αορτική πλάκα)</label><br>
                        <select name="er6" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι</option>
                            <option value="1">Ναί</option>
                            
                        </select>
                    </div>
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er7">Έχετε Σακχαρώδη διαβήτη;</label><br>
                        <select name="er7" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι</option>
                            <option value="1">Ναί</option>
                            
                        </select>
                    </div>
					
                </div>
				
				
                <br>
                <div style="display: flex; gap: 20px; flex-direction: row;">
				<input type="submit" name="submit" value="Καταχώρηση" style="background-color: rgb(162,235,182) ;"><br>
				<button style="background-color: rgb(162,235,182) ;"><a href="<?php echo BASE_URL; ?>menu/calculation.php">Πίσω</a></button><br><br>
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