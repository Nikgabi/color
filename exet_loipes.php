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
            <img src="images/aktino1.jpg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="images/aktino2.jpg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="images/aktino3.jpg" alt="">
          </div><br>
		  
        </div>
		<div class="col-md-10 ">
		
                    
                
		<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center; padding: 20px; border-radius: 10px;">
		<h2 style="font-weight: bold; text-align: center;">Απεικονιστικές Εξετάσεις</h2>
    <form name="depress" action="depression_result.php" method="POST"  style="display: flex; flex-direction: column; align-items: center; gap: 15px;">
        
        <div style="display: flex; flex-direction: column; align-items: center; gap: 10px; width: 100%; max-width: 500px;">
            <label for="er1" style="font-weight: bold;">Επιλογή εξέτασης:</label>
            <select name="er1" required style="width: 100%; padding: 8px; height: 200px; overflow: auto;" >
                <option value="" selected>Επιλέξτε...</option>
                <option value="0">Ακτινογραφία</option>  
                <option value="1">Μαστογραφία</option>
                <option value="2">Υπερηχογράφημα</option>
                <option value="3">Αξονική CT</option>
                <option value="4">Μαγνητική</option>
                <option value="5">Triplex</option>               
                <option value="6">Οστική πυκνότητα</option>
                <option value="7">Σπινθηρογράφημα</option>
                <option value="8">PET Scan</option>
				<option value="9">Αγγειογραφία</option>
            </select>
        </div>
        
        <label for="er2" style="font-weight: bold;">Περιγραφή και Απαντήσεις εξέτασης</label>
        <textarea rows="8" cols="100" name="er2" style="width: 100%; max-width: 800px; padding: 8px;"></textarea>
        
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

