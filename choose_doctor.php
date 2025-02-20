<?php include('up.php'); ?>

<head>
	<title>Choose Doctor</title>
</head>
 
<div id = container class="layout_padding-bottom"><br>
<section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-2 ">
          <div class="img-box">
            <img src="images/105.jpg" alt="">
          </div>
        </div>
		<div class="col-md-10 ">
 

<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;"> <br>

<h4 style="color: red; font-weight: bold;">Επανέλθετε αργότερα για περισσότερες επιλογές γιατρού και ειδικότητας</h4>
<h5 style="color: green; font-weight: bold;">Η επιλογή ειδικότητας γιατρού δεν έχει σημασία καθόσον όλοι έχουν ρόλο γενικού γιατρού</h5>
<h5 style="color: green; font-weight: bold;">Επισκεφθείτε την σελίδα των γιατρών μας για να επιλέξετε</h5>
<?php
$user_id=$_SESSION['id_user'];
// Εκτέλεση του SQL query για την επιλογή των γιατρών
$query = "SELECT id_user, name, eidikotita FROM user WHERE role = 'Doctor'";
$result = mysqli_query($con, $query);

// Δημιουργία φόρμας με dropdown list (select)
echo '<form action="" method="POST">';
echo '<label for="consultant">Επιλέξτε γιατρό:</label>';
echo '<select name="consultant" id="consultant" required>';

// Εισαγωγή επιλογών στη λίστα
while ($row = mysqli_fetch_assoc($result)) {
    $doctor_id = $row['id_user'];
    $doctor_name = $row['name'];
    $specialty = $row['eidikotita'];
    echo "<option value='$doctor_id'>$doctor_name - $specialty</option>";
}

echo '</select>';
echo '<br>';
echo '<div class="checkbox-container">
	<input  type="checkbox" name="sygkat1" value="yes">
	<label for="sygkat1"> Συμφωνώ και συγκατατίθεμαι να έχει πρόσβαση ο γιατρός στο ιστορικό και τις εξετάσεις μου</label>
    </div>';
echo '<input type="submit" name="Submit2" value="Submit" style="background-color: rgb(162,235,182);"><br>';
echo '</form>';
?>

<?php 
if (isset($_POST['Submit2'])) {
    // Παίρνουμε το ID του γιατρού από το POST
    $consultant_id = $_POST['consultant'];
	$sygkat = isset($_POST['sygkat1']) ? 1 : 0;

    // Έλεγχος αν ο γιατρός έχει επιλεγεί ήδη από 3 ασθενείς
    $query = "SELECT COUNT(*) as count FROM user WHERE consultant = '$consultant_id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row['count'] < 3) {
        // Ο γιατρός μπορεί να επιλεγεί
        // Λήψη στοιχείων του γιατρού
        $query = "SELECT name, eidikotita FROM user WHERE id_user = '$consultant_id'";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $doctor_name = $row['name'];
            $specialty = $row['eidikotita'];

            // Ενημέρωση του γιατρού ως σύμβουλος για τον χρήστη
            $query = "UPDATE user SET consultant = '$consultant_id', sygkat = '$sygkat' WHERE id_user = '$user_id'";
            mysqli_query($con, $query);
			
			// Ενημέρωση του $_SESSION['consultant']
            $_SESSION['consultant'] = $consultant_id;
			

            // Εμφάνιση μηνύματος επιτυχίας
            echo "<p style='color: green; font-weight: bold;'>Συγχαρητήρια, επιλέξατε τον γιατρό $doctor_name με ειδικότητα $specialty.</p>";
        } else {
            echo "<p style='color: red;'>Προέκυψε σφάλμα. Δοκιμάστε ξανά.</p>";
        }
    } else {
        // Ο γιατρός έχει ήδη 3 ασθενείς
        echo "<p style='color: red;'>Ο γιατρός δεν μπορεί να επιλεγεί, καθώς έχει ήδη 3 ασθενείς.</p>";
    }
}
?>

</div>

</div>
</div>
	</div> 
</section>
</div>

<?php include('down.php'); ?>
