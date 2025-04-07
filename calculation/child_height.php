<?php include('../up.php'); ?>
<?php
$child_height=$gender=$moth_h=$fath_h= null ;

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['submit'])) {
    // Λήψη των δεδομένων από τη φόρμα
    $gender = test_input($_POST['er1']);
    $moth_h = test_input($_POST['moth_h']);
    $fath_h = test_input($_POST['fath_h']);
    
	//Υπολογισμός
	
	if ($gender=="female"){
		$child_height= (($fath_h-13)+$moth_h)/2 ;
	}else {
		$child_height=($moth_h+13+$fath_h)/2 ;
		}
	}

?>
<head>
	<title>Strock</title>
	
</head>

<div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-3 ">
          
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/child_h.jpg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="<?php echo BASE_URL; ?>images/child_h1.jpg" alt="">
          </div><br>
		  
        </div>
		<div class="col-md-9 ">
		<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;"><br>
		<form name="child_heigh" action="" style="display: flex;  align-items: center; margin-bottom: 20px;" method="POST" ">
                <label>
                    <h2 style="font-weight: bold;">Υπολογισμός τελικου ύψους παιδιού </h2>
                </label>
				<h3 style="color: red">Απαντήστε σε όλες τις ερωτήσεις</h3>
				
				<div style="display: flex; flex-direction: row; align-items: center; gap: 15px;">
				
				<div style="width: 100%; max-width: 900px; text-align: center;">
                        <label for="er1">Φύλο του παιδιού  </label><br>
                        <select name="er1" required style="width: 100%; padding: 8px;">
                            <option value="" >Επιλέξτε...</option>
                            <option value="female">Κορίτσι</option>
                            <option value="male">Αγόρι</option>
                            
                        </select>
                    </div>
					</div><br>
                <div style="display: flex; flex-direction: column ; align-items: center; gap: 15px;">
                    <div style="width: 100%; max-width: 900px; text-align: center;">
                        <label for="moth_h">Ύψος μητέρας (cm) </label>
						<input  type="text" name="moth_h"  size="5"><br><br>
                        
                    </div>
                    
					<div style="width: 100%; max-width: 900px; text-align: center;">
                        <label for="fath_h">Ύψος πατέρα (cm) </label>
						<input  type="text" name="fath_h"  size="5"><br><br>
                        
                    </div>
					
					
                </div>
				
				
                <br>
                <div style="display: flex; gap: 20px; flex-direction: row;">
				<input type="submit" name="submit" value="Υπολογισμός" style="background-color: rgb(162,235,182) ;"><br>
				<button style="background-color: rgb(162,235,182) ;"><a href="<?php echo BASE_URL; ?>calculation.php">Πίσω</a></button><br><br>
				</div><br>
				<?php if (isset($_POST['submit'])): ?>
				<div style="display: flex; flex-direction: row ; align-items: center; gap: 15px;">
				<p><strong>Τελικό ύψος παιδιού:</strong> <?php echo number_format($child_height, 1); ?> cm </p><br>
				</div><br>
				<?php endif; ?>
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