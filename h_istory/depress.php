<?php
include('../up.php');
?>
<div id = container style="text-align:center;" class="layout_padding-bottom"><br>	
<!--<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">-->
<?php
// Εξασφαλίζουμε ότι έχουμε το patient_id από το URL
if (!isset($_GET['patient_id']) || empty($_GET['patient_id'])) {
    echo "<p style='color:red;'>Το ID του ασθενούς δεν παρέχεται.</p>";
    include('down.php');
    exit();
}

$patient_id = mysqli_real_escape_string($con, $_GET['patient_id']);

// Ερώτημα για να πάρουμε τα δεδομένα του χρήστη με ταξινόμηση κατά ημερομηνία
$query = "SELECT * FROM depress_data WHERE depress_id = '$patient_id' ORDER BY date_created_depress DESC"; 
$result = mysqli_query($con, $query);

// Ελέγχουμε αν υπάρχουν αποτελέσματα
if (mysqli_num_rows($result) > 0) {
    echo "<div class='container'>";
    echo "<h2>Depress Data</h2>";
    echo "<table border='1' style='width:100%; border-collapse:collapse; text-align:center;'>
            <thead>
                <tr>
                    <th>Ημερομηνία Καταχώρησης</th>
                    <th>Σκόρ</th>
                    <th>Εκτίμηση</th>
                    
                </tr>
            </thead>
            <tbody>";
    // Παίρνουμε κάθε γραμμή δεδομένων
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . date("d-m-Y", strtotime($row['date_created_depress'])) . "</td>
                <td>{$row['scor_depress']}</td>
                <td>{$row['message_depress']}</td>
                
              </tr>";
    }
	
    echo "</tbody></table><br>";
	if (isset($_SESSION['role']) && $_SESSION['role'] == 'Doctor'){
		echo '<button style="background-color: rgb(162,235,182) ;"><a href="' . BASE_URL . 'menu/patiens.php">
					  Πίσω
					</a></button><br><br>';
	} else {
	echo '<button style="background-color: rgb(162,235,182) ;"><a href="' . BASE_URL . 'menu/my_data.php">
					  Πίσω
	</a></button><br><br>';}
    echo "</div>";
} else {
    echo "<p style='color:red;'>Δεν βρέθηκαν δεδομένα για τον ασθενή με ID: $patient_id.</p>";
	if (isset($_SESSION['role']) && $_SESSION['role'] == 'Doctor'){
		echo '<button style="background-color: rgb(162,235,182) ;"><a href="' . BASE_URL . 'menu/patiens.php">
					  Πίσω
					</a></button><br><br>';
	} else {
	echo '<button style="background-color: rgb(162,235,182) ;"><a href="' . BASE_URL . 'menu/my_data.php">
					  Πίσω
	</a></button><br><br>';}
} 

echo'</div></div>';
?>
</div>
<?php
include('../down.php');
?>