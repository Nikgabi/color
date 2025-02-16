<?php include('up.php'); ?>
<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data ;
}

$success_message = ""; // Αρχικοποίηση μεταβλητής για το μήνυμα

if (isset($_POST['submit'])) {
    // Λήψη των δεδομένων από τη φόρμα
    $eidos = test_input($_POST['er1']);
    $perigrafi = test_input($_POST['er2']);
	$gnomat_id= $_SESSION['id_user'];
	
	if (empty($eidos)|| empty($perigrafi)) {
        echo "<script>alert('Το πεδίο Ειδικός ή Γνωμάτευση δεν μπορεί να είναι κενό!');</script>";
    } else {
	$query = "INSERT INTO gnomat_data (gnomat_id,eidos, perigrafi) 
              VALUES ('$gnomat_id','$eidos', '$perigrafi')";
	$query_run = mysqli_query($con, $query);
	if ($query_run) {
            $success_message = "Η γνωμάτευση αποθηκεύτηκε";
        } else {
            echo "<script>alert('Πρόβλημα κατά την καταχώρηση!');</script>";
        }
	
	}
	}

?>

<head>
	<title>Γνωματεύσεις</title>
	
</head>

<div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 ">
          <div class="img-box">
            <img src="images/100.jpg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="images/101.jpg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="images/102.jpg" alt="">
          </div><br>
		  
        </div>
		<div class="col-md-10 ">
		
                    
                
		<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center; padding: 20px; border-radius: 10px;">
		<h2 style="font-weight: bold; text-align: center;">Γνωματεύσεις από ειδικούς γιατρούς</h2>
    <form name="gnomat" action="" method="POST"  style="display: flex; flex-direction: column; align-items: center; gap: 15px;">
        
        <div style="display: flex; flex-direction: column; align-items: center; gap: 10px; width: 100%; max-width: 500px;">
            <label for="er1" style="font-weight: bold;">Ειδικός:</label>
            <input type="text" name="er1" placeholder="Ειδικός πχ Ογκολόγος">
			</div>
        
        <label for="er2" required style="font-weight: bold;">Γνωμάτευση</label>
        <textarea rows="8" cols="100" name="er2" style="width: 100%; max-width: 800px; padding: 8px;"></textarea>
        
        <div style="display: flex; gap: 10px; flex-wrap: wrap; justify-content: center;">
            <input type="submit" name="submit" value="Καταχώρηση" style="background-color: rgb(162,235,182); padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
            <button style="background-color: rgb(162,235,182); padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                <a href="calculation_istor.php" style="text-decoration: none; color: black;">Πίσω</a>
            </button>                                   
        </div>
    </form>
	<?php if (!empty($success_message)) : ?>
    <p><?php echo $success_message; ?></p>
	<?php endif; ?>
</div>

			</form>
			</div>
			</div>
			</div>	
				
					
					
					
	
               
            
        </div>
    </div>
</section>


<?php include('down.php'); ?>

