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
$query = "SELECT * FROM bio_tests WHERE biox_id = '$patient_id' ORDER BY created_at DESC"; // Υποθέτουμε ότι υπάρχει πεδίο `created_at` για την ημερομηνία καταχώρησης
$result = mysqli_query($con, $query);

// Ελέγχουμε αν υπάρχουν αποτελέσματα
if (mysqli_num_rows($result) > 0) {
    echo "<div class='container'>";
    echo "<h2>Βιοχημικές εξετάσεις</h2>";
    echo "<table border='1' style='width:100%; border-collapse:collapse; text-align:center;'>
            <thead>
                <tr>
                    <th>Ημερομηνία</th>
                    <th>Γλυκοζη</th>
                    <th>ουρία</th>
                    <th>Κρεατ</th>
                    <th>Ουρικό</th>
                    <th>Χοληστ</th>
                    <th>HDL</th>
                    <th>Τριγλ</th>
                    <th>Αλκ. Φωσφ</th>
                    <th>SGOT</th>
                    <th>SGPT</th>
                    <th>γ-GT</th>
                    <th>Χολερ</th>
                    <th>Άμεση</th>
					<th>K</th>
					<th>Na</th>
					<th>Cl</th>
					<th>Ca</th>
					<th>Mg</th>
					<th>Λευκώμ</th>
					<th>Αλβουμ</th>
					<th>Γλυκ Hb</th>
					<th>Αμυλ αίμ</th>
					<th>Αμ. ούρων</th>
					<th>CRP</th>
					<th>PSA</th>
					<th>CPK</th>
                </tr>
            </thead>
            <tbody>";
    // Παίρνουμε κάθε γραμμή δεδομένων
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . date("d-m-Y", strtotime($row['created_at'])) . "</td>
                <td>{$row['glu']}</td>
                <td>{$row['ouria']}</td>
                <td>{$row['krea']}</td>
                <td>{$row['ouriko']}</td>
                <td>{$row['cholist']}</td>
				<td>{$row['hdl']}</td>
                <td>{$row['trigl']}</td>
                <td>{$row['al_f']}</td>
                <td>{$row['sgot']}</td>
                <td>{$row['sgpt']}</td>
				<td>{$row['ggt']}</td>
                <td>{$row['choler']}</td>
                <td>{$row['choler1']}</td>
                <td>{$row['ka']}</td>
                <td>{$row['na']}</td>
				<td>{$row['cl']}</td>
                <td>{$row['ca']}</td>
                <td>{$row['mgn']}</td>
                <td>{$row['leuk']}</td>
				<td>{$row['alboum']}</td>
                <td>{$row['glu_hb']}</td>
                <td>{$row['amyl']}</td>
				<td>{$row['amyl1']}</td>
                <td>{$row['crp']}</td>
                <td>{$row['psa']}</td>
                <td>{$row['cpk']}</td>
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
  echo " <p style='color:green'>*** Μιλήστε με τον γιατρό σας για τα αποτελέσματα </p>
		";
 

echo'</div></div>';
?>
</div>
			


<?php
include('../down.php');
?>