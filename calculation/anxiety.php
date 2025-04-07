<?php include('../up.php'); ?>

<head>
	<title>Anxiety</title>
	
</head>

<div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 ">
          <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/anxiety1.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/anxiety2.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/anxiety3.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/anxiety4.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/anxiety5.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/anxiety6.jpeg" alt="">
          </div><br>
        </div>
		<div class="col-md-10 ">
		<form name="depress" action="<?php echo BASE_URL; ?>calculation/anxiety_score.php" style="display: flex;  align-items: center; margin-bottom: 20px;" method="POST" onsubmit="return FormValidate()">
                <label>
                    <h2 style="font-weight: bold;">Ερωτηματολόγιο για την ψυχική υγεία - Εκτίμηση άγχους</h2>
                </label>
				<h3 style="color: red">Απαντήστε σε όλες τις ερωτήσεις για το πώς νιώθατε τις τελευταίες 14 μέρες</h3><br>
				
				
                <div style="display: flex; flex-direction: column; align-items: center; gap: 15px;">
                    <div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er1">Νιώθετε νευρικότητα, άγχος ή αγανάκτηση</label><br>
                        <select name="er1" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι καθόλου</option>
                            <option value="1">Αρκετές μέρες</option>
                            <option value="2">Περισσότερες από τις μισές μέρες</option>
                            <option value="3">Σχεδόν κάθε μέρα</option>
                        </select>
                    </div>
                    <div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er2">Δεν μπορείτε να σταματήσετε ή να ελέγξετε την ανησυχία σας;</label><br>
                        <select name="er2" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι καθόλου</option>
                            <option value="1">Αρκετές μέρες</option>
                            <option value="2">Περισσότερες από τις μισές μέρες</option>
                            <option value="3">Σχεδόν κάθε μέρα</option>
                        </select>
                    </div>
                    <div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er3">Ανησυχείτε πάρα πολύ για διαφορετικά πράγματα;</label><br>
                        <select name="er3" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι καθόλου</option>
                            <option value="1">Αρκετές μέρες</option>
                            <option value="2">Περισσότερες από τις μισές μέρες</option>
                            <option value="3">Σχεδόν κάθε μέρα</option>
                        </select>
                    </div>
					
					
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er4">Έχετε δυσκολία χαλάρωσης;</label><br>
                        <select name="er4" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι καθόλου</option>
                            <option value="1">Αρκετές μέρες</option>
                            <option value="2">Περισσότερες από τις μισές μέρες</option>
                            <option value="3">Σχεδόν κάθε μέρα</option>
                        </select>
                    </div>
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er5">Είσαι τόσο ανήσυχος που είναι δύσκολο να καθίσεις ακίνητος;</label><br>
                        <select name="er5" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι καθόλου</option>
                            <option value="1">Αρκετές μέρες</option>
                            <option value="2">Περισσότερες από τις μισές μέρες</option>
                            <option value="3">Σχεδόν κάθε μέρα</option>
                        </select>
                    </div>
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er6">Γίνεστε εύκολα ενοχλημένοι ή ευερέθιστοι;</label><br>
                        <select name="er6" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι καθόλου</option>
                            <option value="1">Αρκετές μέρες</option>
                            <option value="2">Περισσότερες από τις μισές μέρες</option>
                            <option value="3">Σχεδόν κάθε μέρα</option>
                        </select>
                    </div>
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er7">Έχετε αίσθημα φόβου οτι θα συμβεί κάτι απαίσιο;</label><br>
                        <select name="er7" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι καθόλου</option>
                            <option value="1">Αρκετές μέρες</option>
                            <option value="2">Περισσότερες από τις μισές μέρες</option>
                            <option value="3">Σχεδόν κάθε μέρα</option>
                        </select>
                    </div>
					
                </div>
				
				
                <br>
                <div style="display: flex; gap: 20px; flex-direction: row;">
				<input type="submit" name="submit" value="Καταχώρηση" style="background-color: rgb(162,235,182) ;"><br>
				<button style="background-color: rgb(162,235,182) ;"><a href="<?php echo BASE_URL; ?>calculation.php">Πίσω</a></button><br><br>
				</div>
				</div>
				</form>
				</div>
					
					
					
	
               
            
        
	</div>
	</div>
	</section> 


<script>
         function FormValidate() {
            const selects = document.querySelectorAll('select');
            for (let select of selects) {
                if (select.value === "") {
                    alert("Παρακαλώ απαντήστε σε όλες τις ερωτήσεις.");
                    return false;
                }
            }
            return true;
        }
 </script>
<?php include('../down.php'); ?>
