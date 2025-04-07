<?php include('../up.php'); ?>

<head>
	<title>Deppression</title>
	
</head>

<div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 ">
          <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/depres4.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/depres5.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/depres1.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/depres2.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/depres3.jpeg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/depres6.jpeg" alt="">
          </div><br>
        </div>
		<div class="col-md-10 ">
		<form name="depress" action="<?php echo BASE_URL; ?>calculation/depression_result.php" style="display: flex;  align-items: center; margin-bottom: 20px;" method="POST" onsubmit="return FormValidate()">
                <label>
                    <h2 style="font-weight: bold;">Ερωτηματολόγιο για την ψυχική υγεία - Εκτίμηση κατάθλιψης</h2>
                </label>
				<h3 style="color: red">Απαντήστε πώς νιώθατε και πόσο συχνά τις τελευταίες 14 μέρες</h3><br>
				
                <div style="display: flex; flex-direction: column; align-items: center; gap: 15px;">
                    <div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er1">Έχεις μειωμένο ενδιαφέρον και ευχαρίστηση να κάνεις πράγματα;</label><br>
                        <select class="one" name="er1" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι καθόλου</option>
                            <option value="1">Αρκετές μέρες</option>
                            <option value="2">Περισσότερες από τις μισές μέρες</option>
                            <option value="3">Σχεδόν κάθε μέρα</option>
                        </select>
                    </div>
                    <div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er2">Νιώθετε πιεσμένος, με κατάθλιψη ή απελπισία;</label><br>
                        <select class="one" name="er2" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι καθόλου</option>
                            <option value="1">Αρκετές μέρες</option>
                            <option value="2">Περισσότερες από τις μισές μέρες</option>
                            <option value="3">Σχεδόν κάθε μέρα</option>
                        </select>
                    </div>
                    <div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er3">Δυσκολεύεστε να πάτε για ύπνο ή να κοιμηθείτε ή να κοιμηθείτε πολύ;</label><br>
                        <select class="one" name="er3" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι καθόλου</option>
                            <option value="1">Αρκετές μέρες</option>
                            <option value="2">Περισσότερες από τις μισές μέρες</option>
                            <option value="3">Σχεδόν κάθε μέρα</option>
                        </select>
                    </div>
					
					
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er4">Αισθάνεστε κουρασμένοι ή έχετε λίγη ενέργεια;</label><br>
                        <select class="one" name="er4" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι καθόλου</option>
                            <option value="1">Αρκετές μέρες</option>
                            <option value="2">Περισσότερες από τις μισές μέρες</option>
                            <option value="3">Σχεδόν κάθε μέρα</option>
                        </select>
                    </div>
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er5">Έχετε κακή όρεξη ή υπερφαγία;</label><br>
                        <select class="one" name="er5" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι καθόλου</option>
                            <option value="1">Αρκετές μέρες</option>
                            <option value="2">Περισσότερες από τις μισές μέρες</option>
                            <option value="3">Σχεδόν κάθε μέρα</option>
                        </select>
                    </div>
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er6">Αισθάνεστε άσχημα για τον εαυτό σας — ή ότι είστε αποτυχημένος ή έχετε απογοητεύσει τον εαυτό σας ή την οικογένειά σας;</label><br>
                        <select class="one" name="er6" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι καθόλου</option>
                            <option value="1">Αρκετές μέρες</option>
                            <option value="2">Περισσότερες από τις μισές μέρες</option>
                            <option value="3">Σχεδόν κάθε μέρα</option>
                        </select>
                    </div>
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er7">Δυσκολεύεστε να συγκεντρωθείτε σε πράγματα, όπως η ανάγνωση της εφημερίδας ή η παρακολούθηση τηλεόρασης;</label><br>
                        <select class="one" name="er7" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι καθόλου</option>
                            <option value="1">Αρκετές μέρες</option>
                            <option value="2">Περισσότερες από τις μισές μέρες</option>
                            <option value="3">Σχεδόν κάθε μέρα</option>
                        </select>
                    </div>
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er8">Κινείστε ή μιλάτε τόσο αργά που οι άλλοι άνθρωποι θα μπορούσαν να το προσέξουν; Είστε τόσο ταραγμένος ή ανήσυχος που κινείστε πολύ περισσότερο από το συνηθισμένο;</label><br>
                        <select class="one" name="er8" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι καθόλου</option>
                            <option value="1">Αρκετές μέρες</option>
                            <option value="2">Περισσότερες από τις μισές μέρες</option>
                            <option value="3">Σχεδόν κάθε μέρα</option>
                        </select>
                    </div>
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label for="er9">Έχετε σκέψεις ότι θα ήταν καλύτερα να πεθάνετε ή σκέψεις να πληγώσετε τον εαυτό σας με κάποιο τρόπο;</label><br>
                        <select class="one" name="er9" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="0">Όχι καθόλου</option>
                            <option value="1">Αρκετές μέρες</option>
                            <option value="2">Περισσότερες από τις μισές μέρες</option>
                            <option value="3">Σχεδόν κάθε μέρα</option>
                        </select>
                    </div>
					<div style="width: 100%; max-width: 900px; text-align: left;">
                        <label style="color: green">Ελέγξτε οτι έχετε απαντήσει όλες τις ερωτήσεις πρίν την αποστολή</label><br>
                        
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


<?php include('../down.php'); ?>

