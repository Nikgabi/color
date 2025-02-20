<?php include('up.php'); ?>
<?php
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data ;
}
	$email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
	$query1="SELECT * FROM kritiki_data WHERE mail='$email' && kritiki!='' ";
	$query1_run = mysqli_query($con,$query1);
	
$success_message = ""; // Αρχικοποίηση μεταβλητής για το μήνυμα

if (isset($_POST['submit'])) {
    $kritiki = test_input($_POST['er2']);
    $kritiki_id = $_SESSION['id_user'];
    $mail = $_SESSION['email'];

    if (empty($kritiki)) {
        echo "<script>alert('Το πεδίο κριτικής δεν μπορεί να είναι κενό!');</script>";
    } else {
        $query = "INSERT INTO kritiki_data (kritiki_id, mail, kritiki) 
                  VALUES ('$kritiki_id', '$mail', '$kritiki')";
        $query_run = mysqli_query($con, $query);

        if ($query_run) {
            $success_message = "Ευχαριστούμε για την κριτική σας!";
        } else {
            echo "<script>alert('Πρόβλημα κατά την καταχώρηση!');</script>";
        }
    }
}




?>

<head>
	<title>Κριτικές</title>
	
</head>

<div id = container class="layout_padding-bottom">
  
  <section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 ">
		<br>
          <div class="img-box">
            <img src="images/testimonials.jpg" alt="">
          </div><br>
		  <div class="img-box">
            <img src="images/testimonials1.jpg" alt="">
          </div><br>
		  
        </div>
		<div class="col-md-10 ">
		
                    
        <br><br>        
		<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center; padding: 20px; border-radius: 10px;">
		<h2 style="font-weight: bold; text-align: center;">Η Γνώμη σας μετράει</h2>
		<?php   
		if (!isset($_SESSION['email'])) {
			echo '<h2 style="color: red">Πρέπει να έχετε κάνει πρώτα εγγραφή για την κριτική σας </h2>';
		} else if (isset($_SESSION['email']) && mysqli_num_rows($query1_run)>0 ){ 
			echo '<h2 style="color: red">Έχετε κάνει την κριτική σας- Ευχαριστούμε </h2>';
			echo '<button style="background-color: rgb(162,235,182); padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                <a href="index.php" style="text-decoration: none; color: black;">Home</a>
            </button><br><br>';	
			echo '<button style="background-color: rgb(162,235,182); padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                <a href="kritikes.php" style="text-decoration: none; color: black;">Δείτε τις κριτικές</a>
            </button>';
		}
		
		else {
			echo '<form name="gnomat" action="" method="POST"  style="display: flex; flex-direction: column; align-items: center; gap: 15px;">
        <label for="er2" required style="font-weight: bold;">Κάνετε την κριτική σας και δώστε μας συμβουλές</label>
        <textarea rows="8" cols="100" name="er2" placeholder="Γράψε την κριτική σου και συμβουλές βελτίωσης  μέχρι 500 χαρακτήρες." style="width: 100%; max-width: 800px; padding: 8px;"></textarea>
         
        <div style="display: flex; gap: 10px; flex-wrap: wrap; justify-content: center;">
            <input type="submit" name="submit" value="Καταχώρηση" style="background-color: rgb(162,235,182); padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
            <button style="background-color: rgb(162,235,182); padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                <a href="index.php" style="text-decoration: none; color: black;">Home</a>
            </button>                                   
        </div>
    </form>'; ?>
	<?php if (!empty($success_message)) : ?>
    <p><?php echo $success_message; ?></p>
	<?php endif; ?>
		
	<?php	} 
		?>
</div>

			</form>
			</div>
			</div>
			</div>	     
            
        </div>
    </div>
</section>


<?php include('down.php'); ?>

