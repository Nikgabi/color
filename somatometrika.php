<?php
include('up.php');
?>
<div id = container class="layout_padding-bottom"><br>
<section class="about_section">
    <div class="container">
      <div class="row">
        <div class="col-md-3 ">
          <div class="img-box">
            <img src="images/100.jpg" alt="">
          </div>
        </div>
		<div class="col-md-9 ">
			<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">
<?php
// Εξασφαλίζουμε ότι έχουμε το patient_id από το URL
if (!isset($_GET['patient_id']) || empty($_GET['patient_id'])) {
    echo "<p style='color:red;'>Το ID του ασθενούς δεν παρέχεται.</p>";
    include('down.php');
    exit();
}

$patient_id = mysqli_real_escape_string($con, $_GET['patient_id']);

// Ερώτημα για να πάρουμε τα δεδομένα του χρήστη με ταξινόμηση κατά ημερομηνία
$query = "SELECT * FROM health_data WHERE user_id = '$patient_id' ORDER BY created_at DESC"; // Υποθέτουμε ότι υπάρχει πεδίο `created_at` για την ημερομηνία καταχώρησης
$result = mysqli_query($con, $query);

// Ελέγχουμε αν υπάρχουν αποτελέσματα
if (mysqli_num_rows($result) > 0) {
    echo "<div class='container'>";
	echo '<div class="w3-card-4" style="background-color: rgb(240,240,240); text-align:center;">';
    echo "<h2>Στοιχεία Σωματομετρικών Υπολογισμών</h2>";
    echo "<table border='1' style='width:100%; border-collapse:collapse; text-align:center;'>
            <thead>
                <tr>
                    <th>Ημερομηνία Καταχώρησης</th>
                    <th>Ύψος (cm)</th>
                    <th>Βάρος (kg)</th>
                    <th>Περίμετρος Μέσης (cm)</th>
                    <th>Ηλικία</th>
                    <th>Φύλο</th>
                    <th>BMI</th>
                    <th>BSA (m²)</th>
                    <th>BMR (kcal/day)</th>
                    <th>IBW (kg)</th>
                    <th>ABW (kg)</th>
                    <th>RFM</th>
                    <th>ETD (cm)</th>
                    <th>TV (ml)</th>
                </tr>
            </thead>
            <tbody>";
    // Παίρνουμε κάθε γραμμή δεδομένων
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . date("d-m-Y H:i", strtotime($row['created_at'])) . "</td>
                <td>{$row['height']}</td>
                <td>{$row['weight']}</td>
                <td>{$row['waist']}</td>
                <td>{$row['age']}</td>
                <td>{$row['gender']}</td>
                <td>" . number_format($row['bmi'], 2) . "</td>
                <td>" . number_format($row['bsa'], 2) . "</td>
                <td>" . number_format($row['bmr'], 2) . "</td>
                <td>" . number_format($row['ibw'], 2) . "</td>
                <td>" . number_format($row['abw'], 2) . "</td>
                <td>" . number_format($row['rfm'], 2) . "</td>
                <td>" . number_format($row['etd'], 0) . "</td>
                <td>" . number_format($row['tv'], 0) . "</td>
              </tr>";
    }
	
    echo "</tbody></table><br>";
	echo '<button style="background-color: rgb(162,235,182) ;"><a href="my_data.php">
					  Πίσω
					</a></button><br><br>';
    echo "</div>";
} else {
    echo "<p style='color:red;'>Δεν βρέθηκαν δεδομένα για τον ασθενή με ID: $patient_id.</p>";
} 

echo'</div></div>';
?>
</div>
			</div>
	</div> 
</section>
</div>
<?php
include('down.php');
?>
