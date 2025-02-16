<?php include('up.php'); ?>
<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data ;
}

$katig=['Γαστροσκόπηση','Κολονοσκόπηση','Βρογχοσκόπηση','Test PAP - Κυτταρολογική','Βιοψία - Παθολογοανατομική','Εμβολιασμός','ΗΚΓφημα Holter Test κόπωσης','Σπειρομέτρηση Μελέτη ύπνου','Εγκεφαλογράφημα','Μυογράφημα','Άλλη εξέταση'];

if (isset($_POST['submit'])) {
    // Λήψη των δεδομένων από τη φόρμα
    $eidos = test_input($katig[$_POST['er1']]);
    $perigrafi = test_input($_POST['er2']);
	$leipes_id= $_SESSION['id_user'];
	
	
	$query = "INSERT INTO leipes_data (leipes_id,eidos, perigrafi) 
              VALUES ('$leipes_id','$eidos', '$perigrafi')";
	$query_run = mysqli_query($con, $query);}

?>

<head>
	<title>Άλλες εξετάσεις</title>
	
</head>

<div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 ">
          <div class="img-box">
            <img src="images/endo1.jpg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="images/endo2.jpg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="images/endo3.jpg" alt="">
          </div><br>
		  
        </div>
		<div class="col-md-10 ">
		
                    
                
		<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center; padding: 20px; border-radius: 10px;">
		<?php   
						if (!isset($_SESSION['email'])) {
							echo '<h2 style="color: red">Πρέπει να έχετε κάνει πρώτα εγγραφή για αυτήν την σελίδα </h2>';
						}  else  { ?>
		
		<h2 style="font-weight: bold; text-align: center;">Άλλες Εξετάσεις</h2>
    <form name="loipes" action="" method="POST"  style="display: flex; flex-direction: column; align-items: center; gap: 15px;">
        
        <div style="display: flex; flex-direction: column; align-items: center; gap: 10px; width: 100%; max-width: 500px;">
            <label for="er1" style="font-weight: bold;">Επιλογή εξέτασης:</label>
            <select name="er1" required style="width: 100%; padding: 8px; height: 200px; overflow: auto;" >
                <option value="" selected>Επιλέξτε...</option>
                <option value="0">Γαστροσκόπηση</option>  
                <option value="1">Κολονοσκόπηση</option>
                <option value="2">Βρογχοσκόπηση</option>
                <option value="3">Test PAP - Κυτταρολογική</option>
                <option value="4">Βιοψία - Παθολογοανατομική</option>
                <option value="5">Εμβολιασμός</option>               
                <option value="6">ΗΚΓφημα - Holter - Test κόπωσης</option>
                <option value="7">Σπειρομέτρηση - Μελέτη ύπνου</option>
                <option value="8">Εγκεφαλογράφημα</option>
				<option value="9">Μυογράφημα</option>
				<option value="9">Άλλη εξέταση</option>
            </select>
        </div>
        
        <label for="er2" required style="font-weight: bold;">Περιγραφή και Απαντήσεις εξέτασης</label>
        <textarea rows="8" cols="100" name="er2" style="width: 100%; max-width: 800px; padding: 8px;"></textarea>
        
        <div style="display: flex; gap: 10px; flex-wrap: wrap; justify-content: center;">
            <input type="submit" name="submit" value="Καταχώρηση" style="background-color: rgb(162,235,182); padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
            <button style="background-color: rgb(162,235,182); padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                <a href="calculation_istor.php" style="text-decoration: none; color: black;">Πίσω</a>
            </button>                                   
        </div>
    </form>
	<?php if (isset($_POST['submit'])):{ ?>
	<h4 style="color: red">Η εξέτασή σας αποθηκεύτηκε</h4>
	<h4 style="color: green">Μπορείτε να προσθέσετε και άλλη ή να επιστρεψετε</h4><?php } ?>
	<?php endif; ?>
</div>

			</form><?php } ?>
			</div>
			</div>
			</div>	
				
					
					
					
	
               
            
        </div>
    </div>
</section>


<?php include('down.php'); ?>

