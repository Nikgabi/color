<?php include('up.php'); ?>

<head>
	<title>Εξετάσεις και αποτελέσματα</title>
	
	
</head>

<div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 ">
          <div class="img-box">
            <img src="images/depres4.jpeg" alt="">
          </div><br>
		  
        </div>
		<div class="col-md-10 ">
		
                    
               
		<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center; padding: 20px; border-radius: 10px;">
		<h2 style="font-weight: bold; text-align: center;">Λοιπές Εξετάσεις</h2>
    <form name="depress" action="depression_result.php" method="POST" style="display: flex; flex-direction: row; align-items: center; gap: 15px;">
        
   
    
<div class="form-group">
    <label for="er1">Επιλογή εξέτασης:</label>
    <select id="er1" name="er1" required class="form-control" size="8" style="overflow-y: auto;">
        <option value="0">Ακτινογραφία Θώρακα</option>
        <option value="1">Γενική Ούρων</option>
        <option value="2">Καλλιέργεια ούρων</option>
        <option value="3">Ακτινογραφία άλλη</option>
        <option value="4">ΗΚΓράφημα</option>
        <option value="5">PAP Test</option>
        <option value="6">Μαστογραφία</option>
        <option value="7">Υπερηχογράφημα</option>
        <option value="8">Αξονική CT</option>
        <option value="9">Μαγνητική</option>
        <option value="10">Triplex</option>
        <option value="11">Test κοπώσεως</option>
        <option value="12">Holter ρυθμού</option>
        <option value="13">Γαστροσκόπηση</option>
        <option value="14">Κολονοσκόπηση</option>
        <option value="15">Ορθοσκόπηση</option>
        <option value="16">Βρογχοσκόπηση</option>
        <option value="17">Σπειρομέτρηση</option>
        <option value="18">Οστική πυκνότητα</option>
        <option value="19">Σπινθηρογράφημα</option>
        <option value="20">PET Scan</option>
        <option value="21">Βυθοσκόπηση</option>
        <option value="22">Οπτικά πεδία</option>
        <option value="23">Ακουόγραμμα</option>
        <option value="24">Εγκεφαλογράφημα</option>
        <option value="25">Οστεομυελική βιοψία</option>
        <option value="26">Βιοψία</option>
        <option value="27">Σπερμοδιάγραμμα</option>
    </select>
</div>
      
        <label for="er2" style="font-weight: bold;">Περιγραφή και Απαντήσεις εξέτασης</label>
        <textarea rows="15" cols="70" name="er2" style="width: 100%; max-width: 500px; padding: 8px;"></textarea>
       
        <div style="display: flex; gap: 10px; flex-wrap: wrap; justify-content: center;">
            <input type="submit" name="submit" value="Καταχώρηση" style="background-color: rgb(162,235,182); padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
            <button style="background-color: rgb(162,235,182); padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                <a href="calculation.php" style="text-decoration: none; color: black;">Πίσω</a>
            </button>
        </div>
    </form>
</div>

			</form>
			</div>
			</div>
			</div>	     
        </div>
    </div>
</section>



<?php include('down.php'); ?>

